<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckProfileInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
    
        // Check if the user is authenticated and profile is incomplete
        if ($user && (empty($user->first_name) || empty($user->last_name))) {
            
            // Check if the current route is not the profile edit route
            if ($request->route()->getName() !== 'admin.show-profile') {
                
                // Redirect to the profile edit route with an error message
                return redirect()->route('admin.show-profile', $user->id)
                                 ->with('error', 'Please complete the setup before using the system');
            }
        }
    
        // Allow the request to proceed for all routes
        return $next($request);
    }
        
    
}
