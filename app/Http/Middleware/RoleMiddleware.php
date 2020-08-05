<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role1,$role2, $permission = null)
    {
        if (!$request->user()->hasRole($role1,$role2)) {
            return response()->json(['success' => 'role failed'], 404);
        }
            
        if ($permission !== null && !$request->user()->can($permission)) {
            return response()->json(['success' => 'permission failed'], 404);
        }
        return $next($request);
    }
}
