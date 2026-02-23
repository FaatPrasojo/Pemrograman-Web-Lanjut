<!DOCTYPE html>
<html>
<head>
    <title>Profil Pengguna</title>
</head>
<body>

    <h1>Profil Pengguna</h1>
    <hr>

    <p><strong>ID Pengguna:</strong> {{ $id }}</p>
    <p><strong>Nama Pengguna:</strong> {{ $name }}</p>

    <hr>
    <a href="{{ url('/home') }}">Kembali ke Home</a>

</body>
</html>