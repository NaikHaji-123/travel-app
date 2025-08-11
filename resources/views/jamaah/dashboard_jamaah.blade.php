<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jamaah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background-color: #28a745;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="#">PT Syakirasya</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="{{ route('jamaah.portal') }}" class="nav-link">Portal</a></li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm ms-2">Logout</button>
            </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4">Selamat Datang, {{ Auth::user()->name }}</h2>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5>Data Pendaftaran</h5>
                <p>Cek status pendaftaran haji/umrah Anda.</p>
                <a href="{{ route('pendaftaran.form') }}" class="btn btn-success btn-sm">Lihat</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5>Informasi Keberangkatan</h5>
                <p>Lihat jadwal dan detail keberangkatan.</p>
                <a href="{{ route('jamaah.portal') }}" class="btn btn-primary btn-sm">Cek</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5>Paket Perjalanan</h5>
                <p>Lihat semua paket haji dan umrah yang tersedia.</p>
                <a href="{{ route('paket.umrah.reguler') }}" class="btn btn-warning btn-sm">Lihat Paket</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
