<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Jamaah - Nama Perusahaan Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        
        :root {
            --bs-primary-navy: #003366; /* Navy Blue/Biru Tua - Warna Utama Perusahaan */
            --bs-accent-gold: #ffc107; /* Kuning Emas - Warna Aksen/Highlight */
            --bs-background-light: #f4f7f9; /* Background yang lebih lembut */
        }

        body {
            background-color: var(--bs-background-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Mengembalikan font jika tidak ada Poppins */
        }
        
        /* Header Dashboard */
        .dashboard-header {
            background: linear-gradient(135deg, var(--bs-primary-navy), #004080);
            color: #fff;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 51, 102, 0.2);
        }

        /* Kartu Status Aktif */
        .card-info {
            /* Warna border emas untuk highlight */
            border-left: 6px solid var(--bs-accent-gold); 
            border-radius: .75rem;
            box-shadow: 0 4px 15px rgba(0,0,0,.05);
            transition: all 0.3s ease;
        }
        .card-info:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,.1);
            transform: translateY(-3px);
        }
        
        /* Gaya list detail status pendaftaran */
        .card-info p {
            margin-bottom: 0.75rem; /* Memberi jarak antar baris */
            line-height: 1.5;
        }
        /* Menggunakan warna aksen untuk ikon */
        .card-info .bi-box-seam { color: #0d6efd !important; } /* Biru untuk Paket */
        .card-info .bi-calendar-event { color: #198754 !important; } /* Hijau untuk Tanggal */
        .card-info .bi-info-circle { color: var(--bs-accent-gold) !important; } /* Emas untuk Status */
        .card-info .bi-cash-coin { color: #20c997 !important; } /* Teal/Hijau Cerah untuk Pembayaran */

        /* Tabel yang Serasi */
        .table thead {
            background: var(--bs-primary-navy);
            color: #fff;
        }
        
        /* Badge Status */
        .status-badge {
            padding: .4rem .75rem;
            border-radius: 1rem;
            font-weight: 600;
        }

        /* Styling Paket */
        .section-heading {
            color: var(--bs-primary-navy);
            border-bottom: 2px solid var(--bs-accent-gold);
            padding-bottom: 0.5rem;
        }
        .paket-scroll-container {
            display: flex;
            gap: 1.5rem; 
            overflow-x: auto;
            padding-bottom: 1.5rem;
        }
        .paket-card {
            min-width: 250px; 
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }
        .paket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .paket-card img {
            height: 180px; 
            object-fit: cover;
            width: 100%;
        }
        .paket-card-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        /* Floating WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 20px;
            background-color: #25d366;
            color: #fff;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        .whatsapp-float:hover {
            background-color: #128c7e;
            color: #fff;
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<div class="container my-5">

    {{-- Header Dashboard --}}
    <div class="dashboard-header mb-5 d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bolder"><i class="bi bi-person-circle text-warning me-2"></i> Selamat Datang, {{ $user->nama ?? 'Jamaah' }}</h2>
            <p class="lead mt-2 mb-0 opacity-75">Kelola informasi pendaftaran dan paket perjalanan ibadah Anda.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin keluar dari akun ini?')">
                @csrf
                <button type="submit" class="btn btn-outline-light shadow-sm px-4">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="row g-5"> 


        <div class="col-lg-5">
            <h4 class="mb-4 section-heading"><i class="bi bi-clipboard-check me-2"></i> Status Pendaftaran Aktif</h4>
            @if($pendaftaran)
                <div class="card shadow card-info">
                    <div class="card-body">
                        
                        <p><i class="bi bi-box-seam me-2 text-primary"></i> 
                            <strong>Paket:</strong> {{ $pendaftaran->paketTravel->nama_paket ?? $pendaftaran->paket ?? '-' }}
                        </p>
                        
                        <p><i class="bi bi-calendar-event me-2 text-success"></i> 
                            <strong>Tanggal Berangkat:</strong>
                            {{ $pendaftaran->paketTravel && $pendaftaran->paketTravel->tanggal_berangkat 
                                ? $pendaftaran->paketTravel->tanggal_berangkat->format('d F Y') 
                                : '-' }}
                        </p>
                        
                        <p><i class="bi bi-info-circle me-2 text-warning"></i> 
                            <strong>Status:</strong> 
                            {{-- Menggunakan warna badge sesuai status --}}
                            @php
                                $status = $pendaftaran->status ?? '-';
                                $color = [
                                    'Lunas' => 'success', 
                                    'Pending' => 'warning', 
                                    'Batal' => 'danger',
                                    'Terkonfirmasi' => 'primary'
                                ][$status] ?? 'secondary';
                            @endphp
                            <span class="status-badge bg-{{ $color }} text-white">{{ $status }}</span>
                        </p>
                        
                       <p>Total Pembayaran Terkumpul: Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</p>


                    </div>
                </div>
                <small class="text-muted mt-3 d-block fst-italic">Hubungi admin untuk mengunggah dokumen atau konfirmasi pembayaran.</small>
            @else
                <div class="alert alert-info shadow-sm border-0 py-3">
                    <i class="bi bi-info-circle-fill me-2"></i> Informasi: Anda belum memiliki pendaftaran aktif. Silakan pilih paket di bawah.
                </div>
            @endif
        </div>
        
        {{-- Riwayat Pendaftaran & Booking (Kolom Kanan) --}}
        <div class="col-lg-7">
            <h4 class="mb-4 section-heading"><i class="bi bi-journal-text me-2"></i> Riwayat Pendaftaran</h4>
            @if($riwayat->count())
                <div class="card shadow">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-start ps-4"><i class="bi bi-box-seam"></i> Paket</th>
                                    <th><i class="bi bi-calendar-event"></i> Berangkat</th>
                                    <th><i class="bi bi-check2-circle"></i> Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($riwayat as $r)
    @php
        // Skip data kosong (tanpa paket & tanpa nama)
        if (
            empty($r->paketTravel) &&
            empty($r->paket)
        ) continue;
    @endphp

    <tr>
        {{-- Nama Paket --}}
        <td class="text-start ps-4 fw-medium">
            {{ $r->paketTravel->nama_paket ?? $r->paket ?? '-' }}
        </td>

        {{-- Tanggal Berangkat --}}
        <td class="text-center">
            @php
                $tanggal = $r->paketTravel->tanggal_berangkat ?? $r->tanggal_berangkat ?? null;
            @endphp
            {{ $tanggal ? \Carbon\Carbon::parse($tanggal)->format('d/m/Y') : '-' }}
        </td>

        {{-- Status --}}
        <td class="text-center">
            @php
                $status = ucfirst($r->status ?? '-');
                $color = match ($status) {
                    'Lunas' => 'success',
                    'Pending' => 'warning',
                    'Batal' => 'danger',
                    'Acc', 'Terkonfirmasi' => 'primary',
                    default => 'secondary',
                };
            @endphp
            <span class="badge bg-{{ $color }}">{{ $status }}</span>
        </td>

        {{-- Tombol Detail --}}
        <td class="text-center">
            <a href="{{ route('jamaah.transaksi.show', $r->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat detail pembayaran">
    <i class="bi bi-eye"></i>
</a>
        </td>
    </tr>
@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p class="text-muted fst-italic py-3 px-2">Tidak ada riwayat pendaftaran atau booking yang tercatat.</p>
            @endif
        </div>

    </div>

    ---

    {{-- Paket dari Admin - Jelajahi Paket Terbaru --}}
    <section id="paket" class="section pt-5 pb-3">
        <h3 class="fw-bold mb-4 section-heading"><i class="bi bi-tags me-2"></i> Jelajahi Paket Terbaru</h3>

        @if($pakets->count())
            <div class="paket-scroll-container">
                @foreach($pakets as $paket)
                    <div class="paket-card">
                        @if($paket->gambar)
                            <img src="{{ asset('storage/'.$paket->gambar) }}" 
                                 alt="{{ $paket->nama_paket }}" class="img-fluid">
                        @else
                            <div class="d-flex justify-content-center align-items-center" style="height: 180px; background-color: #e9ecef;">
                                <i class="bi bi-image-fill text-secondary fs-3"></i>
                            </div>
                        @endif
                        <div class="paket-card-body">
                            <h6 class="fw-bolder mb-2 text-primary-navy">{{ $paket->nama_paket ?? 'Paket Ibadah' }}</h6>
                            <p class="text-muted small mb-3 flex-grow-1">
                                {{ \Illuminate\Support\Str::limit($paket->deskripsi ?? 'Deskripsi paket belum tersedia.', 70) }}
                            </p>
                            <p class="fw-bolder text-accent-gold fs-5 mb-3">
                                Rp {{ number_format($paket->harga ?? 0, 0, ',', '.') }}
                            </p>
                            @php
    // Cek apakah jamaah masih punya pendaftaran aktif
    $punyaPendaftaranAktif = $pendaftaran && in_array(strtolower($pendaftaran->status), ['pending', 'proses']);
@endphp

@if ($punyaPendaftaranAktif)
    <button class="btn btn-secondary w-100 mt-auto" disabled data-bs-toggle="tooltip" data-bs-placement="top" title="Anda sudah mendaftar, tunggu konfirmasi admin.">
        Menunggu Konfirmasi <i class="bi bi-hourglass-split"></i>
    </button>
@else
    <a href="{{ route('pendaftaran.form', ['paket' => $paket->id]) }}" 
       class="btn btn-outline-primary w-100 mt-auto">
        Daftar Sekarang <i class="bi bi-arrow-right"></i>
    </a>
@endif

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-secondary border-0 py-3">
                <i class="bi bi-x-octagon-fill me-2"></i> **Maaf:** Belum ada paket perjalanan yang tersedia saat ini.
            </div>
        @endif
    </section>
    
    <div class="text-center mt-5 p-3 border-top">
        <p class="mb-1 text-muted">Butuh Bantuan? Hubungi Admin Kami:</p>
        <p class="fw-bold text-primary-navy">
            <i class="bi bi-whatsapp me-2"></i> Nomor Admin: +62 812-3456-7890
        </p>
    </div>

</div>

{{-- Floating WhatsApp Button (Penting: Ganti nomor di href) --}}
<a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20bertanya%20tentang%20status%20pendaftaran%20saya." 
   class="whatsapp-float" 
   target="_blank" 
   data-bs-toggle="tooltip" 
   data-bs-placement="left" 
   title="Hubungi Kami via WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Inisialisasi Tooltip Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
</body>
</html>