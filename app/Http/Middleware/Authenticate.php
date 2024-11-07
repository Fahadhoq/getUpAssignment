<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, \Closure $next, ...$guards)
    {
        if ($this->auth->guard('api')->guest()) {
            return response()->error('Missing authorization code.',401);
        }

        // Otherwise, fall back to the default behavior (redirect to login page)
        return parent::handle($request, $next, ...$guards);
    }
}



