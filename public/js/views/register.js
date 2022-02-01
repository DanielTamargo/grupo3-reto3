// Script preparado para la vista registro

// Document Ready
$(() => {
    // Generamos una contraseña aleatoria
    passwordAleatoria();

    // Listener submit
    $("#registro-submit").on('click', registroSubmit);

    // Listener cambio en la selección del rol
    $("#registro-rol").on('change', seleccionRol);
});

/**
 * Genera un string aleatorio y lo devuelve
 * @param length {int} define la longitud del string aleatorio
 */
function cadenaAleatoria(length=8) {
    let cadena = '';
    let caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let longitudCaracteres = caracteres.length;
    for (let i = 0; i < length; i++) {
        cadena += caracteres.charAt(Math.floor(Math.random() * longitudCaracteres));
    }
    return cadena;
}

/**
 * Obtiene un string aleatorio y lo pone en el input como password aleatoria
 * @param length {int} define la longitud de la contraseña
 */
function passwordAleatoria(length=8) {
    let password = cadenaAleatoria(length);
    $("#registro-password").val(password);
}

/**
 * Valida el DNI introducido (expresión regular y comprobación dni válida)
 */
function validarDNI(dni) {
    // Comprobamos que hemos recibido un string
    if (typeof dni != "string") {
        console.log('Error: no se ha recibido un string');
        return false;
    }

    dni = dni.toUpperCase();
    let regex_dni = /^\d{8}[a-zA-Z]$/;

    // Comprobamos la expresión regular
    if (!regex_dni.test(dni)) {
        // Error: ¡Formato no válido!
        console.log('Error: formato DNI no válido');
        return false;
    }

    // Comprobamos el valor de la letra del DNI
    let lista_letras = 'TRWAGMYFPDXBNJZSQVHLCKET';
    let numero = dni.substr(0, dni.length - 1);
    let letra_dni = dni.substr(dni.length - 1, 1);
    if (letra_dni != lista_letras.charAt(numero % 23)) {
        // Error: ¡DNI no válido!
        console.log('Error: DNI no válido');
        return false;
    }

    // ¡DNI Válido!
    console.log('¡DNI válido!')
    return true;
}

/**
 * Submit del formulario registro
 */
function registroSubmit(evt) {
    evt.preventDefault();
}

/**
 * Listener de selección de rol
 * Si selecciona técnico, se mostrará el técnico jefe a asociar
 */
function seleccionRol(evt) {
    let rol = evt.target.value;

    if (rol == "tecnico") {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: "/api/v1/codigosJefes",
            success: function (data) {
                console.log(data)
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}

