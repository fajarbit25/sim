<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Siswa
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->level == 4){
            return $next($request);
        }
        return redirect('dashboard')->with('warning', 'Only student access!');
    }
}
