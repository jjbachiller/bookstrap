<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class Activate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user() || !$request->user()->active) {
            return $request->expectsJson()
                    ? abort(403, 'Your account is not activated.')
                    : Redirect::route($redirectToRoute ?: 'account.notactived');
        }

        return $next($request);
    }
}
