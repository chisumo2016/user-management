<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            /**
             * Authenticated User
             */
            $user = Auth::user();

            /**
             * You can determine if a user has a certain role: Doc of Spatie
             * @var App\Models\User $user
             */
            if ($user->hasRole(['super-admin','admin'])) {
                return $next($request);
            }
            abort('403','User does not have correct role');
        }

        abort('403');
    }
}
