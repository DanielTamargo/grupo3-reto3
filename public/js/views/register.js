var jefes = [];
var avisos = [];
var errores = [];
$(function () {
    passwordAleatoria();
    $("#registro-dni").on('change', comprobarDNI);
    $("#registro-rol").on('change', seleccionRol);
});
function cadenaAleatoria(length) {
    if (length === void 0) { length = 10; }
    var cadena = '';
    var caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_?!';
    var longitudCaracteres = caracteres.length;
    for (var i = 0; i < length; i++) {
        cadena += caracteres.charAt(Math.floor(Math.random() * longitudCaracteres));
    }
    return cadena;
}
function passwordAleatoria(length) {
    if (length === void 0) { length = 10; }
    var password = cadenaAleatoria(length);
    $("#registro-password").val(password);
}
function validarDNI(dni) {
    if (typeof dni != "string") {
        console.log('Error: no se ha recibido un string');
        return false;
    }
    dni = dni.toUpperCase();
    var regex_dni = /^\d{8}[a-zA-Z]$/;
    if (!regex_dni.test(dni)) {
        return false;
    }
    var lista_letras = 'TRWAGMYFPDXBNJZSQVHLCKET';
    var numero = Number(dni.substring(0, dni.length - 1));
    var letra_dni = dni.substring(dni.length - 1);
    if (letra_dni != lista_letras.charAt(numero % 23)) {
        return false;
    }
    return true;
}
function comprobarDNI() {
    var input_dni = $("#registro-dni");
    var dni_valido = validarDNI(String(input_dni.val()));
    if (dni_valido) {
        $("#registro-submit").removeAttr('disabled');
        input_dni.removeClass("border-danger");
        input_dni.notify("", { autoHideDelay: 0, showDuration: 0 });
    }
    else {
        $("#registro-submit").attr('disabled', "true");
        input_dni.addClass("border-danger");
        input_dni.notify("DNI no válido.");
    }
}
function printearErrores() {
    var elm = $("#registro-errores");
    var contenido = "";
    for (var _i = 0, errores_1 = errores; _i < errores_1.length; _i++) {
        var error = errores_1[_i];
        contenido += "<p\n        class=\"p-3 border border-1 rounded border-danger\">".concat(error, "</p>");
    }
    elm.html(contenido);
}
function seleccionRol(evt) {
    var rol = evt.target.value;
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
                if (!data.ok)
                    throw Error("Error en la petición");
                var contenido = "\n                <label for=\"jefe_codigo\" class=\"\">Jefe asignado</label>\n                <select name=\"jefe_codigo\" id=\"registro-jefe_codigo\" class=\"form-select\">";
                jefes = data.jefes;
                for (var key in jefes) {
                    contenido += "<option value=\"".concat(key, "\">").concat(jefes[key]["nombre"], " (").concat(jefes[key]["codigo"], ")</option>");
                }
                contenido += "</select>";
                $("#registro-jefe-asignado").html(contenido);
                $("#registro-jefe_codigo").on('change', seleccionJefe);
                seleccionJefe();
            },
            error: function (data) {
                errores = ["Error al recoger los datos de los jefes disponibles. No se podrá vincular correctamente."];
                printearErrores();
            }
        });
    }
    else {
        $("#registro-jefe-asignado").html("");
    }
}
function seleccionJefe() {
    var num_tecnicos = jefes[String($("#registro-jefe_codigo").val())].num_tecnicos;
    $("#registro-jefe-asignado").notify("", { autoHideDelay: 0, showDuration: 0 });
    if (num_tecnicos >= 5) {
        $("#registro-jefe-asignado").notify("\u00A1Ojo! Este jefe ya tiene ".concat(num_tecnicos, " t\u00E9cnicos asignados"), "warn");
    }
}
//# sourceMappingURL=register.js.map