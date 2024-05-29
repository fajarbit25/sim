<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Sdadmin
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->level == 1 && Auth::user()->campus_id == 3){
            return $next($request);
        }
        return redirect('dashboard')->with('warning', 'Only SD teacher access!');
    }
}
