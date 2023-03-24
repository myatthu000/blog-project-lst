<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Throwable;

class CategoryController extends Controller
{
    public function search()
    {
        $categories = Category::search()
            ->when(Auth::user()->isAuthor(),function ($q){
                $q->where('user_id',Auth::id());
            })
            ->latest('id')->paginate(7)->withQueryString();
        return view('category.index',compact('categories'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::latest('id')
            ->with(['user'])
            ->when(Auth::user()->isAuthor(),function ($q){
                $q->where('user_id',Auth::id());
            })
            ->paginate(7)->withQueryString();

        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->user_id = Auth::id();
        $category->saveOrFail();

        return redirect()->route('category.index')->with(["status"=>$category->title." is successfully Created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function show(Category $category)
    {
        Gate::authorize('view',$category);
//        $category->load('user');
        $postCount = $category->posts()->count();
        $posts = $category->posts;
        return view('category.show',compact('category','postCount','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category)
    {
        Gate::authorize('update',$category);
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        Gate::authorize('update',$category);
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->updateOrFail();

        return redirect()->route('category.index')->with(["status"=>$category->title." is successfully Created"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        Gate::authorize('delete',$category);
//        return $category;
        $title = $category->title;
        $category->deleteOrFail();
        return redirect()->route('category.index')->with(["status"=>$title." is deleted successfully"]);
    }
}
