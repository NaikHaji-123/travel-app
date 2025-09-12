
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
      
      <!-- Tombol Booking -->
      <a href="{{ route('booking') }}" class="btn btn-success btn-lg rounded-pill mt-3 me-2">
        🛫 Booking Sekarang
      </a>

      <!-- Tombol Hubungi -->
      <a href="https://wa.me/6281295730907" target="_blank" class="btn btn-primary btn-lg rounded-pill mt-3">
        📞 Segera Hubungi Kami
      </a>
    </div>
  </div>
</div>


</section>

<!-- Tentang Kami -->
<section id="tentang" class="py-5">
  <div class="container">
    <div class="row align-items-center">
      
      <!-- Kolom Kiri -->
      <div class="col-md-6 mb-4">
        <h2 class="text-success fw-bold">Tentang Kami</h2>
        <p>
          <strong>PT Syakirasya</strong> adalah perusahaan resmi yang bergerak di bidang jasa perjalanan
          <span class="fw-bold text-success">Umrah dan Haji</span>. 
          Kami berkomitmen memberikan pelayanan terbaik, aman, dan nyaman 
          untuk setiap jamaah yang ingin menunaikan ibadah suci.
        </p>

        <!-- Highlight Box -->
        <div class="highlight-box">
          <strong>✅ Sudah Berizin Resmi</strong><br>
          IZIN 02090100218880001 - Tahun 2023 (Kemenag RI)
        </div>

        <!-- Checklist Poin -->
        <ul class="list-unstyled text-start mt-3">
          <li>✨ <strong>Berpengalaman</strong> lebih dari 10 tahun melayani jamaah</li>
          <li>🕌 <strong>Fasilitas Nyaman</strong> mulai dari akomodasi hingga transportasi</li>
          <li>📑 <strong>Legalitas Terjamin</strong> resmi terdaftar di Kementerian Agama</li>
        </ul>

        <h5 class="mt-4 text-success">Kantor Pusat</h5>
        <p>Jl. Raya Mauk KM 12, Desa Kosambi, Sukadiri, Kabupaten Tangerang</p>
      </div>

      <!-- Kolom Kanan -->
      <div class="col-md-6 text-center">
        <img src="{{ asset('img/Tentang.jpg') }}" alt="Tentang Kami">
      </div>

    </div>
  </div>
</section>



<!-- Paket -->
<section id="paket" class="section">
  <div class="container">
    <h2>Paket Haji & Umrah</h2>
    <div class="paket-scroll-container">
      <div class="paket-card">
        <img src="{{ asset('img/umrah1.jpg') }}" alt="Umrah Reguler" />
        <h3>Umrah Akhir Tahun 2025</h3>
        <p>Rp 29.000.000</p>
        <a href="{{ url('paket-umrah-reguler') }}" class="btn-detail">Detail</a>
      </div>
      <div class="paket-card">
        <img src="{{ asset('img/umrah2.jpg') }}" alt="Umrah Turki" />
        <h3>Umrah Plus Thaif</h3>
        <p>Rp 30.000.000 atau 25.000.000</p>
        <a href="{{ url('paket-umrah-turki') }}" class="btn-detail">Detail</a>
      </div>
      <div class="paket-card">
        <img src="{{ asset('img/umrah3.jpg') }}" alt="Haji Khusus" />
        <h3>Umrah Massal 12 Hari</h3>
        <p>25.000.000</p>
        <a href="{{ url('paket-haji-khusus') }}" class="btn-detail">Detail</a>
      </div>
      <div class="paket-card">
        <img src="{{ asset('img/umrah4.jpg') }}" alt="Umrah Ramadhan" />
        <h3>Umrah UMKM 9 Hari</h3>
        <p>Rp 23.500.000</p>
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

<!-- KEUNGGULAN -->
<section id="keunggulan" class="section py-5">
  <div class="bg-emas text-center py-5">
    <h2 class="mb-5 text-white">Kenapa Pilih PT Syakirasya?</h2>
    <div class="container">
      <div class="row g-4">

        <!-- Card 1 -->
        <div class="col-md-4">
          <div class="card hover-card p-4 h-100 text-center">
            <img src="{{ asset('img/resmi.svg') }}" height="60" alt="Resmi">
            <h5 class="mt-3">Resmi & Terdaftar</h5>
            <p>Agen Umrah & Haji resmi Kemenag RI, aman, dan terpercaya sehingga perjalanan Anda lebih tenang.</p>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4">
          <div class="card hover-card p-4 h-100 text-center">
            <img src="{{ asset('img/bimbingan.svg') }}" height="60" alt="Bimbingan">
            <h5 class="mt-3">Bimbingan Lengkap</h5>
            <p>Didampingi pembimbing ibadah & berpengalaman yang siap memandu dari awal hingga akhir perjalanan.</p>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4">
          <div class="card hover-card p-4 h-100 text-center">
            <img src="{{ asset('img/hotel.svg') }}" height="60" alt="Hotel">
            <h5 class="mt-3">Hotel Nyaman</h5>
            <p>Akomodasi dekat Masjidil Haram & Nabawi.</p>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-4">
          <div class="card hover-card p-4 h-100 text-center">
            <img src="{{ asset('img/money.svg') }}" height="60" alt="Harga">
            <h5 class="mt-3">Harga Transparan</h5>
            <p>Tanpa biaya tersembunyi, sesuai paket yang dipilih. Semua jelas, detail, dan transparan.</p>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="col-md-4">
          <div class="card hover-card p-4 h-100 text-center">
            <img src="{{ asset('img/jadwal.svg') }}" height="60" alt="Jadwal">
            <h5 class="mt-3">Jadwal Fleksibel</h5>
            <p>Beragam pilihan paket dan jadwal keberangkatan, memudahkan jamaah menyesuaikan dengan waktu yang tersedia.</p>
          </div>
        </div>

        <!-- Card 6 -->
        <div class="col-md-4">
          <div class="card hover-card p-4 h-100 text-center">
            <img src="{{ asset('img/jam.svg') }}" height="60" alt="Support">
            <h5 class="mt-3">Support 24 Jam</h5>
            <p>Tim support siap membantu jamaah kapanpun diperlukan, baik sebelum, saat, maupun setelah ibadah.</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>


<!-- Galeri -->
<section id="galeri" class="section bg-light py-5">
  <div class="container text-center">
    <h2 class="mb-4">Galeri</h2>
    <div class="row justify-content-center g-3">
      @for ($i = 1; $i <= 9; $i++)
        <div class="col-6 col-md-3 galeri-item">
          <a href="{{ asset("img/galeri$i.jpg") }}" data-lightbox="galeri" data-title="Umrah {{ $i }}">
            <div class="galeri-wrapper">
              <img src="{{ asset("img/galeri$i.jpg") }}" class="img-fluid" alt="Umrah {{ $i }}" />
              <div class="overlay"><i class="fas fa-search-plus"></i></div>
            </div>
          </a>
        </div>
      @endfor
    </div>
  </div>
</section>


<!-- Kontak -->
<section id="kontak" class="kontak-section">
  <div class="container">
    <h2 class="kontak-title">Kontak Kami</h2>
    <div class="kontak-card">
      <p><i class="fas fa-map-marker-alt"></i> 
        <strong>Alamat:</strong><br>
        Jl. Raya Mauk Km.12, Desa Kosambi, Kec.Sukadiri, Kabupaten Tangerang
      </p>
      <p><i class="fas fa-phone-alt"></i> 
        <strong>Telepon:</strong><br>
        <a href="tel:081295730907">0812-9573-0907</a>
      </p>
      <p><i class="fas fa-envelope"></i> 
        <strong>Email:</strong><br>
        <a href="mailto:info@syakirasya.co.id">info@syakirasya.co.id</a>
      </p>

      <!-- Tombol WhatsApp -->
      <a href="https://wa.me/6281295730907" target="_blank" class="btn-wa">
        <i class="fab fa-whatsapp"></i> Hubungi Kami via WhatsApp
      </a>

      <!-- Sosial Media -->
      <div class="sosmed">
        <a href="https://instagram.com/syakirasyagroup" target="_blank" class="ig" title="Ikuti Instagram Kami">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="https://tiktok.com/@syakirasyagroup" target="_blank" class="tt" title="Ikuti TikTok Kami">
          <i class="fab fa-tiktok"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Font Awesome (harus ada ini di <head>) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

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
<a href="https://wa.me/6281295730907?text=Assalamu%20alaikum%20saya%20ingin%20bertanya%20tentang%20travel%20umrah"
   class="floating-whatsapp"
   target="_blank">
  <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="wa-icon">
  <span class="wa-text">Hubungi Kami</span>
</a>
</body>
</html>
