<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['isAdmin','isBanded']);
    }

    public function toSettings()
    {
        return view('user.setting');
    }

    public function passwordChange(Request $request)
    {
        $validator = Validator::make(\request()->all(),[
           'password' => 'required|min:6|max:15|String',
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Store the blog post...

        User::query()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with(["status"=>"Password is changed successfully."]);
    }
}
