<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminLoginAuth
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
        if(!($request->session()->has('ADMIN_LOGIN'))){
            $request->session()->flash('msg', 'access denied');
            return redirect('/admin');
        }
        return $next($request);
    }
}
