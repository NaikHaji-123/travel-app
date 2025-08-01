<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Haji Khusus - Syakirasya</title>
  <link rel="stylesheet" href="style.css" />
  <!-- AOS animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .btn-daftar {
      background: #25d366;
      color: white;
      padding: 12px 25px;
      margin: 10px 5px;
      border-radius: 30px;
      font-weight: bold;
      text-decoration: none;
      display: inline-block;
      transition: background 0.3s ease;
    }
    .btn-daftar:hover {
      background: #1ebe5b;
    }

    .testimoni-mini {
      background: #f7f7f7;
      border-left: 4px solid #25d366;
      padding: 15px;
      max-width: 600px;
      margin: 30px auto;
      border-radius: 8px;
      font-style: italic;
    }

    .galeri-mini {
      display: flex;
      gap: 15px;
      overflow-x: auto;
      margin: 20px auto;
      padding: 10px;
      max-width: 90%;
    }

    .galeri-mini img {
      width: 200px;
      border-radius: 10px;
      flex: 0 0 auto;
    }

    .section {
      padding: 40px 20px;
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
    }
    body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
  background: #fdfdfd;
  margin: 0;
  padding: 0;
  color: #333;
}

a {
  text-decoration: none;
}

  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="index.html">Syakirasya</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.html#beranda">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="index.html#paket">Paket</a></li>
        <li class="nav-item"><a class="nav-link" href="index.html#booking">Booking</a></li>
      </ul>
    </div>
  </div>
</nav>
  </header>

  <section class="section" data-aos="fade-up">
    <h2>Haji Khusus ONH Plus</h2>
    <img src="img/umrah3.jpg" alt="Haji Khusus" style="width:300px; border-radius:12px;" />
    <p><strong>Kuota Terbatas</strong></p>
    <p><strong>Harga:</strong> Rp 125.000.000</p>
    <p><strong>Durasi:</strong> 25 Hari (Madinah - Mekkah - Mina - Arafah)</p>
    <p><strong>Jadwal Keberangkatan:</strong> Juli - Agustus 2025</p>
    <p><em>(Kuota sangat terbatas – segera daftar sekarang!)</em></p>

    <ul style="text-align:left; max-width:600px; margin:auto; margin-top:20px;">
      <li>✅ Izin resmi PIHK (Kemenag RI)</li>
      <li>🕋 Akomodasi dekat Masjidil Haram</li>
      <li>📜 Manasik & bimbingan intensif</li>
      <li>🚌 Maktab Mina-Arafah full fasilitas/li>
      <li>💼 Konsultan perjalanan khusus keluarga</li>
    </ul>

    <br>
    <button class="btn btn-success" onclick="handleBooking()">Booking Sekarang</button>
    <a href="https://wa.me/6281234567890?text=Assalamualaikum%2C%20saya%20ingin%20bertanya%20tentang%20Haji%20Khusus%20ONH%20Plus." class="btn-daftar" style="background:#128C7E; margin-left: 10px;">💬 Tanya Admin</a>
  </section>
  <!-- Script -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();

    function setPaketFromDetail(nama) {
      localStorage.setItem('paketDipilih', nama);
    }
  function handleBooking() {
    const isLogin = localStorage.getItem("login");

    if (isLogin === "true") {
      // Sudah login, arahkan ke halaman booking
      window.location.href = "booking.html";
    } else {
      // Belum login, arahkan ke halaman login
      alert("Silakan login terlebih dahulu untuk melakukan booking.");
      window.location.href = "login.html";
    }
  }
  </script>
</body>
</html>
