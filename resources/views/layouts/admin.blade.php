<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
    <div class="d-flex">
        <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
            <h4 class="mb-4">Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.jenis_jasa.index') }}">Jenis Jasa</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.transaksi.index') }}">Transaksi</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.laporan.index') }}">Laporan</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.user_admin.index') }}">Admin</a></li>
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger w-100">Logout Admin</button>
                    </form>
                </li>
            </ul>
        </div>

        <div class="flex-1 p-4">
            <h1>@yield('title')</h1>
            @yield('content')
        </div>
    </div>
</body>
</html>