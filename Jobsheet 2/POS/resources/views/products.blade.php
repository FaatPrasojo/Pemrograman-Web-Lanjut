<!DOCTYPE html>
<html>
<head>
    <title>Produk - {{ $category }}</title>
</head>
<body>

    <a href="{{ url('/home') }}">Kembali ke Home</a>

    <hr>

    <h1>Kategori: {{ $category }}</h1>
    <p>Daftar produk yang tersedia di kategori ini:</p>

    <ul>
        <li>Produk 1 (Rp 10.000)</li>
        <li>Produk 2 (Rp 20.000)</li>
        <li>Produk 3 (Rp 30.000)</li>
    </ul>

    <hr>

    <p>Anda sedang melihat halaman produk untuk <strong>{{ $category }}</strong>.</p>

</body>
</html>