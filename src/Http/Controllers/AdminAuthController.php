<?php

namespace Cabard\Nimda\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function getLogin(){
        return "login";
        return view('admin.auth.login');
    }

    public function postLogin(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->guard('nimda')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')], true)){
            $user = auth()->guard('nimda')->user();

            return redirect()->route('nimda.adminDashboard')->with('success','You are Logged in sucessfully.');
        }else {
            dd(Hash::make($request->input('password')));
            return back()->with('error','Whoops! invalid email and password.');
        }
    }

    public function adminLogout(Request $request)
    {
        return "adminLogout";
        auth()->guard('nimda')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('nimda.adminLogin'));
    }

    public function test(Request $request)
    {
        return "im ADMIN!";
    }
}
