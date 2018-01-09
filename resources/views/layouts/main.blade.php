<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    @yield('styles')

</head>

<!--  -->
<!-- / -->

<body>
<div class="container">
    <div class="page-header">
        <h1>Criptocurrencies</h1>
        <button id="update_data" class="btn">Update data</button>
    </div>
    <section class="main">
        @yield('content')
    </section>
</div>

<div id="footer">
    <div class="container">
        <p class="text-muted text-center">&copy; {{date("Y")}}</p>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
@yield('scripts')

</body>
</html>