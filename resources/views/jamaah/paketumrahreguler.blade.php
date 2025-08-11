<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Umrah Reguler 9 Hari - Syakirasya</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Syakirasya</a>
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
                  <button type="submit" class="btn btn-outline-secondary btn-sm ms-2">Logout</button>
                </form>
              </li>
            @else
              <li class="nav-item"><a class="btn btn-success btn-sm ms-2" href="{{ route('login') }}">Login</a></li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main class="container py-5">
    <section class="text-center">
      <h2>Umrah Reguler 9 Hari</h2>
      <img src="{{ asset('img/umrah1.jpg') }}" alt="Umrah Reguler" style="width:300px; border-radius:12px;" />
      <p class="mt-3">Harga: <strong>Rp 28.000.000</strong></p>

      <ul style="text-align:left; max-width:600px; margin:auto;">
        <li>✈️ Tiket Pesawat PP</li>
        <li>🏨 Hotel Bintang 4 (dekat Masjidil Haram)</li>
        <li>🍽️ Makan 3x sehari</li>
        <li>🚌 Transportasi AC selama di Arab</li>
        <li>🕋 Manasik & bimbingan ibadah</li>
      </ul>

      <div class="mt-4">
        <button class="btn btn-success" onclick="setPaketAndBooking('Umrah Reguler 9 Hari')">Booking Sekarang</button>
        <a href="https://wa.me/6281234567890?text=Saya%20ingin%20bertanya%20tentang%20Umrah%20Reguler" class="btn btn-outline-primary ms-2">Tanya Admin</a>
      </div>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function setPaketAndBooking(nama) {
      localStorage.setItem('paketDipilih', nama);
      // arahkan ke route booking Laravel
      window.location.href = "{{ route('booking') }}";
    }
  </script>
</body>
</html>
