// Variables globales
var filtro_numref = "";
var filtro_ubicacion = "";
var seleccionar_ascensor = $('#seleccionar-ascensor').val();
var ruta_modelo = $('#ruta-show-modelo').val();

// Volcará los datos en la tabla
function volcarDatos(ascensores, modelos) {
    let contenido = "";
    let modelo = "";

    for (let ascensor of ascensores) {
        modelo = modelos.find(model => model.id == ascensor.modelo_id).nombre;
        contenido += `<tr>
            <th scope="row">${ascensor.num_ref}</th>
        `;
        if (seleccionar_ascensor == "true") {
            contenido += `<td>${modelo}</td>`;
        } else {
            contenido += `<td><a class="empleados" href="${ruta_modelo.replace('modelo_id', ascensor.modelo_id)}">${modelo}</a></td>`;
        }
        contenido += `<td>${ascensor.ubicacion}</td>`;
        if (seleccionar_ascensor == "true") {
            contenido += `<td><a class="empleados" id="${ascensor.num_ref}" onclick="seleccionarAscensor(this)" data-bs-dismiss="modal" href="#seleccion-ascensor">Seleccionar</a></td>`;
        } else {
            contenido += `<td>${ascensor.fecha_instalacion}</td>`;
            contenido += `<td>${ascensor.fecha_ultima_revision}</td>`;
        }
    }

    $('#lista-ascensores').html(contenido);
}

// Función que realiza una petición ajax al servidor en pos de
//    obtener los datos de los ascensores en base a los filtros establecidos
function obtenerDatos() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "GET",
        url: "/api/v1/ascensores",
        data: {
            "filtro_numref": filtro_numref,
            "filtro_ubicacion": filtro_ubicacion 
        },
        success: function (data) {
            if (data.ok) volcarDatos(data.ascensores, data.modelos);
            else console.log(data.message);
        },
        error: function (data) {
            console.log(data);
        }
    });
}

// Marcará como seleccionado el ascensor en cuestión y lo colocará en el input ascensor-num_ref
// También cerrará la ventana modal
// ESTA FUNCIÓN SÓLO FUNCIONARÁ EN LA VENTANA NUEVA TAREA
function seleccionarAscensor(elm) {
    let ascensor_num_ref = elm.id;

    // TODO dani: poner en el input
    $('#ascensor_num_ref').val(ascensor_num_ref);
} 

// Obtendrá los datos de forma asíncrona
var ms_asincronia = 800;
var obtenerDatosAsincrono;

// Listeneres modificaciones filtros
$('#filtro-num_ref').on('keyup', evt => {
    filtro_numref = evt.target.value;

    clearTimeout(obtenerDatosAsincrono);
    obtenerDatosAsincrono = setTimeout(obtenerDatos, ms_asincronia);
    obtenerDatosAsincrono;
});
// Listener modificación campo
$('#filtro-ubicacion').on('keyup', evt => {
    filtro_ubicacion = evt.target.value;

    clearTimeout(obtenerDatosAsincrono);
    obtenerDatosAsincrono = setTimeout(obtenerDatos, ms_asincronia);
    obtenerDatosAsincrono;
});
