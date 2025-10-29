<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        /** @var User|null $user */
        $user = Auth::user();

        // Check if user is authenticated and has the 'admin' role
        if ($user && $user->isAdmin()) {
            return $next($request);
        }

        // If not, redirect them to the regular dashboard or home
        return redirect('/dashboard')->with('error', 'You do not have admin access.');
    }
}
