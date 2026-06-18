<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Pelanggan</title>
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
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-aktif {
            background-color: #d1fae5;
            color: #065f46;
        }
        .badge-nonaktif {
            background-color: #fef3c7;
            color: #92400e;
        }
        .badge-diputus {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name', 'SIM PDAM Desa') }}</h1>
        <h2>Daftar Pelanggan PDAM Desa</h2>
        <p class="date">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 30px;">No</th>
                <th>No Sambungan</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Golongan</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $pelanggan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $pelanggan->no_sambungan }}</td>
                    <td>{{ $pelanggan->nama }}</td>
                    <td>{{ $pelanggan->alamat }}</td>
                    <td>{{ $pelanggan->golonganTarif->nama ?? '-' }}</td>
                    <td class="text-center">
                        <span class="badge badge-{{ $pelanggan->status }}">
                            {{ ucfirst($pelanggan->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pelanggan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>{{ config('app.name', 'SIM PDAM Desa') }} &mdash; Daftar Pelanggan</p>
    </div>
</body>
</html>
