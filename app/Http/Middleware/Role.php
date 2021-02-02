<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,  String $role)
    {
        $userRole = Auth::user()->Role;
        
        if($userRole == $role){
            return $next($request);
        }
        return back();
    }
}

