<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['isAdmin','isBanded']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        $users = User::latest('id')
            ->paginate(7)->withQueryString();

        return view('user.index',compact('users'));
    }

//    public function galleryShow()
//    {
//
//        $users = User::latest('id')
//            ->paginate(7)->withQueryString();
//
//        return view('user.index',compact('users'));
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param user $user
     * @return Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param user $user
     * @return Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param user $user
     * @return Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param user $user
     * @return Response
     */
    public function destroy(user $user)
    {
        //
    }

    // band user
    public function bandUser(Request $request)
    {
        $currentUser = User::query()->findOrFail($request->id);
//        return $currentUser;
        //$message = '';
        if (!$currentUser->isAdmin())
        {
            //$message = 'You cannot band yourself.';
            if($request->band === 'band')
            {
                $currentUser->isBanded = '-1';
                $message = "User name : ".$currentUser->name."is banded by ".Auth::user()->role;
                $edited = $currentUser->update();
            }

            if($request->band === 'unBanded')
            {
                $currentUser->isBanded = '1';
                $message = "User name : ".$currentUser->name."is banded by ".Auth::user()->role;
                $edited = $currentUser->update();
            }
        }else{
            $message = 'You cannot band yourself.';
        }

        //$message = 'asdfasdf';

        return redirect()->back()->with(["status"=>$message]);
    }

    // make editor
    public function userRoleChangeEditor(Request $request)
    {
        $currentUser = User::query()->findOrFail($request->id);
        if ( $currentUser->role === 'author'){
            $currentUser->role = 'editor' ;
        }
            $currentUser->updateOrFail();
        return redirect()->back()->with(["status"=>$currentUser->name." is change role to editor"]);
    }

    // make author
    public function userRoleChangeAuthor(Request $request)
    {
        $currentUser = User::query()->findOrFail($request->id);
        if ($currentUser->role === 'editor')
        {
            $currentUser->role = 'author';
            $currentUser->updateOrFail();
        }
        return redirect()->back()->with(["status"=>$currentUser->name." is change role to editor"]);
    }

    // make admin
    public function userRoleChangeAdmin(Request $request)
    {
        $currentUser = User::query()->findOrFail($request->id);
        if ($currentUser->role === 'editor' || $currentUser->role === 'author')
        {
            $currentUser->role = 'admin';
            $currentUser->updateOrFail();
        }
        return redirect()->back()->with(["status"=>$currentUser->name." is change role to editor"]);
    }
}
