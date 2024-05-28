<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Finance
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->level == 5){
            return $next($request);
        }
        return redirect('dashboard')->with('warning', 'Only finance access!');
    }
}