<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserActivity;

class TrackActivity
{
    public function handle(Request $request, Closure $next)
    {
        UserActivity::create([
            'user_id' => auth()->id(),
            'activity' => 'visit: ' . $request->path(),
            'ip_address' => $request->ip(),
        ]);

        return $next($request);
    }
}