// Volcará los datos en la tabla
function volcarDatosTecnicos(tecnicos) {
    let contenido = "";

    // Ordenamos los técnicos según su disponibilidad, dejando abajo los que tengan urgencias pendientes
    tecnicos = tecnicos.sort((a, b) => {
        if (a.num_urgencias_pdtes === b.num_urgencias_pdtes) return a.num_tareas_pdtes - b.num_tareas_pdtes;
        return a.num_urgencias_pdtes - b.num_urgencias_pdtes;
    });

    for (let tecnico of tecnicos) {
        contenido += `<tr>
            <th scope="row">${tecnico.codigo}</th>
            <th scope="row">${tecnico.nombre}</th>
            <th class="d-sm-none d-md-block" scope="row">${tecnico.jefe_nombre}</th>
            <th scope="row">${tecnico.num_tareas_pdtes} tarea(s) | ${tecnico.num_urgencias_pdtes} urgencia(s)</th>
            <th scope="row"><a class="empleados" id="${tecnico.codigo}" onclick="seleccionarTecnico(this)" data-bs-dismiss="modal" href="#seleccion-tecnico">Seleccionar</a></th>
        `;
    }

    $('#lista-tecnicos').html(contenido);
}

// Función que realiza una petición ajax al servidor en pos de
//    obtener los datos de los ascensores en base a los filtros establecidos
function obtenerDatosTecnicos() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "GET",
        url: "/api/v1/tecnicos-disponibles",
        success: function (data) {
            if (data.ok) volcarDatosTecnicos(data.tecnicos);
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
function seleccionarTecnico(elm) {
    let tecnico_codigo = elm.id;
    $('#tecnico_codigo').val(tecnico_codigo);
}
