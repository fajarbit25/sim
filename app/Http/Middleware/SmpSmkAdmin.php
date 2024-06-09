<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmpSmkAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->level == 1 && Auth::user()->campus_id == 4 || Auth::user()->level == 1 && Auth::user()->campus_id == 5){
            return $next($request);
        }
        return redirect('dashboard')->with('warning', 'Only admin access!');
    }
}
