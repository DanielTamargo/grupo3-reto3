// Script preparado para la vista registro

// Document Ready
$(() => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.get("./api/codigosJefes", function(data, status){
        console.log(data)
    });
    

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
function validarDNI() {

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

    }
}
