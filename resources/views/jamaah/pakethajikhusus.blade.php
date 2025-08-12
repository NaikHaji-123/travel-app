<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Haji Khusus ONH Plus - Syakirasya</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .navbar {
      background-color: rgba(26,93,26,0.85);
    }
    .navbar-brand, .nav-link {
      color: white !important;
    }
    .hero-img {
      border-radius: 15px;
      transition: transform 0.3s ease;
    }
    .hero-img:hover {
      transform: scale(1.05);
    }
    .facility-list li {
      margin-bottom: 10px;
      font-size: 16px;
    }
    .btn-success {
      background-color: #198754;
      border: none;
    }
    .btn-success:hover {
      background-color: #157347;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Syakirasya</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#beranda">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#paket">Paket</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('booking') }}#booking">Booking</a></li>
            @auth
              <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-outline-light btn-sm ms-2">Logout</button>
                </form>
              </li>
            @else
              <li class="nav-item"><a class="btn btn-light btn-sm ms-2" href="{{ route('login') }}">Login</a></li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Hero Section -->
  <main class="container py-5">
    <section class="text-center">
      <h2 class="fw-bold mb-3">Haji Khusus ONH Plus</h2>
      <img src="{{ asset('img/umrah3.jpg') }}" alt="Haji Khusus" class="hero-img shadow-sm" style="width:300px;" />
      <p class="mt-3 text-danger fw-bold">Kuota Terbatas!</p>
      <p class="fs-5"><strong>Harga:</strong> Rp 125.000.000</p>
      <p><strong>Durasi:</strong> 25 Hari (Madinah - Mekkah - Mina - Arafah)</p>
      <p><strong>Jadwal Keberangkatan:</strong> Juli - Agustus 2025</p>

      <!-- Fasilitas -->
      <div class="row justify-content-center mt-4">
        <div class="col-md-6">
          <ul class="facility-list list-unstyled text-start">
            <li>✅ Izin resmi PIHK (Kemenag RI)</li>
            <li>🕋 Akomodasi dekat Masjidil Haram</li>
            <li>📜 Manasik & bimbingan intensif</li>
            <li>🚌 Maktab Mina-Arafah full fasilitas</li>
            <li>💼 Konsultan perjalanan khusus keluarga</li>
          </ul>
        </div>
      </div>

      <!-- Tombol -->
      <div class="mt-4">
        <button class="btn btn-success btn-lg" onclick="setPaketAndBooking('Haji Khusus ONH Plus')">
          Booking Sekarang
        </button>
        <a href="https://wa.me/6281234567890?text=Saya%20ingin%20bertanya%20tentang%20Haji%20Khusus" 
           class="btn btn-outline-primary btn-lg ms-2">
          💬 Tanya Admin
        </a>
      </div>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function setPaketAndBooking(nama) {
      localStorage.setItem('paketDipilih', nama);
      window.location.href = "{{ route('booking') }}";
    }
  </script>
</body>
</html>
