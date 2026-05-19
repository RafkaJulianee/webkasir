<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Laporan Data Produk</h2>
    <p>Tanggal Cetak: {{ now()->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB</p>
    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="30%">Nama Produk</th>
                <th width="20%">Kategori</th>
                <th width="20%">Harga</th>
                <th width="10%" class="text-center">Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_produk }}</td>
                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="text-center">{{ $item->stok }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
