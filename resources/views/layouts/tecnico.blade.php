<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- enlace a los estilos bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="container">
    <header class="row bg-primary">
        <div class="col">
            <img src="" alt="logo" class="img-fluid">
            
        </div>
        <div class="col">
            <h2>Ascensores igobide</h2>
        </div>
    </header>
    <div class="row py-1">
        <main class="col-10">
            <!-- contenido aqui -->
            @yield('content')
        </main>
        <nav class="col-2 bg-secondary d-flex flex-column justify-content-around rounded-start">
            <div>
                <a href="#" class="btn btn-light btn-lg">a</a>
            </div>
            <div>
                <a href="#" class="btn btn-light btn-lg">b</a>
            </div>
            <div>
                <a href="#" class="btn btn-light btn-lg">c</a>
            </div>
            <div>
                <a href="#" class="btn btn-light btn-lg">d</a>
            </div>
        </nav>
    </div>
    <footer class="row bg-warning">
        <div class="col">
            footer &copy;
        </div>
    </footer>
</body>
</html>