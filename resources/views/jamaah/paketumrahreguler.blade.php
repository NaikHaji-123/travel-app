<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Umrah Reguler 9 Hari - Syakirasya</title>
  <link rel="stylesheet" href="style.css" />
</head>
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
<body>
  <header></header>

  <section class="section">
    <h2>Umrah Reguler 9 Hari</h2>
    <img src="img/umrah1.jpg" alt="Umrah Reguler" style="width:300px; border-radius:12px;" />
    <p>Harga: <strong>Rp 28.000.000</strong></p>
    <p>Paket ini termasuk:</p>
    <ul style="text-align:left; max-width:600px; margin:auto;">
      <li>✈️ Tiket Pesawat PP</li>
      <li>🏨 Hotel Bintang 4 (dekat Masjidil Haram)</li>
      <li>🍽️ Makan 3x sehari</li>
      <li>🚌 Transportasi AC selama di Arab</li>
      <li>🕋 Manasik & bimbingan ibadah</li>
    </ul>
    <br>
    <a href="booking.html" class="btn btn-success">Booking Sekarang</a>
  </section>

  <script>
    function setPaketFromDetail(nama) {
      localStorage.setItem('paketDipilih', nama);
    }
  </script>
</body>
</html>
