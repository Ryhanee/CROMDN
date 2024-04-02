<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use \Kamaln7\Toastr\Facades\Toastr;

class CheckSuperUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user() or Auth::user()->id_role != 1) 
        {
            Auth::logout();
			return redirect(route('login'));
		}
        else
        return $next($request);
    }
}