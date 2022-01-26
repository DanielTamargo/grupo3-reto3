<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- enlace a los estilos bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="container">
    <div class="row m-5 justify-content-center">
        <div class="col-12 col-md-6 bg-light">
            <form action="" method="POST" class="p-2">
                <p class="display-2 text-center">Iniciar sesion</p>
                <label for="usr" class="form-label">Usuario</label>
                <input type="text" name="user" id="usr" class="form-control">
                <label for="pass" class="form-label">Contrase&ntilde;a</label>
                <input type="text" name="pass" id="pass" class="form-control">
                <input type="submit" value="Iniciar sesion" class="btn btn-primary mt-2">
            </form>
        </div>
    </div>
</body>
</html>