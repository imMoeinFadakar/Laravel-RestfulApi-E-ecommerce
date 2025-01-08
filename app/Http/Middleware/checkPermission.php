<?php

namespace App\Http\Middleware;

use App\Models\permissions;
use App\Trait\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkPermission
{   
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$permission)
    {
        if(! auth()->user()->role->hasPermission($permission)){

            return $this->errorResponse(403,'not perimission for enter');

        }

        return $next($request);
    }
}
