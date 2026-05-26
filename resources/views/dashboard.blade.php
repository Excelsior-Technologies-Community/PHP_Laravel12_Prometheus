<!DOCTYPE html>
<html>

<head>

    <title>Prometheus Monitoring Dashboard</title>

    <meta charset="utf-8">

    <meta name="viewport"
        content="width=device-width,initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
        rel="stylesheet">

    <style>
        body {
            background: #f4f7fc;
            font-family: Arial, sans-serif;
        }

        .header {

            background: linear-gradient(135deg,
                    #4e73df,
                    #224abe);

            padding: 40px;

            border-radius: 25px;

            color: white;

            margin-bottom: 35px;

            box-shadow:
                0 10px 25px rgba(0, 0, 0, .1);
        }

        .card-box {

            background: white;

            border: none;

            border-radius: 20px;

            padding: 30px;

            text-align: center;

            height: 100%;

            box-shadow:
                0 10px 25px rgba(0, 0, 0, .08);

            transition: .3s;
        }

        .card-box:hover {

            transform:
                translateY(-8px);

        }

        .icon {

            font-size: 45px;

            margin-bottom: 15px;
        }

        .value {

            font-size: 32px;

            font-weight: bold;
        }

        .subtitle {

            color: #6c757d;
        }

        .btn-custom {

            border-radius: 30px;
            padding: 10px 30px;
        }
    </style>

</head>

<body>

    <div class="container py-5">

        <div class="header">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h1>
                        Prometheus Analytics Dashboard
                    </h1>

                    <p>
                        Custom Laravel Monitoring System
                    </p>

                </div>

                <a href="/dashboard"
                    class="btn btn-light btn-custom">

                    <i class="bi bi-arrow-clockwise"></i>

                    Refresh

                </a>

            </div>

        </div>


        <div class="row g-4">


            <div class="col-md-4">

                <div class="card-box">

                    <div class="icon">
                        👥
                    </div>

                    <div class="value">
                        {{ $users }}
                    </div>

                    <div class="subtitle">
                        Total Users
                    </div>

                </div>

            </div>



            <div class="col-md-4">

                <div class="card-box">

                    <div class="icon">
                        🧠
                    </div>

                    <div class="value">
                        {{ $memory }} MB
                    </div>

                    <div class="subtitle">
                        Memory Usage
                    </div>

                </div>

            </div>



            <div class="col-md-4">

                <div class="card-box">

                    <div class="icon">
                        💾
                    </div>

                    <div class="value">
                        {{ $disk }} GB
                    </div>

                    <div class="subtitle">
                        Disk Space
                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="card-box">

                    <div class="icon">
                        ⏱️
                    </div>

                    <div class="value">
                        {{ $uptime }}
                    </div>

                    <div class="subtitle">
                        Server Uptime
                    </div>

                </div>

            </div>



            <div class="col-md-6">

                <div class="card-box">

                    <div class="icon">
                        📈
                    </div>

                    <div class="value">
                        {{ $cacheRatio }}%
                    </div>

                    <div class="subtitle">
                        Cache Hit Ratio
                    </div>

                </div>

            </div>


        </div>

        <div class="text-center mt-5">

            <a href="/prometheus"
                class="btn btn-primary btn-lg">

                View Raw Metrics

            </a>

        </div>

    </div>

</body>

</html>