<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class BasicAuthenticate
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
        //return $next($request);
//	dd($request);
//	dd(Config::all());
//	dd(config('baseauth'));
	if (config('baseauth.users')->contains([$request->getUser(), $request->getPassword()])) {
//	if Config::get
            return $next($request);
        }

        return response('You shall not pass!', 401, ['WWW-Authenticate' => 'Basic']);
    }
}
