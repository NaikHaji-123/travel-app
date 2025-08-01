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
    }

    .register-box {
      max-width: 430px;
      width: 100%;
      background: #fff;
      padding: 35px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      animation: fadeIn 0.6s ease-in-out;
    }

    .register-box h4 {
      color: #198754;
      font-weight: 600;
    }

    .form-control::placeholder {
      color: #aaa;
    }

    .btn-success {
      background-color: #198754;
      border: none;
    }

    .btn-success:hover {
      background-color: #157347;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
  <div class="register-box">
    <h4 class="text-center mb-4">Pendaftaran Jamaah</h4>
    <form onsubmit="return register(event)">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" placeholder="Contoh: Ahmad Fauzi" required />
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email / Username</label>
        <input type="email" class="form-control" id="email" placeholder="nama@email.com" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control" id="password" placeholder="Minimal 6 karakter" required />
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-success">Daftar Sekarang</button>
      </div>
      <p class="text-center mt-3">
        Sudah punya akun? <a href="login.html">Masuk di sini</a>
      </p>
    </form>
  </div>

  <script>
    function register(event) {
      event.preventDefault();

      const nama = document.getElementById("nama").value;
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;

      // Simpan data ke localStorage sementara (simulasi)
      const user = { nama, email, password };
      localStorage.setItem("userData", JSON.stringify(user));

      alert("Pendaftaran berhasil! Silakan login.");
      window.location.href = "login.html";
    }
  </script>
</body>
</html>
