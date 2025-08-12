
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PT Syakirasya - Travel Haji & Umrah</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
  <div class="container">
    <!-- Brand / Logo -->
    <a class="navbar-brand fw-bold" href="#">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" height="30" class="me-2">
      PT SYAKIRASYA
    </a>

    <!-- Toggle Button (Mobile) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active fw-bold text-warning' : 'text-white' }}" href="#beranda">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#tentang">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#paket">Paket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#galeri">Galeri</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#kontak">Kontak</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#lokasi">Lokasi</a>
        </li>

        <!-- Auth Button -->
        @auth
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-light btn-sm ms-3">🚪 Login</button>
          </form>
        @else
          <li class="nav-item">
            <a class="btn btn-light btn-sm ms-3" href="{{ route('login') }}">🔐 Login</a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
<!-- Hero Section -->
<section id="beranda" 
         class="d-flex align-items-center" 
         style="height: 100vh; background: url('{{ asset('img/mekkah.jpg') }}') center/cover no-repeat; position: relative;">

  <!-- Overlay gradasi -->
  <div style="position: absolute; top:0; left:0; width:100%; height:100%;
              background: linear-gradient(to right, rgba(26,93,26,0.85), rgba(26,93,26,0.3), rgba(26,93,26,0));">
  </div>

  <!-- Konten -->
  <div class="container position-relative text-white" style="z-index: 2;">
    <div class="row">
      <div class="col-md-6" data-aos="fade-right">
        <h1 class="display-4 fw-bold">Selamat Datang di PT Syakirasya</h1>
        <p class="lead">Perjalanan Haji dan Umrah dengan pelayanan terbaik & terpercaya</p>
        <a href="{{ route('booking') }}" class="btn btn-success btn-lg rounded-pill mt-3">🛫 Booking Sekarang</a>
      </div>
    </div>
  </div>

</section>

<!-- Tentang -->
<section id="tentang" class="section">
  <div class="container">
    <h2>Tentang Kami</h2>
    <p><strong>PT Syakirasya</strong> adalah perusahaan resmi yang bergerak di bidang jasa perjalanan Umrah dan Haji...</p>
    <h3>Kantor Pusat</h3>
    <p>Jl. Raya Mauk KM 12, Desa Kosambi, Sukadiri, Kabupaten Tangerang</p>
  </div>
</section>

<!-- Paket -->
<section id="paket" class="section">
  <div class="container">
    <h2>Paket Haji & Umrah</h2>
    <div class="paket-scroll-container">
      <div class="paket-card">
        <img src="{{ asset('img/umrah1.jpg') }}" alt="Umrah Reguler" />
        <h3>Umrah Reguler 9 Hari</h3>
        <p>Rp 28.000.000</p>
        <a href="{{ url('paket-umrah-reguler') }}" class="btn-detail">Detail</a>
      </div>
      <div class="paket-card">
        <img src="{{ asset('img/umrah2.jpg') }}" alt="Umrah Turki" />
        <h3>Umrah Plus Turki 12 Hari</h3>
        <p>Rp 35.000.000</p>
        <a href="{{ url('paket-umrah-turki') }}" class="btn-detail">Detail</a>
      </div>
      <div class="paket-card">
        <img src="{{ asset('img/umrah3.jpg') }}" alt="Haji Khusus" />
        <h3>Haji Khusus ONH Plus</h3>
        <p>Kuota Terbatas</p>
        <a href="{{ url('paket-haji-khusus') }}" class="btn-detail">Detail</a>
      </div>
      <div class="paket-card">
        <img src="{{ asset('img/umrah4.jpg') }}" alt="Umrah Ramadhan" />
        <h3>Umrah Ramadhan 10 Hari</h3>
        <p>Rp 32.000.000</p>
        <a href="{{ url('paket-umrah-ramadhan') }}" class="btn-detail">Detail</a>
      </div>
    </div>
  </div>
</section>

<!-- Modal Paket -->
<div class="modal" id="modalPaket">
  <div class="modal-content">
    <span class="close" onclick="tutupModal()">&times;</span>
    <h3 id="modalPaketNama"></h3>
    <p>Silakan klik tombol di bawah untuk melanjutkan proses booking paket ini.</p>
    <a href="#booking" onclick="isiBookingPaket()" class="btn-daftar">📥 Booking Sekarang</a>
  </div>
</div>

<!-- Keunggulan -->
<section id="keunggulan" class="section text-center py-5 bg-white">
  <div class="container">
    <h2 class="mb-4">Kenapa Memilih Kami?</h2>
    <div class="row g-4">
      <div class="col-md-3">
        <img src="{{ asset('img/ikon1.png') }}" height="60" alt="" />
        <h5 class="mt-3">Resmi & Terdaftar</h5>
        <p>Agen Umrah & Haji resmi Kemenag RI</p>
      </div>
      <div class="col-md-3">
        <img src="{{ asset('img/ikon2.png') }}" height="60" alt="" />
        <h5 class="mt-3">Bimbingan Lengkap</h5>
        <p>Pembimbing ibadah profesional dan berpengalaman</p>
      </div>
      <div class="col-md-3">
        <img src="{{ asset('img/ikon3.png') }}" height="60" alt="" />
        <h5 class="mt-3">Hotel Nyaman</h5>
        <p>Akomodasi dekat Masjidil Haram dan Nabawi</p>
      </div>
      <div class="col-md-3">
        <img src="{{ asset('img/ikon4.png') }}" height="60" alt="" />
        <h5 class="mt-3">Harga Transparan</h5>
        <p>Tanpa biaya tersembunyi, sesuai paket</p>
      </div>
    </div>
  </div>
</section>

<!-- Galeri -->
<section id="galeri" class="section bg-light py-5">
  <div class="container text-center">
    <h2 class="mb-4">Galeri</h2>
    <div class="row justify-content-center g-3">
      @for ($i = 1; $i <= 4; $i++)
        <div class="col-6 col-md-3">
          <a href="{{ asset("img/galeri$i.jpg") }}" data-lightbox="galeri" data-title="Umrah {{ $i }}">
            <img src="{{ asset("img/galeri$i.jpg") }}" class="img-fluid rounded shadow-sm" alt="Umrah {{ $i }}" />
          </a>
        </div>
      @endfor
    </div>
  </div>
</section>

<!-- Kontak -->
<section id="kontak" class="section">
  <div class="container">
    <h2>Kontak Kami</h2>
    <p><strong>Alamat:</strong> Jl. Contoh No.123, Jakarta</p>
    <p><strong>Telepon:</strong> 0812-3456-7890</p>
    <p><strong>Email:</strong> info@syakirasya.co.id</p>
  <!-- lokasi -->
    <section id="lokasi" class="section">
    <div class="map-container">
      <iframe
        src="https://www.google.com/maps?q=Jl.%20Raya%20Mauk%20KM%2012%20Kosambi%20Sukadiri%20Tangerang&output=embed"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</section>

<!-- Testimoni -->
<section id="testimoni" class="section">
  <div class="container text-center">
    <h2>Testimoni Jamaah</h2>
    <div class="testimoni-wrapper">
      <div class="testimoni-box" data-aos="fade-up">
        <p>"Alhamdulillah, pelayanan selama Umrah sangat memuaskan. Terima kasih Syakirasya!"</p>
        <h4>🌟 Ibu Ningih - Tangerang</h4>
      </div>
      <div class="testimoni-box" data-aos="fade-up">
        <p>"Tim pembimbing sangat sabar dan berpengalaman. Perjalanan ibadah kami jadi lancar."</p>
        <h4>🌟 Pak Ujang - Tangerang</h4>
      </div>
      <div class="testimoni-box" data-aos="fade-up">
        <p>"Hotel nyaman, makanan enak, dan jadwal tertib. Saya akan rekomendasikan ke keluarga."</p>
        <h4>🌟 Pak Deripin - Tangerang</h4>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-success text-white text-center py-3">
  <div class="container">
    <p>&copy; 2025 PT Syakirasya. All rights reserved.</p>
    <div>
      <a href="https://instagram.com/syakirasyagroup" target="_blank" class="text-white me-3">Instagram</a>
      <a href="https://facebook.com/SyakirasyaUmroh" target="_blank" class="text-white">Facebook</a>
    </div>
  </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

<!-- WhatsApp Floating -->
<a href="https://wa.me/6282134493486?text=Assalamu%20alaikum%20saya%20ingin%20bertanya%20tentang%20travel%20umrah"
   class="floating-whatsapp"
   target="_blank">
  <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="wa-icon">
  <span class="wa-text">Hubungi Kami</span>
</a>
</body>
</html>
