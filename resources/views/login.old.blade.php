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
        body {
            height: 100vh;
        }

        #head {
            background-color: blueviolet;
        }
    </style>
</head>
<body class="container-fluid">
    <div class="row mx-1 justify-content-center align-items-center h-100">
        <div class="col-12 col-md-6 text-center">
            <div class="row text center" id="head">
                <div class="col">
                    <p class="display-4">Ascensores igobide</p>
                </div>
            </div>
            <div class="row bg-light">
                <form action="" method="POST" class="p-5 col">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-8">
                            <input type="text" name="user" id="usr" class="form-control my-2" placeholder="Usuario">
                            <input type="text" name="pass" id="pass" class="form-control my-2" placeholder="Contraseña">
                        </div>
                    </div>
                    <input type="submit" value="Iniciar sesion" class="btn btn-primary btn-lg mt-2">
                </form>
            </div>
            
        </div>
    </div>
</body>
</html>