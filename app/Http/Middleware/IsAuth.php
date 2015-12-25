<?php

namespace App\Http\Middleware;

use Closure;

class IsAuth
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
        $user = $request->user();
        if ($user) {
            return $next($request);
        } else {
            $message = "Acount not permission";
            $alertClass = "alert-danger";
            return redirect('/auth/login')->with(compact('message', 'alertClass'));
        }
    }
}
