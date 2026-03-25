<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Prometheus\Collectors\Horizon\CurrentMasterSupervisorCollector;
use Spatie\Prometheus\Collectors\Horizon\CurrentProcessesPerQueueCollector;
use Spatie\Prometheus\Collectors\Horizon\CurrentWorkloadCollector;
use Spatie\Prometheus\Collectors\Horizon\FailedJobsPerHourCollector;
use Spatie\Prometheus\Collectors\Horizon\HorizonStatusCollector;
use Spatie\Prometheus\Collectors\Horizon\JobsPerMinuteCollector;
use Spatie\Prometheus\Collectors\Horizon\RecentJobsCollector;
use Spatie\Prometheus\Collectors\Queue\QueueDelayedJobsCollector;
use Spatie\Prometheus\Collectors\Queue\QueueOldestPendingJobCollector;
use Spatie\Prometheus\Collectors\Queue\QueuePendingJobsCollector;
use Spatie\Prometheus\Collectors\Queue\QueueReservedJobsCollector;
use Spatie\Prometheus\Collectors\Queue\QueueSizeCollector;
use Spatie\Prometheus\Facades\Prometheus;

class PrometheusServiceProvider extends ServiceProvider
{
    public function register()
{
    // ── Gauge: Static value ──────────────────────────
    Prometheus::addGauge('app_users_total')
        ->helpText('Total registered users')
        ->value(function () {
            return \App\Models\User::count();
        });

    // ── Gauge: Active sessions ───────────────────────
    Prometheus::addGauge('app_cache_hit_ratio')
        ->helpText('Cache performance ratio')
        ->value(function () {
            return 0.95; // example value
        });

    // ── Counter: Track requests ──────────────────────
    Prometheus::addGauge('app_memory_usage_bytes')
        ->helpText('Current PHP memory usage')
        ->value(function () {
            return memory_get_usage(true);
        });
}
}
