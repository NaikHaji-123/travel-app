<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Jamaah - PT Syakirasya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }
    .navbar {
      background-color: #1A5D1A;
    }
    .navbar-brand, .navbar-nav .nav-link {
      color: white !important;
    }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .section-title {
      margin-top: 40px;
      margin-bottom: 20px;
      font-weight: 600;
    }
    .timeline {
      position: relative;
      padding-left: 30px;
    }
    .timeline::before {
      content: "";
      position: absolute;
      left: 10px;
      top: 0;
      bottom: 0;
      width: 2px;
      background-color: #1A5D1A;
    }
    .timeline-item {
      position: relative;
      margin-bottom: 20px;
    }
    .timeline-item::before {
      content: "";
      position: absolute;
      left: -2px;
      top: 0;
      width: 12px;
      height: 12px;
      background-color: #1A5D1A;
      border-radius: 50%;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">PT Syakirasya</a>
    <div class="ms-auto">
      <span class="text-white me-3">Halo, Jamaah!</span>
      <form action="{{ route('logout') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
</form>
    </div>
  </div>
</nav>

<!-- Content -->
<div class="container py-4">
  <h4 class="mb-3">📋 Dashboard Jamaah</h4>

  <!-- Alert Pengumuman -->
  <div class="alert alert-info" role="alert">
    📢 Manasik Umrah akan dilaksanakan pada <strong>30 Agustus 2025</strong> secara offline di Aula Masjid Besar.
  </div>

  <!-- Profil Jamaah -->
  <div class="card mb-4">
    <div class="card-body">
      <h5>👤 Profil Anda</h5>
      <div class="row">
        <div class="col-md-4">
          <p><strong>Nama:</strong> MUKHLIS</p>
          <p><strong>Email:</strong> mukhlis@mail.com</p>
        </div>
        <div class="col-md-4">
          <p><strong>No HP:</strong> 08123456789</p>
          <p><strong>Tanggal Daftar:</strong> 20 Juli 2025</p>
        </div>
        <div class="col-md-4 text-end">
          <a href="#" class="btn btn-outline-success btn-sm">✏️ Edit Profil</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Paket Umrah -->
  <h5 class="section-title">🧳 Paket Anda</h5>
  <div class="card mb-3">
    <div class="card-body">
      <p><strong>Nama Paket:</strong> Umrah Plus Turki</p>
      <p><strong>Harga:</strong> Rp 38.000.000</p>
      <p><strong>Keberangkatan:</strong> 15 September 2025</p>
      <a href="#" class="btn btn-primary btn-sm">📄 Cetak Invoice</a>
    </div>
  </div>

  <!-- Status Pembayaran -->
  <h5 class="section-title">💳 Pembayaran</h5>
  <div class="card mb-3">
    <div class="card-body">
      <p><strong>Status:</strong> <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span></p>
      <p><strong>Bukti Transfer:</strong> <a href="#" class="btn btn-link btn-sm">Lihat</a></p>
      <a href="#" class="btn btn-success btn-sm">📤 Upload Bukti Baru</a>
    </div>
  </div>

  <!-- Riwayat Paket -->
  <h5 class="section-title">📚 Riwayat Pendaftaran</h5>
  <div class="card mb-3">
    <div class="card-body">
      <table class="table table-bordered">
        <thead class="table-success">
          <tr>
            <th>Paket</th>
            <th>Tanggal</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Umrah Reguler</td>
            <td>15 Januari 2025</td>
            <td><span class="badge bg-success">Selesai</span></td>
          </tr>
          <tr>
            <td>Umrah Plus Turki</td>
            <td>20 Juli 2025</td>
            <td><span class="badge bg-warning text-dark">Menunggu</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Timeline Perjalanan -->
  <h5 class="section-title">🕓 Timeline Keberangkatan</h5>
  <div class="card mb-3">
    <div class="card-body">
      <div class="timeline">
        <div class="timeline-item">
          <p><strong>20 Juli 2025</strong> - Pendaftaran dan Pembayaran</p>
        </div>
        <div class="timeline-item">
          <p><strong>30 Agustus 2025</strong> - Manasik Umrah</p>
        </div>
        <div class="timeline-item">
          <p><strong>15 September 2025</strong> - Keberangkatan</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Progress Keberangkatan -->
  <h5 class="section-title">📊 Progress Keberangkatan</h5>
  <div class="card mb-3">
    <div class="card-body">
      <div class="progress mb-2">
        <div class="progress-bar bg-success" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
          70% - Persiapan Berjalan
        </div>
      </div>
      <small>Status saat ini: Sudah Manasik</small>
    </div>
  </div>

  <!-- Countdown Keberangkatan -->
  <h5 class="section-title">🕒 Countdown Keberangkatan</h5>
  <div class="card mb-3">
    <div class="card-body">
      <p id="countdown" class="fs-5 text-success fw-semibold"></p>
    </div>
  </div>

  <!-- Bantuan -->
  <h5 class="section-title">❓ FAQ & Bantuan</h5>
  <div class="card mb-5">
    <div class="card-body">
      <p><strong>Belum menerima konfirmasi?</strong> Silakan hubungi admin melalui WhatsApp: <a href="https://wa.me/6281234567890" class="btn btn-outline-success btn-sm">Chat Admin</a></p>
      <p><strong>Masalah pembayaran?</strong> Kirim ulang bukti melalui halaman <em>Pembayaran</em>.</p>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const keberangkatan = new Date("2025-09-15T00:00:00").getTime();
  const timer = setInterval(function() {
    const now = new Date().getTime();
    const selisih = keberangkatan - now;

    const hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
    const jam = Math.floor((selisih % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const menit = Math.floor((selisih % (1000 * 60 * 60)) / (1000 * 60));

    document.getElementById("countdown").innerHTML = `Tinggal ${hari} hari ${jam} jam ${menit} menit lagi`;

    if (selisih < 0) {
      clearInterval(timer);
      document.getElementById("countdown").innerHTML = "Sudah Berangkat!";
    }
  }, 1000);
  function logout() {
    // Hapus status login (misalnya pakai localStorage)
    localStorage.removeItem("login");

    // Redirect ke halaman login
    window.location.href = "{{ route('login') }}";
  }
</script>
</body>
</html>
