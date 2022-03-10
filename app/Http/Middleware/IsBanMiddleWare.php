<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsBanMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_ban){
            $banned = Auth::user()->is_ban=="1";
            Auth::logout();
            if ($banned==1){
                $message = "You account has been banned. Please Contact the administration";
            }

            return redirect()->route('login')->with('message',$message)->withErrors(['email'=>'Your Account Has been Banned']);
        }

        return  $next($request);
    }
}
