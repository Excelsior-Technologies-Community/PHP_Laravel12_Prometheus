<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', [

            'users' => User::count(),

            'memory' => round(
                memory_get_usage(true) / 1024 / 1024,
                2
            ),

            'disk' => round(
                disk_free_space("/") / 1024 / 1024 / 1024,
                2
            ),

            'uptime' => time() - LARAVEL_START,

            'cacheRatio' => 95

        ]);
    }
}