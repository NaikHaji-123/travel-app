<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - PT Syakirasya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <style>
    body {
      background: linear-gradient(to right, #d4fc79, #96e6a1);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
    }
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .form-floating > label {
      left: 1.25rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card p-4">
          <div class="text-center mb-4">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Syakirasya" height="60" />
            <h5 class="mt-2">Login Jamaah</h5>
            <p class="text-muted small">Silakan masuk untuk melihat data keberangkatan Anda.</p>
          </div>

          {{-- Form Login --}}
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="email" placeholder="Email atau Username" required value="{{ old('email') }}" />
              <label for="email"><i class="bi bi-person-circle me-2"></i>Email / Username</label>
            </div>
            <div class="form-floating mb-4">
              <input type="password" class="form-control" name="password" placeholder="Kata Sandi" required />
              <label for="password"><i class="bi bi-lock me-2"></i>Kata Sandi</label>
            </div>

            @if($errors->any())
              <div class="alert alert-danger py-2">
                {{ $errors->first() }}
              </div>
            @endif

            <div class="d-grid">
              <button type="submit" class="btn btn-success">Masuk</button>
            </div>
            <p class="text-center mt-3">
              Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </p>
          </form>

        </div>
      </div>
    </div>
  </div>
</body>
</html>
