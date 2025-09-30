<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jamaah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f3f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .dashboard-header {
            background: linear-gradient(135deg, #198754, #20c997);
            color: #fff;
            padding: 1.5rem;
            border-radius: .75rem;
            box-shadow: 0 4px 15px rgba(0,0,0,.1);
        }
        .card-info {
            border-left: 5px solid #198754;
        }
        .table thead {
            background: #198754;
            color: #fff;
        }
        .status-badge {
            padding: .4rem .75rem;
            border-radius: 1rem;
        }
    </style>
</head>
<body>

<div class="container my-4">

    {{-- Header --}}
    <div class="dashboard-header mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-0"><i class="bi bi-person-circle"></i> Selamat Datang, {{ $user->name }}</h2>
            <p class="lead mt-2 mb-0">Pantau status & riwayat pendaftaran haji Anda</p>
        </div>
        <div>
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?')">
                @csrf
                <button type="submit" class="btn btn-light btn-sm shadow-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4">

        {{-- Status Pendaftaran Aktif --}}
        <div class="col-md-5">
            <h4 class="mb-3"><i class="bi bi-clipboard-check"></i> Status Pendaftaran Aktif</h4>
            @if($pendaftaran)
                <div class="card shadow-sm card-info">
                    <div class="card-body">
                        <p><i class="bi bi-box-seam text-success"></i> <strong>Paket:</strong> {{ $pendaftaran->paketTravel->nama ?? '-' }}</p>
                        <p><i class="bi bi-calendar-event text-primary"></i> <strong>Tanggal Berangkat:</strong>
                            {{ optional($pendaftaran->paketTravel->tanggal_berangkat)->format('d F Y') ?? '-' }}
                        </p>
                        <p><i class="bi bi-info-circle text-warning"></i> <strong>Status:</strong> 
                            <span class="status-badge bg-primary text-white">{{ $pendaftaran->status ?? '-' }}</span>
                        </p>
                        <p><i class="bi bi-cash-coin text-success"></i> <strong>Total Bayar:</strong>
                            <span class="text-success fw-bold">
                                Rp {{ number_format($pendaftaran->pembayaran->jumlah ?? 0, 0, ',', '.') }}
                            </span>
                        </p>
                    </div>
                </div>
            @else
                <div class="alert alert-warning shadow-sm">Belum ada pendaftaran aktif.</div>
                <a href="{{ url('/#paket') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Daftar Sekarang
                </a>
            @endif
        </div>

        {{-- Riwayat Pendaftaran --}}
        <div class="col-md-7">
            <h4 class="mb-3"><i class="bi bi-journal-text"></i> Riwayat Pendaftaran</h4>
            @if($riwayat->count())
                <div class="table-responsive shadow-sm">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead>
                            <tr class="text-center">
                                <th><i class="bi bi-box-seam"></i> Paket</th>
                                <th><i class="bi bi-calendar-event"></i> Tanggal Berangkat</th>
                                <th><i class="bi bi-check2-circle"></i> Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $r)
                                <tr>
                                    <td>{{ $r->paketTravel->nama ?? '-' }}</td>
                                    <td>{{ optional($r->paketTravel->tanggal_berangkat)->format('d F Y') ?? '-' }}</td>
                                    <td class="text-center">
                                        @php
                                            $color = $r->status == 'Lunas' ? 'success' : ($r->status == 'Pending' ? 'warning' : 'secondary');
                                        @endphp
                                        <span class="badge bg-{{ $color }}">{{ $r->status ?? '-' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted fst-italic">Tidak ada riwayat pendaftaran.</p>
            @endif
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
