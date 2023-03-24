<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\User;
use App\Notifications\PostNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use Throwable;

class PostController extends Controller
{
    use SoftDeletes,Notifiable;
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function searchQ()
    {
        $posts = Post::search()
            ->latest("id")
            ->when(Auth::user()->isAuthor(),function ($q){
                $q->where('user_id',Auth::id());
            })
//            ->with(['category','user','photo'])
            ->paginate(7)->withQueryString();
//        return $posts;
        return view('post.index',compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = Post::latest("id")
            ->when(Auth::user()->isAuthor(),function ($q){
                $q->where('user_id',Auth::id());
            })
            ->when(request('trash'),function ($q){
                $q->onlyTrashed();
            })
            ->with(['category','user'])
            ->paginate(7)
            ->withQueryString();

        return view('post.index',compact('posts'));
    }

    public function trashes()
    {
        $deletedPostCount = Post::onlyTrashed()->count();
        $posts = Post::latest("id")
            ->when(Auth::user()->isAuthor(),function ($q){
                $q->where('user_id',Auth::id());
            })
            ->onlyTrashed()
            ->with(['category','user'])
            ->paginate(7)
            ->withQueryString();

        return view('post.index',compact('posts','deletedPostCount'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
        try {
            DB::beginTransaction();
            $post = new Post();
            $user = User::query()->findOrFail(10);
//            $user = auth()->user();
            $user_authors = User::query()->where('role','=','author')->get();
            if($request->file('feature_image'))
            {
                //save in folder
                $file = $request->file('feature_image');
                $newName = uniqid().'_feature_image_.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/'.Auth::id().'/feature_image',$file,$newName);

                //record in db
                $post->feature_image = $newName;
            }
            $post->fill([
                "title" => $request->title,
                "description" => $request->description,
                "slug" => Str::slug($request->title),
                "excerpt" => Str::words($request->description,10),
                "user_id" => Auth::id(),
                "category_id" => $request->category,
            ]);


            $post->saveOrFail();

            if($request->file('multiple_photos')) {
                $photos_array = [];
                foreach ($request->file('multiple_photos') as $key => $photo) {
                    //save in folder
                    $file = $photo;
                    $newName = uniqid() . '_multiple_photos.' . $file->getClientOriginalExtension();
                    Storage::putFileAs('public/' . $post->user_id . '/multiple_photos', $file, $newName);

                    //record in db
                    $photos_array[$key] = [
                        'post_id' => $post->id,
                        'name' => $newName,
                    ];
                }
            }


            Photo::query()->insert($photos_array);
//            $post->user()->notify(new PostNotification($post));
//            $user->notify(new PostNotification($post));
            Notification::send($user_authors,new PostNotification($post));

            DB::commit();

        }catch (\Exception $exception)
        {
            DB::rollBack();
        }


//        return $request;
        return redirect()->route('post.index')->with(["status"=>$post->title." is successfully Created"]);

    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function show(Post $post)
    {
        Gate::authorize('view',$post);
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        Gate::authorize('update',$post);
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        Gate::authorize('update',$post);
        try {
            DB::beginTransaction();

            if($request->file('feature_image'))
            {
                $path = '/public/'.$post->user_id.'/feature_image/'.$post->feature_image;
                Storage::delete($path);
                //save in folder
                $file = $request->file('feature_image');
                $newName_feature = uniqid().'_feature_image_.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/'.$post->user_id.'/feature_image',$file,$newName_feature);

                //record in db
                $post->feature_image = $newName_feature;
            }
            $post->fill([
                "title" => $request->title,
                "description" => $request->description,
                "slug" => Str::slug($request->title),
                "excerpt" => Str::words($request->description,10),
//                "user_id" => Auth::id(),
                "category_id" => $request->category,
            ]);
            $post->updateOrFail();


            if ($request->multiple_photos)
            {
                $photos_multi_array = [];
                foreach ($request->file('multiple_photos') as $key=>$photo) {
                    //save in folder
                    $file = $photo;
                    $newName_multi = uniqid() . '_multiple_photos.' . $file->getClientOriginalExtension();
                    Storage::putFileAs('public/' . $post->user_id . '/multiple_photos', $file, $newName_multi);

                    //record in db
                    $photos_multi_array[$key] = [
                        'post_id' => $post->id,
                        'name' => $newName_multi,
                    ];
                }
                Photo::query()->insert($photos_multi_array);
            }

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }


//        return redirect()->back()->with(["status"=>$post->title." is updated successfully"]);
        return redirect()->route('post.index')->with(["status"=>$post->title." is updated successfully"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete',$post);

        try {
            DB::beginTransaction();
            $title = $post->title;

            $post->deleteOrFail();
            DB::commit();

        }catch (\Exception $error){
            DB::rollBack();
            return redirect()->back()->with(["status"=> "-->".$error->getMessage()]);
        }

        return redirect()->back()->with(["status"=>$title." is deleted successfully"]);
//        return redirect()->route('post.index')->with(["status"=>$title." is deleted successfully"]);
    }


    public function restore($post)
    {
        $post = Post::onlyTrashed()->findOrFail($post);
        Gate::authorize('restore',$post);
        $title=$post->title;
        $post->restore();
        return redirect()->back()->with(["status"=>$title." is restore successfully"]);
    }

    public function forceDelete($post)
    {
        $post = Post::onlyTrashed()->findOrFail($post);
        Gate::authorize('forceDelete',$post);
        try {
            DB::beginTransaction();
            $title = $post->title;
            if($post->feature_image)
            {
                Storage::delete('public/'.$post->user_id.'/feature_image/'.$post->feature_image);
            }
//            file storage delete
            $photo_array = [];
            foreach ($post->photos as $key=>$photo)
            {
                $photo_array[$key] = $photo;
                Storage::delete('public/'.$post->user_id.'/multiple_photos/'.$photo->name);
            }
//            db record delete
            Photo::where("post_id",$post->id)->delete();

            $post->forceDelete();
            DB::commit();

        }catch (\Exception $error){
            DB::rollBack();
//            dd($error->getMessage());
            return redirect()->back()->with(["status"=> "-->".$error->getMessage()]);
        }
//        $paginator = Post::paginate($this->defaultPaginateCount())->withQueryString();
//        $redirectToPage = (request("page") <= $paginator->lastPage()) ? request('page') : $paginator->lastPage();

        return redirect()->back()->with(["status"=>$title." is deleted successfully"]);
    }

//    public function defaultPaginateCount()
//    {
//        return $pc = 7;
//    }
}
