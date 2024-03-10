<?php

namespace App\Http\Middleware;

use Closure;
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
    
        //  Check if the authenticated user has the 'admin' role
         if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }
     
        
        // Redirect or abort the request if the user is not an admin
        // return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
        // Alternatively, you can abort with a 403 Forbidden error:
        return redirect()->back();
    }

    }

