<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>{{ $paket->nama_paket }} - Syakirasya</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }
    header {
      background-color: #e0f2ff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .navbar-brand {
      font-weight: 600;
      color: #0078d7 !important;
    }
    main {
      padding: 40px 20px;
    }
    h2 {
      font-weight: 600;
      color: #333;
    }
    img {
      width: 320px;
      border-radius: 12px;
      margin-bottom: 20px;
    }
    ul {
      text-align: left;
      max-width: 600px;
      margin: auto;
      padding-left: 20px;
    }
    footer {
      background: #e0f2ff;
      text-align: center;
      padding: 15px;
      margin-top: 50px;
      color: #555;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <!-- ========== NAVBAR ========== -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">PT Syakirasya</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#paket">Paket</a></li>
            @auth
  <li class="nav-item"><a class="nav-link" href="{{ route('pendaftaran.form', $paket->id) }}">Booking</a></li>
  <li class="nav-item">
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
      @csrf
      <button type="submit" class="btn btn-outline-secondary btn-sm ms-2">Logout</button>
    </form>
  </li>
@else
  <li class="nav-item">
    <a class="btn btn-success btn-sm ms-2" href="{{ route('login') }}">Login</a>
  </li>
@endauth

          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- ========== DETAIL PAKET ========== -->
  <main class="container text-center">
    <h2 class="mb-3">{{ strtoupper($paket->nama_paket) }}</h2>

    {{-- Jika ada kolom gambar di tabel, tampilkan --}}
    @if(!empty($paket->gambar))
      <img src="{{ asset('storage/' . $paket->gambar) }}" alt="{{ $paket->nama_paket }}">
    @else
      <img src="{{ asset('img/logo-syakirasya.png') }}" alt="Paket Syakirasya">
    @endif

    <p class="mt-3">
      <strong>Harga:</strong>
      <span class="text-success fw-bold">Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
    </p>

    <p><strong>Tanggal Berangkat:</strong> 
      {{ \Carbon\Carbon::parse($paket->tanggal_berangkat)->translatedFormat('d F Y') }}
    </p>

    <div class="mt-4">
      <h5>Deskripsi Paket</h5>
      <p class="text-muted">{{ $paket->deskripsi ?? 'Belum ada deskripsi untuk paket ini.' }}</p>
    </div>

    <ul class="mt-4">
      <li>✨ Nikmati perjalanan ibadah penuh kenyamanan</li>
      <li>✈️ Tiket pesawat PP kelas ekonomi</li>
      <li>🏨 Hotel berbintang dekat Masjidil Haram</li>
      <li>🚌 Full bus AC & city tour</li>
      <li>🎁 Gratis: Kereta Cepat & City Tour Thaif</li>
    </ul>

    <div class="mt-5">
      <button class="btn btn-success" onclick="setPaketAndBooking('{{ $paket->nama_paket }}')">
        Booking Sekarang
      </button>
      <a href="https://wa.me/6281295730907?text=Saya%20ingin%20bertanya%20tentang%20{{ urlencode($paket->nama_paket) }}"
         class="btn btn-outline-primary ms-2">
         Tanya Admin
      </a>
    </div>
  </main>

  <footer>
    <p>&copy; {{ date('Y') }} PT Syakirasya Tours & Travel | Tangerang</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function setPaketAndBooking(nama) {
      localStorage.setItem('paketDipilih', nama);
      window.location.href = "{{ route('pendaftaran.form', $paket->id) }}";
    }
  </script>
</body>
</html>
