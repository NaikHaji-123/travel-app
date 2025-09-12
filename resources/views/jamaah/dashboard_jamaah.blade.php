<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jamaah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-header {
            background: linear-gradient(90deg, #198754, #20c997);
            color: #fff;
            padding: 2rem 1rem;
            border-radius: .5rem;
        }
        .card-info p {
            margin-bottom: .5rem;
        }
    </style>
</head>
<body>

<div class="container my-4">
    {{-- Header --}}
    <div class="dashboard-header mb-4 text-center">
        <h2 class="mb-0">Selamat Datang, {{ $user->name }}</h2>
        <p class="lead mt-2">Dashboard Jamaah – Pantau pendaftaran dan riwayat perjalanan haji Anda</p>
    </div>

    {{-- Informasi Pendaftaran Terbaru --}}
    <h4 class="mb-3">📌 Pendaftaran Terbaru</h4>
    @if($pendaftaran)
        <div class="card shadow-sm mb-4">
            <div class="card-body card-info">
                <p><strong>Paket:</strong> {{ $pendaftaran->paketTravel->nama ?? '-' }}</p>
                <p><strong>Tanggal Berangkat:</strong>
                    {{ optional($pendaftaran->paketTravel->tanggal_berangkat)->format('d F Y') ?? '-' }}
                </p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-primary">{{ $pendaftaran->status ?? '-' }}</span>
                </p>
                <p><strong>Total Bayar:</strong>
                    <span class="text-success fw-bold">
                        Rp {{ number_format($pendaftaran->pembayaran->jumlah ?? 0, 0, ',', '.') }}
                    </span>
                </p>
            </div>
        </div>
    @else
        <div class="alert alert-warning">Belum ada pendaftaran.</div>
        <a href="{{ url('/#paket') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Daftar Sekarang
        </a>
    @endif

    <hr class="my-5">

    {{-- Riwayat Pendaftaran --}}
    <h4 class="mb-3">📜 Riwayat Pendaftaran</h4>
    @if($riwayat->count())
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-success">
                    <tr class="text-center">
                        <th>Paket</th>
                        <th>Tanggal Berangkat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $r)
                        <tr>
                            <td>{{ $r->paketTravel->nama ?? '-' }}</td>
                            <td>{{ optional($r->paketTravel->tanggal_berangkat)->format('d F Y') ?? '-' }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $r->status ?? '-' }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-muted">Tidak ada riwayat pendaftaran.</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
