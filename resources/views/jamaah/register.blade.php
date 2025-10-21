<!-- resources/views/jamaah/register.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Jamaah - PT Syakirasya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      background: linear-gradient(135deg, #d4fc79, #96e6a1);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .register-box {
      width: 100%;
      max-width: 420px;
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .register-box h4 {
      font-weight: 600;
      color: #2f7a36;
    }

    .form-control {
      border-radius: 10px;
    }

    .btn-success {
      border-radius: 10px;
      padding: 10px;
      font-weight: 500;
      transition: 0.3s;
    }

    .btn-success:hover {
      background-color: #2f7a36;
    }

    .register-box p a {
      text-decoration: none;
      font-weight: 500;
      color: #2f7a36;
    }

    .register-box p a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="register-box">
    <div class="text-center mb-4">
      <img src="https://cdn-icons-png.flaticon.com/512/3065/3065778.png" width="60" alt="icon jamaah">
      <h4 class="mt-2">Pendaftaran Jamaah</h4>
    </div>

    @if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


    <form method="POST" action="{{ route('register.post') }}">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
       <input type="text" name="name" class="form-control" id="name" placeholder="Contoh: Ahmad Sahroni" required />

      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email / Username</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="nama@email.com" required />
      </div>

      <div class="mb-3">
  <label for="no_hp" class="form-label">Nomor HP</label>
  <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Contoh: 081234567890" required />
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
