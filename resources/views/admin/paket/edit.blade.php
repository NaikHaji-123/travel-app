<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Paket Travel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <h2>Edit Paket Travel</h2>
  <form action="{{ route('paket.update',$paket) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3"><label>Nama Paket</label><input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" required></div>
    <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control">{{ $paket->deskripsi }}</textarea></div>
    <div class="mb-3"><label>Harga</label><input type="number" name="harga" class="form-control" value="{{ $paket->harga }}" required></div>
    <div class="mb-3"><label>Tanggal Berangkat</label><input type="date" name="tanggal_berangkat" class="form-control" value="{{ $paket->tanggal_berangkat }}" required></div>
    <div class="mb-3">
      <label>Gambar</label><br>
      @if($paket->gambar)
        <img src="{{ asset('storage/'.$paket->gambar) }}" width="120" class="mb-2"><br>
      @endif
      <input type="file" name="gambar" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('paket.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</body>
</html>
