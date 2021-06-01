<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $your_role = $request->user()->role;
        if (! in_array($your_role, $roles,True)) {
            return redirect('/home');
        }
        return $next($request);
    }

}
