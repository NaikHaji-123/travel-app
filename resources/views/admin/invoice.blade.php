<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Mutasi Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .invoice-box {
            background: #fff;
            padding: 30px;
            margin: 20px auto;
            border: 1px solid #eee;
            border-radius: 8px;
            max-width: 800px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .invoice-header img {
            height: 60px;
        }

        h2 {
            font-size: 20px;
            color: #007bff;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
        }

        table td {
            padding: 5px;
        }

        table th {
            background-color: #007bff;
            color: #fff;
            padding: 8px;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
        }

        .qr-sign {
            text-align: center;
            margin-top: 40px;
        }

        @media print {
            button { display: none; }
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <div class="invoice-header">
        <div>
            <img src="{{ asset('img/logo.png') }}" alt="Logo Perusahaan">
        </div>
        <div class="text-end">
            <h2>RIWAYAT MUTASI PEMBAYARAN</h2>
            <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y') }}<br>
            Kode Mutasi: {{ $booking->kode_mutasi ?? 'J-0001' }}</p>
        </div>
    </div>

    <table class="table table-borderless">
        <tr>
            <td>
                <strong>Data Travel:</strong><br>
                PT. SYAKIRASYA WISATA MANDIRI<br>
                Jl. Raya Mauk Km.12, Desa Kosambi, Kec. Sukadiri, Kab. Tangerang, Banten<br>
                Telp: 0812-9573-0907<br>
                Email: syakirasyawrm@gmail.com
            </td>
            <td>
                <strong>Data Jamaah:</strong><br>
                Nama: {{ $booking->nama }}<br>
                Telp: {{ $booking->hp }}<br>
                Email: {{ $booking->email ?? '-' }}
            </td>
        </tr>
    </table>

    <table class="table table-bordered">
        <tr>
            <th>Tanggal Registrasi</th>
            <th>Nama Jamaah</th>
            <th>Nama Keberangkatan</th>
            <th>Tanggal Keberangkatan</th>
            <th>Tipe Kamar</th>
            <th>Jumlah Pax</th>
        </tr>
        <tr>
            <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}</td>
            <td>{{ $booking->nama }}</td>
            <td>{{ $booking->paketTravel->nama_paket ?? $booking->paket }}</td>
            <td>{{ \Carbon\Carbon::parse($booking->paketTravel->tanggal_berangkat ?? now())->format('d M Y') }}</td>
            <td>{{ $booking->tipe_kamar ?? 'Quad' }}</td>
            <td>{{ $booking->jumlah_pax ?? 1 }}</td>
        </tr>
    </table>

    <table class="table table-bordered">
        <tr>
            <th>Harga Paket</th>
            <th>Diskon</th>
            <th>Total Harga</th>
            <th>Sudah Pembayaran</th>
            <th>Sisa Pembayaran</th>
        </tr>
        <tr>
            <td>Rp {{ number_format($booking->paketTravel->harga ?? 0,0,',','.') }}</td>
            <td>Rp {{ number_format($booking->diskon ?? 0,0,',','.') }}</td>
            <td>Rp {{ number_format(($booking->paketTravel->harga ?? 0)-($booking->diskon ?? 0),0,',','.') }}</td>
            <td>Rp {{ number_format($booking->sudah_bayar ?? 0,0,',','.') }}</td>
            <td>Rp {{ number_format(($booking->paketTravel->harga ?? 0)-($booking->diskon ?? 0)-($booking->sudah_bayar ?? 0),0,',','.') }}</td>
        </tr>
    </table>

    <div class="qr-sign">
        <p>Tangerang, {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
        <p>PT. SYAKIRASYA WISATA MANDIRI</p>
        <img src="{{ asset('img/qr.png') }}" alt="QR Code" height="80"><br>
        <span>Direktur</span>
    </div>

    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
    </div>
</div>
</body>
</html>
