<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Paket Travel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <h2>Tambah Paket Travel</h2>
  <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3"><label>Nama Paket</label><input type="text" name="nama_paket" class="form-control" required></div>
    <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control"></textarea></div>
    <div class="mb-3"><label>Harga</label><input type="number" name="harga" class="form-control" required></div>
    <div class="mb-3"><label>Tanggal Berangkat</label><input type="date" name="tanggal_berangkat" class="form-control" required></div>
    <div class="mb-3"><label>Gambar</label><input type="file" name="gambar" class="form-control"></div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('paket.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</body>
</html>
