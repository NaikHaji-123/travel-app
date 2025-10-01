<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - PT Syakirasya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
    .sidebar { height: 100vh; background-color: #008cffff; padding: 1rem; position: sticky; top: 0; }
    .sidebar a { color: white; display: block; margin-bottom: 1rem; text-decoration: none; padding: 0.5rem 1rem; border-radius: 6px; transition: background-color 0.3s; }
    .sidebar a:hover, .sidebar a.active { background-color:  #008cffff; font-weight: bold; }
    .topbar { background-color: white; padding: 1rem 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1rem; border-radius: 10px; }
    .card h6 { color: #6c757d; }
    .table th, .table td { vertical-align: middle; }
    .profile-card { padding: 1rem; background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    .profile-card h5 { font-weight: 600; }
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
      <a href="#booking" class="nav-link" data-bs-toggle="tab">📋 Booking Jamaah</a>
      <a href="#profil" class="nav-link" data-bs-toggle="tab">👤 Profil Admin</a>
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

      <div class="tab-content px-2">
        <!-- Dashboard -->
        <div class="tab-pane fade show active" id="dashboard">
          <h5>📊 Statistik Singkat</h5>
          <div class="row g-3">
            <div class="col-md-4">
              <div class="card shadow-sm">
                <div class="card-body">
                  <h6>Total Paket</h6>
                  <p class="fs-4 fw-semibold text-success">{{ $totalPaket }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card shadow-sm">
                <div class="card-body">
                  <h6>Total Jamaah</h6>
                  <p class="fs-4 fw-semibold text-success">{{ $totalJamaah }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Data Paket -->
        <div class="tab-pane fade" id="paket">
          <h5 class="mt-3">📦 Data Paket</h5>
          <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#tambahPaketModal">➕ Tambah Paket</button>
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <thead class="table-success">
                <tr>
                  <th>Gambar</th>
                  <th>Nama Paket</th>
                  <th>Harga</th>
                  <th>Jadwal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pakets as $paket)
                <tr>
                  <td>
                    @if($paket->gambar)
                      <img src="{{ asset('storage/'.$paket->gambar) }}" alt="Gambar Paket" width="80">
                    @else
                      -
                    @endif
                  </td>
                  <td>{{ $paket->nama_paket }}</td>
                  <td>Rp {{ number_format($paket->harga,0,',','.') }}</td>
                  <td>{{ \Carbon\Carbon::parse($paket->tanggal_berangkat)->format('d M Y') }}</td>
                  <td>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editPaketModal{{ $paket->id }}">Edit</button>
                    <form action="{{ route('paket.destroy',$paket->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus paket ini?')">Hapus</button>
                    </form>
                  </td>
                </tr>

                <!-- Modal Edit Paket -->
                <div class="modal fade" id="editPaketModal{{ $paket->id }}" tabindex="-1">
                  <div class="modal-dialog">
                    <form action="{{ route('paket.update',$paket->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Edit Paket</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label>Nama Paket</label>
                            <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" required>
                          </div>
                          <div class="mb-3">
                            <label>Harga</label>
                            <input type="number" name="harga" class="form-control" value="{{ $paket->harga }}" required>
                          </div>
                          <div class="mb-3">
                            <label>Tanggal Berangkat</label>
                            <input type="date" name="tanggal_berangkat" class="form-control" value="{{ $paket->tanggal_berangkat->format('Y-m-d') }}" required>
                          </div>
                          <div class="mb-3">
                            <label>Gambar Paket</label>
                            <input type="file" name="gambar" class="form-control">
                            @if($paket->gambar)
                              <img src="{{ asset('storage/'.$paket->gambar) }}" width="100" class="mt-2">
                            @endif
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Modal Tambah Paket -->
        <div class="modal fade" id="tambahPaketModal" tabindex="-1">
          <div class="modal-dialog">
            <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Paket</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label>Nama Paket</label>
                    <input type="text" name="nama_paket" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label>Tanggal Berangkat</label>
                    <input type="date" name="tanggal_berangkat" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label>Gambar Paket</label>
                    <input type="file" name="gambar" class="form-control">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success">Tambah</button>
                  </div>
          <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Tambah</button>
        </div>
                </div>
              <div>
            </form>
          </div>
        </div>

        <!-- Data Jamaah -->
        <div class="tab-pane fade" id="jamaah">
          <h5 class="mt-3">🧑‍🤝‍🧑 Data Jamaah</h5>
          <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#tambahJamaahModal">➕ Tambah Jamaah</button>
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <thead class="table-success">
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No. HP</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($jamaah as $j)
                <tr>
                  <td>{{ $j->nama }}</td>
                  <td>{{ $j->email }}</td>
                  <td>{{ $j->no_hp }}</td>
                  <td><span class="badge bg-success">Aktif</span></td>
                  <td>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editJamaahModal{{ $j->id }}">Edit</button>
                    <form action="{{ route('jamaah.destroy',$j->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus jamaah ini?')">Hapus</button>
                    </form>
                  </td>
                </tr>

                <!-- Modal Edit Jamaah -->
                <div class="modal fade" id="editJamaahModal{{ $j->id }}" tabindex="-1">
                  <div class="modal-dialog">
                    <form action="{{ route('jamaah.update',$j->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Edit Jamaah</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $j->nama }}" required>
                          </div>
                          <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $j->email }}" required>
                          </div>
                          <div class="mb-3">
                            <label>No. HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ $j->no_hp }}" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Modal Tambah Jamaah -->
        <div class="modal fade" id="tambahJamaahModal" tabindex="-1">
          <div class="modal-dialog">
            <form action="{{ route('jamaah.store') }}" method="POST">
              @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Jamaah</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label>No. HP</label>
                    <input type="text" name="no_hp" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success">Tambah</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="tab-pane fade" id="booking">
  <h5 class="mt-3">📋 Booking Jamaah</h5>
  <div class="table-responsive">
    <table class="table table-bordered align-middle">
      <thead class="table-success">
        <tr>
          <th>Nama</th>
          <th>HP</th>
          <th>Paket</th>
          <th>Bukti</th>
          <th>Catatan</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($bookings as $b)
        <tr>
          <td>{{ $b->nama }}</td>
          <td>{{ $b->hp }}</td>
          <td>{{ $b->paket }}</td>
          <td>
            @if($b->bukti)
              <a href="{{ asset('storage/'.$b->bukti) }}" target="_blank">Lihat</a>
            @else
              -
            @endif
          </td>
          <td>{{ $b->catatan ?? '-' }}</td>
          <td>
            @if($b->status == 'pending')
              <span class="badge bg-warning">Pending</span>
            @elseif($b->status == 'acc')
              <span class="badge bg-success">ACC</span>
            @else
              <span class="badge bg-danger">Ditolak</span>
            @endif
          </td>
          <td>
            @if($b->status == 'pending')
              <form action="{{ route('admin.booking.acc', $b->id) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-success">ACC</button>
              </form>
              <form action="{{ route('admin.booking.tolak', $b->id) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-danger">Tolak</button>
              </form>
            @elseif($b->status == 'acc')
              <a href="{{ route('invoice.create', $b->id) }}" class="btn btn-sm btn-primary">Buat Invoice</a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


        <!-- Profil Admin -->
        <div class="tab-pane fade" id="profil">
          <h5 class="mt-3">👤 Profil Admin</h5>
          <div class="profile-card">
            <h5>Nama: {{ Auth::user()->nama ?? 'Admin' }}</h5>
            <p>Email: {{ Auth::user()->email ?? '-' }}</p>
            <p>Terakhir Login: {{ Auth::user()->last_login ?? '-' }}</p>
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
    link.addEventListener('click', function(e){
      e.preventDefault();
      links.forEach(l => l.classList.remove('active'));
      tabs.forEach(t => t.classList.remove('show','active'));
      this.classList.add('active');
      const targetId = this.getAttribute('href');
      const targetTab = document.querySelector(targetId);
      if(targetTab) targetTab.classList.add('show','active');
    });
  });
</script>
</body>
</html>
