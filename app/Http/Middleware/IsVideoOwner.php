<?php

namespace App\Http\Middleware;

use App\Models\Video;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsVideoOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();

        if (!Auth::user()) {
            return \response('unauthorized', 401);
        }

        if(!Video::query()->where('id', is_string($request->video) ? $request->video : $request->video->id)->where('user_id', $user->id)->exists()) {
            return response('permission denied', 403);
        }

        return $next($request);
    }
}
