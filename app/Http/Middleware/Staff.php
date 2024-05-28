<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Staff
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->level == 3){
            return $next($request);
        }
        return redirect('dashboard')->with('warning', 'Only staff access!');
    }
}
