<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - PT Syakirasya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .sidebar {
      height: 100vh;
      background-color: #198754;
      padding: 1rem;
      position: sticky;
      top: 0;
    }
    .sidebar a {
      color: white;
      display: block;
      margin-bottom: 1rem;
      text-decoration: none;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      transition: background-color 0.3s;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background-color: #146c43;
      font-weight: bold;
    }
    .topbar {
      background-color: white;
      padding: 1rem 2rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      margin-bottom: 1rem;
      border-radius: 10px;
    }
    .card h6 {
      color: #6c757d;
    }
    .table th, .table td {
      vertical-align: middle;
    }
    .profile-card {
      padding: 1rem;
      background: white;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .profile-card h5 {
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-2 sidebar d-flex flex-column">
        <a href="#dashboard" class="nav-link active" data-bs-toggle="tab">🏠 Dashboard</a>
        <a href="#paket" class="nav-link" data-bs-toggle="tab">📦 Data Paket</a>
        <a href="#pembayaran" class="nav-link" data-bs-toggle="tab">💳 Pembayaran</a>
        <a href="#jamaah" class="nav-link" data-bs-toggle="tab">🧑‍🤝‍🧑 Data Jamaah</a>
        <a href="#transaksi" class="nav-link" data-bs-toggle="tab">📄 Riwayat Transaksi</a>
        <a href="#laporan" class="nav-link" data-bs-toggle="tab">📊 Laporan</a>
        <a href="#profil" class="nav-link" data-bs-toggle="tab">👤 Profil Admin</a>
        <a href="#logout" class="nav-link text-danger mt-auto" onclick="logout()">🚪 Logout</a>
      </nav>

      <!-- Main Content -->
      <main class="col-md-10">
        <div class="topbar d-flex justify-content-between align-items-center">
          <h4 class="mb-0">Admin PT Syakirasya</h4>
          <span class="text-muted">Selamat datang, Admin!</span>
        </div>

        <div class="tab-content px-2">
          <!-- Dashboard -->
          <div class="tab-pane fade show active" id="dashboard">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>⚠️ Notifikasi:</strong> Ada 1 pembayaran baru yang menunggu konfirmasi!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <h5>📊 Statistik Singkat</h5>
            <div class="row g-3">
              <div class="col-md-4">
                <div class="card shadow-sm">
                  <div class="card-body">
                    <h6>Total Paket</h6>
                    <p class="fs-4 fw-semibold text-success">4</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card shadow-sm">
                  <div class="card-body">
                    <h6>Jumlah Pembayaran</h6>
                    <p class="fs-4 fw-semibold text-success">12</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card shadow-sm">
                  <div class="card-body">
                    <h6>Total Jamaah Aktif</h6>
                    <p class="fs-4 fw-semibold text-success">8</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Paket -->
          <div class="tab-pane fade" id="paket">
            <h5 class="mt-3">📦 Data Paket</h5>
            <div class="table-responsive">
              <table class="table table-bordered align-middle">
                <thead class="table-success">
                  <tr>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Jadwal</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Umrah Reguler</td>
                    <td>Rp 28.000.000</td>
                    <td>20 Agustus 2025</td>
                    <td><button class="btn btn-warning btn-sm">Edit</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Pembayaran -->
          <div class="tab-pane fade" id="pembayaran">
            <h5 class="mt-3">💳 Data Pembayaran</h5>
            <div class="table-responsive">
              <table class="table table-bordered align-middle">
                <thead class="table-success">
                  <tr>
                    <th>Nama</th>
                    <th>No. HP</th>
                    <th>Paket</th>
                    <th>Bukti</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>BARAGANTENGLUWCU</td>
                    <td>08123456789</td>
                    <td>Umrah Reguler</td>
                    <td><a href="#" class="btn btn-link btn-sm">Lihat Bukti</a></td>
                    <td><span class="badge bg-warning text-dark">Menunggu</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Data Jamaah -->
          <div class="tab-pane fade" id="jamaah">
            <h5 class="mt-3">🧑‍🤝‍🧑 Data Jamaah</h5>
            <div class="table-responsive">
              <table class="table table-bordered align-middle">
                <thead class="table-success">
                  <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Mukhlis</td>
                    <td>mukhlis@mail.com</td>
                    <td>08987654321</td>
                    <td><span class="badge bg-success">Aktif</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Riwayat Transaksi -->
          <div class="tab-pane fade" id="transaksi">
            <h5 class="mt-3">📄 Riwayat Transaksi</h5>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead class="table-success">
                  <tr>
                    <th>Tanggal</th>
                    <th>Nama Jamaah</th>
                    <th>Paket</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>20/07/2025</td>
                    <td>BARAGANTENGLUWCU</td>
                    <td>Umrah Reguler</td>
                    <td>Rp 28.000.000</td>
                    <td><span class="badge bg-success">Lunas</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Laporan -->
          <div class="tab-pane fade" id="laporan">
            <h5 class="mt-3">📊 Export Laporan</h5>
            <button class="btn btn-outline-success me-2">📥 Export Excel</button>
            <button class="btn btn-outline-danger">📄 Export PDF</button>
          </div>

          <!-- Profil Admin -->
          <div class="tab-pane fade" id="profil">
            <h5 class="mt-3">👤 Profil Admin</h5>
            <div class="profile-card">
              <h5>Nama: baraw</h5>
              <p>Email: bara@syakirasya.co.id</p>
              <p>Terakhir Login: 27 Juli 2025</p>
              <button class="btn btn-outline-primary btn-sm">Ubah Password</button>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const links = document.querySelectorAll('.sidebar a[data-bs-toggle="tab"]');
    const tabs = document.querySelectorAll('.tab-pane');

    links.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();

        links.forEach(l => l.classList.remove('active'));
        tabs.forEach(t => t.classList.remove('show', 'active'));

        this.classList.add('active');
        const targetId = this.getAttribute('href');
        const targetTab = document.querySelector(targetId);
        if (targetTab) targetTab.classList.add('show', 'active');
      });
    });

    function logout() {
      alert('Anda telah logout.');
      window.location.href = 'login.html';
    
    
<form action="{{ route('logout') }}" method="POST" class="mt-auto">
    @csrf
    <button type="submit" class="nav-link text-danger btn btn-link p-0" style="text-decoration:none;">
        🚪 Logout
    </button>
</form>

  
  </script>
</body>
</html>
