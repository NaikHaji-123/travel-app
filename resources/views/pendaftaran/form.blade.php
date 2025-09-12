<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <div class="container">
        <h2 class="mb-4">📝 Form Pendaftaran</h2>

        <form action="{{ route('pendaftaran.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="paket" class="form-label">Pilih Paket</label>
                <select name="paket_id" id="paket" class="form-control">
                    <option value="1">Umrah Reguler</option>
                    <option value="2">Umrah Plus Turki</option>
                    <option value="3">Haji Khusus</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Daftar</button>
        </form>
    </div>

</body>
</html>
