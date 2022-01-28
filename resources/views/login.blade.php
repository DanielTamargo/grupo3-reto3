<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- enlace a los estilos bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:wght@500&family=Ubuntu&display=swap');
        #contentcontainer {
            min-height: 75vh;
        }

        #head {
            background-color: blueviolet;
        }
        #head div p {
            font-family: 'Roboto', sans-serif;
        }
        #contentcontainer > * {
            font-family: 'Ubuntu', sans-serif;
        }
    </style>
</head>
<body class="container-fluid min-vh-100">
    <div class="row mx-2 justify-content-center h-100">
        <div class="col-12 text-center">
            <header class="row text center" id="head">
                <div class="col-3 col-md-2">
                    <img src="" alt="logo" class="img-fluid">
            
                </div>
                <div class="col">
                    <p class="display-5 mt-3">Ascensores igobide</p>
                </div>
            </header>
            <main class="row bg-light" id="contentcontainer">
                <form action="" method="POST" class="p-5 col">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-8">
                            <input type="text" name="user" id="usr" class="form-control my-2" placeholder="Usuario">
                            <input type="text" name="pass" id="pass" class="form-control my-2" placeholder="Contraseña">
                        </div>
                    </div>
                    <input type="submit" value="Iniciar sesion" class="btn btn-primary btn-lg mt-2">
                </form>
            </main>
            
        </div>
    </div>
</body>
</html>