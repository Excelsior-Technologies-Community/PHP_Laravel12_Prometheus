# PHP\_Laravel12\_Prometheus

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)
![Prometheus](https://img.shields.io/badge/Metrics-Prometheus-E6522C?style=for-the-badge)
![Command](https://img.shields.io/badge/Command-php%20artisan-blue?style=for-the-badge)

---

## Overview

Laravel does not expose application metrics by default.

This project demonstrates **how to integrate Prometheus monitoring in Laravel 12**
using the `spatie/laravel-prometheus` package step by step from installation to verification.

---

## Features

* Exposes application metrics via `/prometheus` endpoint
* Tracks total registered users from database
* Tracks current PHP memory usage in bytes
* Tracks custom gauge values (e.g. cache hit ratio)
* Supports optional Laravel Horizon and Queue collectors
* Fully compatible with Laravel 12

---

## Folder Structure

```
project-root/
├── app/
│   ├── Http/
│   ├── Models/
│   └── Providers/
│       └── PrometheusServiceProvider.php
├── bootstrap/
│   └── providers.php
├── config/
│   └── prometheus.php
├── routes/
│   └── web.php
├── .env
└── README.md
```

---

## Step 1 — System Requirements

Before installing Laravel 12, ensure your system has:

* PHP **8.2 or higher**
* Composer (latest version)
* MySQL / MariaDB
* Apache / Nginx / XAMPP
* Node.js & NPM

---

## Step 2 — Create New Laravel Project

Open terminal / command prompt and run:

```
composer create-project laravel/laravel:^12.0 PHP_Laravel12_Prometheus
```

Move into project directory:

```
cd PHP_Laravel12_Prometheus
```

---

## Step 3 — Install Node Dependencies

```
npm install
```

Build frontend assets:

```
npm run build
```

---

## Step 4 — Install Prometheus Package

```
composer require spatie/laravel-prometheus
```

---

## Step 5 — Publish Config and Service Provider

```
php artisan vendor:publish --provider="Spatie\Prometheus\PrometheusServiceProvider"
```

This will publish two files:

* `config/prometheus.php` — package configuration
* `app/Providers/PrometheusServiceProvider.php` — where metrics are defined

---

## Step 6 — Environment File Setup (.env)

Laravel uses `.env` file for environment configuration.

If `.env` file does not exist, create it:

```
cp .env.example .env
```

### Example `.env` Configuration

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=php_laravel12_prometheus
DB_USERNAME=root
DB_PASSWORD=
```

**Note:**  
Replace database credentials with your own system configuration.

---

## Step 7 — Generate Application Key

```
php artisan key:generate
```

---

## Step 8 — Register the Service Provider

Open `bootstrap/providers.php` and add `PrometheusServiceProvider`:

```php
<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\PrometheusServiceProvider::class,
];
```

---

## Step 9 — Configure Metrics

Open `app/Providers/PrometheusServiceProvider.php` and define your metrics inside the `register()` method:

```php
public function register()
{
    Prometheus::addGauge('users_total')
        ->helpText('Total registered users')
        ->value(function () {
            return \App\Models\User::count();
        });

    Prometheus::addGauge('memory_usage_bytes')
        ->helpText('Current PHP memory usage')
        ->value(function () {
            return memory_get_usage(true);
        });

    Prometheus::addGauge('cache_hit_ratio')
        ->helpText('Cache performance ratio')
        ->value(function () {
            return 0.95;
        });
}
```

**Note:**  
Do not add `app_` prefix to metric names. The namespace in `config/prometheus.php` already prepends `app_` automatically.

---

## Step 10 — Run Database Migrations

```
php artisan migrate
```

---

## Step 11 — Start Development Server

```
php artisan serve
```

---

## Result

Open your browser and visit:

```
http://127.0.0.1:8000/prometheus
```

You should see output like this:

```
# HELP app_users_total Total registered users
# TYPE app_users_total gauge
app_users_total 0

# HELP app_memory_usage_bytes Current PHP memory usage
# TYPE app_memory_usage_bytes gauge
app_memory_usage_bytes 23068672

# HELP app_cache_hit_ratio Cache performance ratio
# TYPE app_cache_hit_ratio gauge
app_cache_hit_ratio 0.95
```

✔ Prometheus metrics endpoint is active  
✔ Metrics are being collected from your Laravel application

---

## How Namespace Works

The `namespace` value in `config/prometheus.php` is automatically prepended to all metric names.

| Namespace | Metric Name | Final Output Name |
|---|---|---|
| `app` | `users_total` | `app_users_total` |
| `app` | `memory_usage_bytes` | `app_memory_usage_bytes` |
| `app` | `cache_hit_ratio` | `app_cache_hit_ratio` |

---

## Optional — Horizon Collectors

If you use Laravel Horizon, uncomment this line in `PrometheusServiceProvider`:

```php
$this->registerHorizonCollectors();
```

---

## Optional — Queue Collectors

To monitor queue sizes, uncomment this line and pass your queue names:

```php
$this->registerQueueCollectors(['default']);
```

---

