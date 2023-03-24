<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function notify()
    {
//        $user = Auth::user();
//
//        return view("client_template.client_nav",compact('user'));
    }

    public function unread($id)
    {
        if ($id)
        {
            $result = \auth()->user()->notifications->where('id',$id)->first();
            $result->read_at = null;
            $result->update();
        }
        return back();
    }

    public function read($id)
    {
        $url = '';
        if ($id)
        {
            $result = \auth()->user()->notifications->where('id',$id)->first();
            $url = $result->data['post_url'];
            $result->markAsRead();
            //return  $url;
        }

        return redirect($url);

    }
}
