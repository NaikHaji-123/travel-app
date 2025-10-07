<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Poppins", sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: #fff;
            padding: 1rem 1.5rem;
        }

        .card-body {
            background-color: #fff;
            padding: 2rem;
        }

        .detail-label {
            font-weight: 600;
            color: #555;
        }

        .detail-value {
            color: #222;
        }

        .badge-success {
            background-color: #28a745 !important;
        }

        .btn-outline-secondary {
            border-radius: 8px;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }

        .container {
            max-width: 700px;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-receipt"></i> Detail Transaksi</h4>
            </div>

            <div class="card-body">
                {{-- Paket Travel --}}
                <p>
                    <span class="detail-label">Paket:</span> 
                    <span class="detail-value">
                        {{ $transaksi->pendaftaran->paketTravel->nama_paket 
                            ?? $transaksi->pendaftaran->paket 
                            ?? 'Belum dipilih' }}
                    </span>
                </p>

                {{-- Jumlah Pembayaran --}}
                <p>
                    <span class="detail-label">Jumlah Pembayaran:</span> 
                    <span class="detail-value text-success fw-bold">
                        Rp {{ number_format($transaksi->jumlah ?? 0, 0, ',', '.') }}
                    </span>
                </p>

                {{-- Status --}}
                <p>
                    <span class="detail-label">Status:</span> 
                    <span class="badge bg-{{ $transaksi->status == 'acc' ? 'success' : ($transaksi->status == 'pending' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($transaksi->status ?? 'Tidak diketahui') }}
                    </span>
                </p>

                {{-- Tanggal Transaksi --}}
                <p>
                    <span class="detail-label">Tanggal Transaksi:</span> 
                    <span class="detail-value">
                        {{ $transaksi->created_at 
                            ? $transaksi->created_at->format('d/m/Y H:i') 
                            : ($transaksi->updated_at 
                                ? $transaksi->updated_at->format('d/m/Y H:i')
                                : 'Belum tersedia') }}
                    </span>
                </p>

                {{-- Info tambahan jika ada relasi pendaftaran --}}
                @if($transaksi->pendaftaran)
                    <hr>
                    <p>
                        <span class="detail-label">Nama Jamaah:</span> 
                        <span class="detail-value">{{ $transaksi->pendaftaran->user->name ?? '-' }}</span>
                    </p>
                    <p>
                        <span class="detail-label">No. Pendaftaran:</span> 
                        <span class="detail-value">{{ $transaksi->pendaftaran->id }}</span>
                    </p>
                    <p>
                        <span class="detail-label">Tanggal Berangkat:</span> 
                        <span class="detail-value">
                            {{ $transaksi->pendaftaran->paketTravel->tanggal_berangkat 
                                ? \Carbon\Carbon::parse($transaksi->pendaftaran->paketTravel->tanggal_berangkat)->format('d/m/Y')
                                : '-' }}
                        </span>
                    </p>
                @endif

                <div class="mt-4">
                    <a href="{{ route('jamaah.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
