<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Booking - PT Syakirasya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .booking-form {
      max-width: 650px;
      margin: 60px auto;
      background: white;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.07);
    }
    h3 {
      color: #1A5D1A;
      font-weight: bold;
      margin-bottom: 30px;
    }
    .form-label i {
      color: #1A5D1A;
      margin-right: 6px;
    }
    .btn-success {
      background-color: #1A5D1A;
      border: none;
    }
    .btn-success:hover {
      background-color: #144d14;
    }
    .badge-paket {
      background-color: #e9f5e9;
      color: #1A5D1A;
      font-size: 13px;
      border-radius: 8px;
      padding: 4px 8px;
      margin-left: 6px;
    }
    .header-icon {
      font-size: 32px;
      color: #1A5D1A;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="booking-form">
    <div class="text-center mb-4">
      <i class="fas fa-kaaba header-icon"></i>
      <h3 class="mt-2">Form Booking Umrah / Haji</h3>
      <p class="text-muted">Silakan lengkapi data di bawah ini untuk melanjutkan booking Anda.</p>
    </div>

    <form action="https://script.google.com/macros/s/PASTE_SCRIPT_LINK/exec" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="nama" class="form-label"><i class="fas fa-user"></i>Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" required>
      </div>

      <div class="mb-3">
        <label for="hp" class="form-label"><i class="fas fa-phone"></i>No. HP / WA Aktif</label>
        <input type="tel" class="form-control" id="hp" name="hp" placeholder="08xxxxxxxxxx" required>
      </div>

      <div class="mb-3">
        <label for="paket" class="form-label"><i class="fas fa-box"></i>Pilih Paket
          <span class="badge-paket">Umrah</span>
          <span class="badge-paket">Haji</span>
        </label>
        <select class="form-select" id="paket" name="paket" required>
          <option value="" selected disabled>-- Pilih Paket --</option>
          <option value="Umrah Reguler">Umrah Reguler</option>
          <option value="Umrah Plus Turki">Umrah Plus Turki</option>
          <option value="Haji Khusus ONH Plus">Haji Khusus ONH Plus</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="bukti" class="form-label"><i class="fas fa-upload"></i>Upload Bukti Transfer</label>
        <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*">
      </div>

      <div class="mb-3">
        <label for="catatan" class="form-label"><i class="fas fa-comment-dots"></i>Catatan Tambahan</label>
        <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Misal: Saya ingin berangkat dengan orang tua..."></textarea>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-success btn-lg">
          <i class="fas fa-paper-plane me-2"></i>Kirim Booking Sekarang
        </button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Cek login dari localStorage
  const isLogin = localStorage.getItem("login");
  if (isLogin !== "true") {
    alert("Silakan login terlebih dahulu.");
    window.location.href = "login.html";
  }
</script>
</body>
</html>
