<html>
    <body>
        <h1>Hai, {{ $name }} <br> Selamat Datang di Aplikasi POS</h1>
        <hr>
        <h2>Products</h2>
        <ul>
            <a href="{{ url('/category/food-beverage') }}">Food & Beverage</a><br>
            <a href="{{ url('/category/beauty-health') }}">Beauty & Health</a><br>
            <a href="{{ url('/category/home-care') }}">Home Care</a><br>
            <a href="{{ url('/category/baby-kid') }}">Baby & Kid</a>
        </ul>
        <hr>
        <h2>User</h2>
        <ul><a href="{{ url('/user/244107020142/name/Prasojo') }}">Profile User</a></ul>
    </body>
</html>

