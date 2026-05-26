<!DOCTYPE html>
<html>
<head>
    <title>Activity Log</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .table thead {
            background: #0d6efd;
            color: white;
        }

        .badge-activity {
            background: #198754;
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <div class="card p-4">

        <h3 class="mb-4 text-primary">
            📊 User Activity Log
        </h3>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Activity</th>
                        <th>IP Address</th>
                        <th>Time</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($activities as $a)
                        <tr>
                            <td>{{ $a->id }}</td>

                            <td>
                                <span class="badge badge-activity">
                                    {{ $a->activity }}
                                </span>
                            </td>

                            <td>{{ $a->ip_address }}</td>

                            <td>
                                {{ $a->created_at->format('d M Y, h:i A') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No activities found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $activities->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

</body>
</html>