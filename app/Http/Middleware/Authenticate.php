<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        if ($request->is('user') || $request->is('user/*')) {
            if (!$request->is('user/login') && !$request->is('user/login/*')) {
                return route('user.login');
            }

            return null;
        }

        return route('admin.login');
    }

}
