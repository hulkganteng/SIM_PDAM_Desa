<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cetak Tagihan Massal</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: sans-serif;
            font-size: 11px;
            color: #1f2937;
            margin: 0;
            padding: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #1A3A5C;
        }
        .header h1 {
            margin: 0 0 4px;
            font-size: 18px;
        }
        .header p {
            margin: 0;
            color: #64748b;
        }
        .bill {
            border: 1px solid #94a3b8;
            border-radius: 4px;
            margin-bottom: 10px;
            padding: 10px;
            page-break-inside: avoid;
        }
        .bill-title {
            font-size: 14px;
            font-weight: bold;
            color: #1A3A5C;
            margin-bottom: 8px;
            padding-bottom: 6px;
            border-bottom: 1px solid #cbd5e1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 3px 0;
            vertical-align: top;
        }
        .label {
            color: #64748b;
            width: 120px;
        }
        .amount {
            font-size: 15px;
            font-weight: bold;
            color: #1A3A5C;
        }
        .status {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .status-unpaid {
            background: #fef3c7;
            color: #92400e;
        }
        .status-paid {
            background: #d1fae5;
            color: #065f46;
        }
        .footer {
            margin-top: 8px;
            padding-top: 6px;
            border-top: 1px dashed #cbd5e1;
            color: #64748b;
            font-size: 10px;
        }
        .empty {
            text-align: center;
            padding: 40px 0;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name', 'SIM PDAM Desa') }}</h1>
        <p>Cetak Tagihan Massal Periode {{ $periode }}{{ $status ? ' - ' . ucfirst(str_replace('_', ' ', $status)) : '' }}</p>
        <p>Dicetak pada {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    @forelse($tagihan as $item)
        <div class="bill">
            <div class="bill-title">Tagihan Air - {{ $item->periode }}</div>
            <table>
                <tr>
                    <td class="label">No Sambungan</td>
                    <td>{{ $item->pelanggan->no_sambungan ?? '-' }}</td>
                    <td class="label">Jatuh Tempo</td>
                    <td>{{ $item->jatuh_tempo->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Nama</td>
                    <td>{{ $item->pelanggan->nama ?? '-' }}</td>
                    <td class="label">Status</td>
                    <td>
                        <span class="status {{ $item->status === 'lunas' ? 'status-paid' : 'status-unpaid' }}">
                            {{ $item->status === 'lunas' ? 'Lunas' : 'Belum Bayar' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="label">Alamat</td>
                    <td colspan="3">{{ $item->pelanggan->alamat ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Golongan</td>
                    <td>{{ $item->pelanggan->golonganTarif->nama ?? '-' }}</td>
                    <td class="label">Pemakaian</td>
                    <td>{{ number_format($item->pemakaian, 0, ',', '.') }} m3</td>
                </tr>
                <tr>
                    <td class="label">Tarif per m³</td>
                    <td>Rp {{ number_format($item->tarif_per_m3, 0, ',', '.') }}</td>
                    <td class="label">Biaya Beban</td>
                    <td>Rp {{ number_format($item->biaya_beban, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Denda</td>
                    <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                    <td class="label">Total</td>
                    <td class="amount">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
            </table>
            <div class="footer">
                Simpan lembar ini sebagai bukti informasi tagihan. Abaikan jika tagihan sudah dibayar.
            </div>
        </div>
    @empty
        <div class="empty">Tidak ada data tagihan untuk periode ini.</div>
    @endforelse
</body>
</html>
