<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if ($token !== 'fajarramadana25') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
