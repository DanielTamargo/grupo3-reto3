<!DOCTYPE html>
<html lang="en">
<head>
    <!-- layout principal para las vistas de tecnicos -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- enlace a los estilos bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- estilos necesarios -->
    <style>
        #maincontainer {
            min-height: 90vh;
        }
        #fixednav {
            height: 70vh;
            width: 17%;
            position: fixed;
            right: 0;
            top: 15%;
            z-index: 2;
        }
        #top-nav-circle {
            height: 80px;
            width: 34%;
            position: fixed;
            right: -17%;
            top: 9%;
        }
        #bottom-nav-circle {
            height: 80px;
            width: 34%;
            position: fixed;
            right: -17%;
            bottom: 9%;
        }
    </style>
</head>
<body class="container-fluid min-vh-100">
    <header class="row bg-primary">
        <div class="col-3">
            <img src="" alt="logo" class="img-fluid">
            
        </div>
        <div class="col-auto">
            <h2>Ascensores igobide</h2>
        </div>
    </header>
    <div class="row py-2" id="maincontainer">
        <main class="col-10 g-0 p-2">
            <div class="p-2 bg-success h-100">
                <!-- contenido aqui -->
                @yield('content')
            </div>
        </main>
        <div class="col-2">
            <div>
                <div id="top-nav-circle" class="bg-secondary rounded-circle"></div>
                <nav class="text-center bg-secondary d-flex flex-column justify-content-around" id="fixednav">
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
            <div id="bottom-nav-circle" class="bg-secondary rounded-circle"></div>
            
        </div>
        
    </div>
    <footer class="row bg-warning">
        <div class="col">
            footer &copy;
        </div>
    </footer>
</body>
</html>