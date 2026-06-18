<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi {{ $pembayaran->no_kuitansi }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.5;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            border-bottom: 2px dashed #333;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 16px;
            font-weight: bold;
        }
        .header p {
            font-size: 11px;
            color: #555;
        }
        .receipt-no {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .info-row .label {
            color: #555;
        }
        .info-row .value {
            font-weight: bold;
            text-align: right;
        }
        .divider {
            border-top: 1px dashed #999;
            margin: 10px 0;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            font-weight: bold;
            margin: 10px 0;
            padding: 8px 0;
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 11px;
            color: #555;
        }
        .no-print {
            text-align: center;
            margin-bottom: 20px;
        }
        .no-print button {
            padding: 10px 30px;
            background: #1A3A5C;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }
        .no-print button:hover {
            background: #0F2740;
        }
        @media print {
            .no-print {
                display: none;
            }
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">Cetak Kuitansi</button>
    </div>

    <div class="header">
        <h1>SIM PDAM DESA</h1>
        <p>Sistem Informasi Manajemen PDAM</p>
        <p>KUITANSI PEMBAYARAN</p>
    </div>

    <div class="receipt-no">
        {{ $pembayaran->no_kuitansi }}
    </div>

    <div class="info-row">
        <span class="label">Tanggal</span>
        <span class="value">{{ $pembayaran->tanggal->format('d/m/Y H:i') }}</span>
    </div>

    <div class="divider"></div>

    <div class="info-row">
        <span class="label">Pelanggan</span>
        <span class="value">{{ $pembayaran->tagihan->pelanggan->nama ?? '-' }}</span>
    </div>
    <div class="info-row">
        <span class="label">No. Sambungan</span>
        <span class="value">{{ $pembayaran->tagihan->pelanggan->no_sambungan ?? '-' }}</span>
    </div>
    <div class="info-row">
        <span class="label">Alamat</span>
        <span class="value">{{ Str::limit($pembayaran->tagihan->pelanggan->alamat ?? '-', 30) }}</span>
    </div>

    <div class="divider"></div>

    <div class="info-row">
        <span class="label">Periode</span>
        <span class="value">{{ $pembayaran->tagihan->periode ?? '-' }}</span>
    </div>
    <div class="info-row">
        <span class="label">Pemakaian</span>
        <span class="value">{{ $pembayaran->tagihan->pemakaian ?? 0 }} m³</span>
    </div>
    <div class="info-row">
        <span class="label">Metode</span>
        <span class="value">{{ ucfirst($pembayaran->metode) }}</span>
    </div>

    <div class="total-row">
        <span>TOTAL BAYAR</span>
        <span>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</span>
    </div>

    <div class="info-row">
        <span class="label">Kasir</span>
        <span class="value">{{ $pembayaran->kasir->name ?? '-' }}</span>
    </div>

    <div class="footer">
        <p>Terima kasih atas pembayaran Anda.</p>
        <p>Simpan kuitansi ini sebagai bukti pembayaran.</p>
        <p style="margin-top: 10px;">Dicetak: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
