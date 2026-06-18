<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pembayaran</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 18px;
            margin-bottom: 4px;
        }
        .header h2 {
            font-size: 14px;
            font-weight: normal;
            margin-bottom: 4px;
        }
        .header .date {
            font-size: 10px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th,
        table td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: left;
            font-size: 11px;
        }
        table th {
            background-color: #2563eb;
            color: #fff;
            font-weight: bold;
        }
        table tr:nth-child(even) {
            background-color: #f3f4f6;
        }
        table tr:hover {
            background-color: #e5e7eb;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name', 'SIM PDAM Desa') }}</h1>
        <h2>Laporan Pembayaran {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</h2>
        <p class="date">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 30px;">No</th>
                <th>Tanggal</th>
                <th>No Kuitansi</th>
                <th>Nama Pelanggan</th>
                <th class="text-right">Jumlah</th>
                <th class="text-center">Metode</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $pembayaran)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $pembayaran->tanggal->format('d/m/Y H:i') }}</td>
                    <td>{{ $pembayaran->no_kuitansi }}</td>
                    <td>{{ $pembayaran->tagihan->pelanggan->nama ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                    <td class="text-center">{{ ucfirst($pembayaran->metode) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pembayaran untuk rentang tanggal ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>{{ config('app.name', 'SIM PDAM Desa') }} &mdash; Laporan Pembayaran {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
    </div>
</body>
</html>
