<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - PT Syakirasya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { background-color: #e9f7fe; font-family: 'Poppins', sans-serif; }
    
    /* Sidebar */
    .sidebar { height: 100vh; background-color: #0d6efd; padding: 1rem; position: sticky; top: 0; border-radius: 0 20px 20px 0; }
    .sidebar a { color: white; display: block; margin-bottom: 1rem; text-decoration: none; padding: 0.5rem 1rem; border-radius: 10px; transition: background-color 0.3s, transform 0.2s; }
    .sidebar a:hover, .sidebar a.active { background-color: #0b5ed7; font-weight: bold; transform: scale(1.02); }
    .sidebar form button { color: #ff6b6b; }

    /* Topbar */
    .topbar { background-color: white; padding: 1rem 2rem; box-shadow: 0 4px 6px rgba(0,0,0,0.08); margin-bottom: 1rem; border-radius: 12px; }

    /* Cards */
    .card { border: none; border-radius: 12px; transition: transform 0.2s; }
    .card:hover { transform: translateY(-5px); }
    .card h6 { color: #6c757d; }

    /* Tables */
    .table th, .table td { vertical-align: middle; }
    .table thead { background-color: #0d6efd; color: white; }
    .btn-primary { background-color: #0d6efd; border: none; }
    .btn-primary:hover { background-color: #0b5ed7; }

    /* Buttons */
    .btn-success { background-color: #0dcaf0; border: none; color: #fff; }
    .btn-success:hover { background-color: #0aa5c0; }
    .btn-warning { background-color: #ffc107; border: none; color: #212529; }
    .btn-warning:hover { background-color: #e0a800; }
    .btn-danger { background-color: #ff6b6b; border: none; color: white; }
    .btn-danger:hover { background-color: #ff4c4c; }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      
      <!-- Sidebar -->
      <nav class="col-md-2 sidebar d-flex flex-column">
        <a href="#dashboard" class="nav-link active" data-bs-toggle="tab">🏠 Dashboard</a>
        <a href="#paket" class="nav-link" data-bs-toggle="tab">📦 Data Paket</a>
        <a href="#jamaah" class="nav-link" data-bs-toggle="tab">🧑‍🤝‍🧑 Data Jamaah</a>
        <form action="{{ route('logout') }}" method="POST" class="mt-auto">
            @csrf
            <button type="submit" class="nav-link text-danger btn btn-link p-0 w-100 text-start" style="text-decoration:none;">
                🚪 Logout
            </button>
        </form>
      </nav>

      <!-- Main Content -->
      <main class="col-md-10">
        <div class="topbar d-flex justify-content-between align-items-center">
          <h4 class="mb-0">Admin PT Syakirasya</h4>
          <span class="text-muted">Selamat datang, {{ Auth::user()->nama ?? 'Admin' }}!</span>
        </div>

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="tab-content px-2">
          <!-- Dashboard -->
          <div class="tab-pane fade show active" id="dashboard">
            <div class="row g-3">
              <div class="col-md-4">
                <div class="card shadow-sm">
                  <div class="card-body text-center">
                    <h6>Total Paket</h6>
                    <p class="fs-4 fw-semibold text-primary">{{ $totalPaket }}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card shadow-sm">
                  <div class="card-body text-center">
                    <h6>Jumlah Pembayaran</h6>
                    <p class="fs-4 fw-semibold text-primary">{{ $totalPembayaran }}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card shadow-sm">
                  <div class="card-body text-center">
                    <h6>Total Jamaah</h6>
                    <p class="fs-4 fw-semibold text-primary">{{ $totalJamaah }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Paket -->
          <div class="tab-pane fade" id="paket">
            <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
              <h5>📦 Data Paket</h5>
              <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahPaket">➕ Tambah Paket</button>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead><tr><th>Nama Paket</th><th>Harga</th><th>Jadwal</th><th>Aksi</th></tr></thead>
                <tbody>
                  @foreach($pakets as $paket)
                  <tr>
                    <td>{{ $paket->nama_paket }}</td>
                    <td>Rp {{ number_format($paket->harga,0,',','.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($paket->tanggal_berangkat)->format('d M Y') }}</td>
                    <td>
                      <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPaket{{ $paket->id }}">✏️ Edit</button>
                      <form action="{{ route('paket.destroy',$paket->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus paket ini?')">🗑 Hapus</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <!-- Data Jamaah -->
          <div class="tab-pane fade" id="jamaah">
            <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
              <h5>🧑‍🤝‍🧑 Data Jamaah</h5>
              <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahJamaah">➕ Tambah Jamaah</button>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead><tr><th>Nama</th><th>Email</th><th>No. HP</th><th>Aksi</th></tr></thead>
                <tbody>
                  @foreach($jamaah as $j)
                  <tr>
                    <td>{{ $j->nama }}</td>
                    <td>{{ $j->email }}</td>
                    <td>{{ $j->no_hp }}</td>
                    <td>
                      <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editJamaah{{ $j->id }}">✏️ Edit</button>
                      <form action="{{ route('jamaah.destroy',$j->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus jamaah ini?')">🗑 Hapus</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // sidebar nav
    const links = document.querySelectorAll('.sidebar a[data-bs-toggle="tab"]');
    const tabs = document.querySelectorAll('.tab-pane');
    links.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        links.forEach(l => l.classList.remove('active'));
        tabs.forEach(t => t.classList.remove('show','active'));
        this.classList.add('active');
        document.querySelector(this.getAttribute('href')).classList.add('show','active');
      });
    });
  </script>
</body>
</html>
