<!-- resources/views/jamaah/register.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Jamaah - PT Syakirasya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body style="background: linear-gradient(135deg, #d4fc79, #96e6a1); min-height: 100vh; display: flex; align-items: center; justify-content: center;">
  <div class="register-box bg-white p-4 rounded shadow">
    <h4 class="text-center mb-4">Pendaftaran Jamaah</h4>

    <form method="POST" action="{{ route('register.post') }}">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Contoh: Ahmad Fauzi" required />
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email / Username</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="nama@email.com" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Minimal 6 karakter" required />
      </div>
      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required />
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-success">Daftar Sekarang</button>
      </div>
      <p class="text-center mt-3">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
      </p>
    </form>
  </div>
</body>
</html>
