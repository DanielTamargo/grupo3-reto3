// Script preparado para la vista registro

// Variables globales
var jefes = [];
var avisos = [];
var errores = [];

// Document Ready
$(() => {
    // Generamos una contraseña aleatoria
    passwordAleatoria();

    // Listener input dni
    $("#registro-dni").on('change', comprobarDNI);

    // Listener cambio en la selección del rol
    $("#registro-rol").on('change', seleccionRol);
});

/**
 * Genera un string aleatorio y lo devuelve
 * @param {int} length define la longitud del string aleatorio
 */
function cadenaAleatoria(length=10) {
    let cadena = '';
    let caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_?!';
    let longitudCaracteres = caracteres.length;
    for (let i = 0; i < length; i++) {
        cadena += caracteres.charAt(Math.floor(Math.random() * longitudCaracteres));
    }
    return cadena;
}

/**
 * Obtiene un string aleatorio y lo pone en el input como password aleatoria
 * @param {int} length define la longitud de la contraseña
 */
function passwordAleatoria(length=10) {
    let password = cadenaAleatoria(length);
    $("#registro-password").val(password);
}

/**
 * Valida el DNI introducido (expresión regular y comprobación dni válida)
 * @param {string} dni DNI a comprobar
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
    let numero = dni.substring(0, dni.length - 1);
    let letra_dni = dni.substring(dni.length - 1);
    if (letra_dni != lista_letras.charAt(numero % 23)) {
        // Error: ¡DNI no válido!
        console.log('Error: DNI no válido');
        return false;
    }

    // ¡DNI Válido!
    console.log('¡DNI válido!');
    return true;
}

/**
 * Comprueba el DNI, si no es válido lo notifica y bloquea el botón submit,
 * si es válido desbloquea el botón submit si ha sido bloqueado
 */
function comprobarDNI() {
    let input_dni = $("#registro-dni");
    let dni_valido = validarDNI(input_dni.val());
    if (dni_valido) {
        $("#registro-submit").attr('disabled', false);
        input_dni.removeClass("border-danger");
    } else {
        $("#registro-submit").attr('disabled', true);
        input_dni.addClass("border-danger");
        input_dni.notify("DNI no válido.");
    }
}

/**
 * Función que printea los avisos
 */
function printearErrores() {
    let elm = $("#registro-errores");
    let contenido = "";

    for (let error of errores) {
        contenido += `<p
        class="p-3 border border-1 rounded border-danger">${error}</p>`;
    }

    elm.html(contenido);
}

/**
 * Listener de selección de rol
 * Si selecciona técnico, se mostrará el técnico jefe a asociar
 */
function seleccionRol(evt) {
    let rol = evt.target.value;

    // Si selecciona rol técnico, cargamos los jefes disponibles para que seleccione
    //   si está registrando el técnico un jefe de equipo, solo podrá seleccionarse a sí mismo
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
                if (!data.ok) throw Error("Error en la petición");

                let contenido = `
                <label for="jefe_codigo" class="">Jefe asignado</label>
                <select name="jefe_codigo" id="registro-jefe_codigo" class="form-select">`;

                jefes = data.jefes;
                for (let key in jefes) {
                    contenido += `<option value="${key}">${jefes[key]["nombre"]} (${jefes[key]["codigo"]})</option>`;
                }

                contenido += "</select>";

                $("#registro-jefe-asignado").html(contenido);
                $("#registro-jefe_codigo").on('change', seleccionJefe);
                seleccionJefe();
            },
            error: function (data) {
                // TODO dani: no me convence, ¿pasar a alerta?
                errores = [ "Error al recoger los datos de los jefes disponibles. No se podrá vincular correctamente." ];
                printearErrores();
                //alert("Error al recoger los códigos de jefes disponibles.\n" + data);
            }
        });
    } else {
        $("#registro-jefe-asignado").html("");
    }
}

/**
 * Comprueba si el jefe ya tiene varios empleados a su cargo y si es un número notable (default: 5), lo notifica
 */
function seleccionJefe() {
    let num_tecnicos = jefes[$("#registro-jefe_codigo").val()].num_tecnicos;
    notify = $("#registro-jefe-asignado").notify(``, { autoHideDelay: 0, showDuration: 0 }); // <- para ocultar posible notificación previa
    if (num_tecnicos >= 5) {
        notify = $("#registro-jefe-asignado").notify(`¡Ojo! Este jefe ya tiene ${num_tecnicos} técnicos asignados`, "warn")
    }
}

