<!DOCTYPE html>
<html>
<head>
    <title>POS - Penjualan</title>
</head>
<body>

    <h1>Transaksi Penjualan (POS)</h1>

    <hr>
    
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Produk A</td>
                <td>Rp 20.000</td>
                <td>2</td>
                <td>Rp 40.000</td>
            </tr>
            <tr>
                <td>Produk B</td>
                <td>Rp 12.000</td>
                <td>1</td>
                <td>Rp 12.000</td>
            </tr>
        </tbody>
        <tr>
            <th colspan="3" align="right">Total Bayar:</th>
            <th>Rp 52.000</th>
        </tr>
    </table>

    <hr>

    <h3>Pembayaran</h3>
    <form action="{{ route('sales.process') }}" method="POST">
        @csrf
        <p>Total yang harus dibayar: <strong>Rp 52.000</strong></p>
        <label>Masukkan Uang Bayar:</label><br>
        <input type="number" name="payment" required><br><br>
        <button type="submit">Bayar Sekarang</button>
    </form>
    <br>

    @if(session('message'))
        <div>
            <strong>{{ session('message') }}</strong>
        </div>
    @endif

    <br>
    <a href="{{ url('/home') }}">Kembali ke Home</a>

</body>
</html>