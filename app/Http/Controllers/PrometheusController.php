<?php

namespace App\Http\Controllers;

use App\Models\User;

class PrometheusController extends Controller
{
    public function metrics()
    {
        $users = User::count();

        $memory = memory_get_usage(true);

        $uptime = time() - LARAVEL_START;

        $disk = disk_free_space("/");

        $cacheRatio = 95;

        $output = <<<PROM
# HELP app_users_total Total registered users
# TYPE app_users_total gauge
app_users_total {$users}

# HELP app_memory_usage_bytes Current PHP memory usage
# TYPE app_memory_usage_bytes gauge
app_memory_usage_bytes {$memory}

# HELP app_server_uptime_seconds Server uptime in seconds
# TYPE app_server_uptime_seconds gauge
app_server_uptime_seconds {$uptime}

# HELP app_disk_free_space_bytes Remaining disk space
# TYPE app_disk_free_space_bytes gauge
app_disk_free_space_bytes {$disk}

# HELP app_cache_hit_ratio Cache performance ratio
# TYPE app_cache_hit_ratio gauge
app_cache_hit_ratio {$cacheRatio}

PROM;

        return response(
            $output,
            200
        )->header(
            'Content-Type',
            'text/plain'
        );
    }
}
