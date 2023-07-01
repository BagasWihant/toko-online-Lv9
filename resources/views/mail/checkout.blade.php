
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link id="pagestyle" href="{{ asset('assets/admin/css/soft-ui-dashboardnew.css') }}" rel="stylesheet">
</head>
<body>
    <p>Pembayaran Senilai <span class="font-weight-bolder">{{ $order->total_harga }}</span> Berhasil</p>
<p>Transaksi #{{ $order->transaksi_id }}</p>
<table class="table">
<thead>
    <th>Produk</th>
    <th>Warna</th>
    <th>Jumlah</th>
    <th>Harga</th>
</thead>
    @foreach ($order->orderDetail as $detail)
    <tr>
        <td>{{ $detail->produk->name }}</td>
        <td>{{ $detail->produkWarna->warna }}</td>
        <td>{{ $detail->qty }}</td>
        <td>{{ number_format($detail->produk->harga_jual * $detail->qty) }}</td>
    </tr>
    @endforeach
</table>
</body>
</html>
