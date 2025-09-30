<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Paket Travel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8f9fa; font-family: Arial, sans-serif; }
    .sidebar { height: 100vh; background: #198754; padding: 1rem; position: fixed; left:0; top:0; width:220px; }
    .sidebar a { color: white; display: block; margin: 10px 0; text-decoration: none; padding: 8px 12px; border-radius: 6px; }
    .sidebar a:hover { background:#146c43; }
    .main { margin-left: 240px; padding: 20px; }
  </style>
</head>
<body>
  <div class="sidebar">
    <h5 class="text-white">Admin Panel</h5>
    <a href="{{ route('paket.index') }}">📦 Paket Travel</a>
    <form action="{{ route('logout') }}" method="POST" class="mt-3">
      @csrf
      <button class="btn btn-danger w-100">🚪 Logout</button>
    </form>
  </div>

  <div class="main">
    <h2>Manajemen Paket Travel</h2>
    <a href="{{ route('paket.create') }}" class="btn btn-primary mb-3">+ Tambah Paket</a>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
      <thead class="table-success">
        <tr>
          <th>Nama Paket</th>
          <th>Harga</th>
          <th>Tanggal Berangkat</th>
          <th>Gambar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pakets as $paket)
        <tr>
          <td>{{ $paket->nama_paket }}</td>
          <td>Rp {{ number_format($paket->harga,0,',','.') }}</td>
          <td>{{ $paket->tanggal_berangkat }}</td>
          <td>
            @if($paket->gambar)
              <img src="{{ asset('storage/'.$paket->gambar) }}" width="100">
            @endif
          </td>
          <td>
            <a href="{{ route('paket.edit',$paket) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
            <form action="{{ route('paket.destroy',$paket) }}" method="POST" style="display:inline;">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus paket ini?')">🗑 Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
