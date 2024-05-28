<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login():view
    {
        $data = [
            'title'     => 'Login',
        ];
        return View('auth.login', $data);
    }

    public function register():view
    {
        $data = [
            'title'     => 'Register',
        ];
        return View('auth.register', $data);
    }

}

