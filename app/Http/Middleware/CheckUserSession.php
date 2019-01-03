<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;

class CheckUserSession{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        
        if(!$request->session()->exists('email')){
            return redirect('/');
        }else{
            return $next($request);
        }
    }
}
