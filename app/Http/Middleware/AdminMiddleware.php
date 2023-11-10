<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $isAuthenticatedAdmin = (Auth::check());
        if (!$isAuthenticatedAdmin){

            return  redirect()->route('admin.login');
        }
        //print_r($request->routeIs('admin.*')); die();
        if ($request->routeIs('admin.*') && !$request->routeIs('admin.login.submit')) {
            $role = auth()->user()->role;
            $os = ['admin'];
            if (!auth()->check() || !in_array($role, $os)) {
                return redirect()->route('admin.login');
            }
        }

        return $next($request);
    }
}
