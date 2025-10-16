<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Data Travel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* General Layout and Reset */
        @page { size: A4; margin: 0; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: #f4f4f9; 
            color: #333;
        }
        .invoice-container { 
            width: 100%; 
            max-width: 800px; 
            margin: 40px auto; 
            padding: 30px; 
            background-color: #ffffff; 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); 
            border-radius: 12px; 
        }
        .separator { border: 0; height: 1px; background-color: #ddd; margin: 25px 0; }

        /* Header (Logo & Title) */
        .invoice-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: flex-end; 
            margin-bottom: 30px;
        }
        .header-left {
            display: flex;
            align-items: center; 
            gap: 15px; 
        }
        .company-logo {
            max-height: 55px; 
            width: auto;
            border-radius: 4px; 
        }
        .invoice-header h1 { 
            color: #007bff; 
            margin: 0; 
            font-size: 2.2em; 
            letter-spacing: 0.5px;
            font-weight: 700;
        }
        .invoice-number { 
            font-size: 1.1em; 
            font-weight: bold; 
            color: #6c757d; 
            background-color: #f0f4ff; 
            border: 1px solid #007bff;
            padding: 8px 15px; 
            border-radius: 6px;
        }

        /* Info Section (Company & Client) */
        .invoice-info-section { 
            display: flex; 
            justify-content: space-between; 
            margin-bottom: 20px;
        }
        .invoice-info-section h2 { 
            font-size: 1.1em; 
            color: #343a40; 
            margin-bottom: 10px; 
            padding-bottom: 5px; 
            border-bottom: 2px solid #007bff;
        }
        .invoice-info-section p { 
            margin: 3px 0; 
            font-size: 0.9em; 
            color: #495057;
        }
        .company-data, .client-data { 
            width: 48%; 
            padding: 10px;
            border-left: 3px solid #007bff;
            background-color: #f8f9fa;
        } 

        /* Table Styling */
        .section-title { 
            color: #007bff; 
            margin-top: 30px; 
            margin-bottom: 15px; 
            font-size: 1.4em;
        }
        .data-table, .payment-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        .data-table th, .payment-table th {
            background-color: #007bff; 
            color: white; 
            padding: 14px 15px; 
            text-align: left; 
            font-size: 0.95em; 
            font-weight: 600;
        }
        .data-table td, .payment-table td {
            padding: 12px 15px; 
            border-bottom: 1px solid #eee; 
            font-size: 0.9em;
        }
        .data-table tbody tr:nth-child(even) { background-color: #f8f9fa; } 
        .data-table tbody tr:last-child td { border-bottom: none; }

        /* Payment Highlighting */
        .total-price-cell { 
            font-weight: bold; 
            color: #007bff; 
        }
        .outstanding-cell { 
            font-weight: 700; 
            font-size: 1.15em; 
            color: #dc3545; 
            background-color: #ffeaea; 
        }

        /* Status Badges */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
        }
        .status-badge i { margin-right: 5px; }
        .status-lunas {
            background-color: #d4edda;
            color: #155724;
        }
        .status-belum {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Signature and QR Section */
        .signature-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 60px;
        }
        .signature-block {
            text-align: center;
            width: 40%;
        }
        .signature-block .role { margin-bottom: 5px; font-weight: 600; }
        .signature-space { height: 70px; margin: 10px 0; } 
        .signature-block .signer { font-size: 1em; }

        .qr-block {
            text-align: center;
            width: 20%;
        }
        .qr-code {
            width: 100px;
            height: 100px;
            border: 5px solid #f8f9fa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .qr-block p { font-size: 0.8em; color: #6c757d; margin-top: 5px; }

        /* Footer Note */
        .footer-note {
            text-align: center;
            margin-top: 40px;
            padding-top: 15px;
            border-top: 2px solid #007bff; 
            color: #6c757d;
            font-style: italic;
        }

        /* Print Button Styling (Screen Only) */
        .btn-print-wrapper {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .btn-print {
            padding: 12px 25px;
            background-color: #28a745; 
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background-color 0.3s, transform 0.1s;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }
        .btn-print:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        /* Print Media Query */
        @media print {
            body { background-color: #fff !important; }
            .invoice-container { margin: 0 auto; box-shadow: none; border-radius: 0; }
            .btn-print-wrapper { display: none; }
            .data-table th, .payment-table th, .outstanding-cell, .status-lunas, .status-belum { 
                -webkit-print-color-adjust: exact !important; 
                color-adjust: exact !important; 
            }
        }
    </style>
</head>
<body>

@php
    // safety helpers
    $user = $pendaftaran->user ?? null;
    $paket = $pendaftaran->paketTravel ?? null;

    // try common name fields
    $userName = $user->nama ?? $user->name ?? '-';
    $userHp   = $user->no_hp ?? $user->hp ?? '-';

    $hargaPaket = $paket->harga ?? 0;
    $diskon     = $pendaftaran->diskon ?? 0;
    $sudahBayar = $pendaftaran->sudah_bayar ?? $pendaftaran->sudahBayar ?? 0;

    $total = max(0, $hargaPaket - $diskon);
    $sisa  = max(0, $total - $sudahBayar);
@endphp

<div class="invoice-container">
    
    <header class="invoice-header">
        <div class="header-left">
            {{-- GANTI DENGAN PATH LOGO ANDA YANG BENAR --}}
            <img src="{{ asset('img/logo.png') }}" alt="Company Logo" class="company-logo">
            <h1>RIWAYAT MUTASI PEMBAYARAN</h1>
        </div>
        <p class="invoice-number">#INV-{{ $pendaftaran->id ?? '00000' }}</p>
    </header>
    
    <hr class="separator"/>

    <div class="invoice-info-section">
        <div class="invoice-info company-data">
            <h2><i class="bi bi-building"></i> Data Travel</h2>
            <p><strong>PT. SYAKIRASYA WISATA MANDIRI</strong></p>
            <p>Jl. Raya Mauk Km.12, Desa Kosambi, Kec. Sukadiri, Kab. Tangerang, Banten</p>
            <p><i class="bi bi-telephone"></i> 0812-9573-0907</p>
            <p><i class="bi bi-envelope"></i> syakirasyawrm@gmail.com</p>
        </div>
        <div class="invoice-info client-data">
            <h2><i class="bi bi-person"></i> Data Jamaah</h2>
            <p><strong>{{ $userName }}</strong></p>
            <p><i class="bi bi-telephone"></i> {{ $userHp }}</p>
            <p><i class="bi bi-envelope"></i> {{ $user->email ?? '-' }}</p>
            <p><strong>Invoice Date:</strong> {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
        </div>
    </div>
    
    <hr class="separator"/>
    
    <h3 class="section-title">Detail Pemesanan</h3>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Tanggal Registrasi</th>
                    <th>Nama Paket</th>
                    <th>Tanggal Keberangkatan</th>
                    <th>Tipe Kamar</th>
                    <th>Jumlah Pax</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ \Carbon\Carbon::parse($pendaftaran->created_at)->format('d M Y') }}</td>
                    <td>{{ $paket->nama_paket ?? ($pendaftaran->paket ?? '-') }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($paket->tanggal_berangkat ?? $pendaftaran->tanggal_berangkat ?? now())->format('d M Y') }}
                    </td>
                    <td>{{ $pendaftaran->tipe_kamar ?? 'Quad' }}</td>
                    <td>{{ $pendaftaran->jumlah_pax ?? $pendaftaran->pax ?? 1 }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h3 class="section-title">Rincian Pembayaran</h3>
    <div class="table-responsive">
        <table class="payment-table">
            <thead>
                <tr>
                    <th>Harga Paket</th>
                    <th>Diskon</th>
                    <th>Total Harga (A)</th>
                    <th>Sudah Dibayar (B)</th>
                    <th>Sisa Pembayaran (A-B)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rp {{ number_format($hargaPaket,0,',','.') }}</td>
                    <td>Rp {{ number_format($diskon,0,',','.') }}</td>
                    <td class="total-price-cell">Rp {{ number_format($total,0,',','.') }}</td>
                    <td>Rp {{ number_format($sudahBayar,0,',','.') }}</td>
                    <td class="outstanding-cell">Rp {{ number_format($sisa,0,',','.') }}</td>
                    <td>
                        @if($sisa <= 0)
                            <span class="status-badge status-lunas"><i class="bi bi-check-circle"></i> Lunas</span>
                        @else
                            <span class="status-badge status-belum"><i class="bi bi-x-circle"></i> Belum Lunas</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr class="separator"/>
    
    <div class="signature-section">
        <div class="signature-block">
            <p>Tangerang, {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
            <p class="role">Direktur</p>
            <div class="signature-space"></div>
            <p class="signer"><strong>PT. SYAKIRASYA WISATA MANDIRI</strong></p>
        </div>
        <div class="qr-block">
            {{-- Ganti dengan path QR code yang benar di server Anda --}}
            <img src="{{ asset('img/qr.png') }}" alt="QR Code" class="qr-code">
            <p>Scan for Official Verification</p>
        </div>
    </div>
    
    <div class="footer-note">
        <p>Terima kasih atas kepercayaan Anda memilih layanan kami.</p>
    </div>

</div>

<div class="btn-print-wrapper">
    <button onclick="window.print()" class="btn-print">
        <i class="bi bi-printer"></i> Print Invoice
    </button>
</div>

</body>
</html>
