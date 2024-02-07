<?php

namespace Cabard\Nimda\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

class Test extends Controller
{
    public function index ()
    {
        dump(config('auth'));

        dump(
            \Auth::guard('nimda')->check(),
            \Auth::guard('nimda')->id(),
            \Auth::guard('nimda')->user()
        );

        return 1;
    }
    public function login (Guard $auth_guard)
    {
        if ($auth_guard->validate()) {
            // get the current authenticated user
            $user = $auth_guard->user();

            echo 'Success!';
        } else {
            echo 'Not authorized to access this page!';
        }
    }
}
