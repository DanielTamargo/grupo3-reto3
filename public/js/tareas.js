var todas_tareas = [];
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'GET',
        url:"/api/v1/tareas",
        success: function(json){
            console.log(json);
            //cogo todas las tareas e inicializo las primeras 10
            todas_tareas = json['tareas'];
            primerasDiez();
        }
    })
}
)

function primerasDiez(){
    //cogo el tbody
    let tbody = document.getElementsByTagName('tbody')[0];

    for(let x=0;x<10;x++){
         //creo los elementos necesarios para crear la tabla

            let p = document.createElement('p');

            let td_id = document.createElement('td');
            let td_fecha_i = document.createElement('td');
            let td_fecha_f = document.createElement('td');
            let td_tipo = document.createElement('td');
            let td_estado = document.createElement('td');
            let td_desc = document.createElement('td');
            let tr = document.createElement('tr');

            //les asigno el valor necesario a cada fila
            p = todas_tareas[x]['id'];
            td_id.append(p);
            tr.append(td_id);

            p = todas_tareas[x]['fecha_creacion'];
            td_fecha_f.append(p);
            tr.append( td_fecha_f);

            p = todas_tareas[x]['fecha_finalizacion'];
            td_fecha_i.append(p);
            tr.append(td_fecha_i);

            p = todas_tareas[x]['tipo'];
            if(todas_tareas[x]['prioridad'] == 0){
                tr.style.backgroundColor = 'red';
            }
            td_tipo.append(p);
            tr.append(td_tipo);

            p = todas_tareas[x]['estado'];
            td_estado.append(p);
            tr.append(td_estado);

            p = todas_tareas[x]['descripcion'];
            td_desc.append(p);
            tr.append(td_desc);
            
            //añado todas las filas al tbody para que aparezcan en la tabla
            tbody.append(tr);
    }
}

function diezAtras(){

  //cogo el primer y último id

    let id_1 = Number(document.getElementsByTagName('tr')[1].firstElementChild.innerHTML);
    let id_2 = Number(document.getElementsByTagName('tr')[10].firstElementChild.innerHTML);
    
    //compruebo que el id no sea menor de 1 ni de 10 para poder mostrar bien de 10 en 10
    if(id_1 > 1 && id_2 >10){
        //les resto a los id anteriores 10 para tener los id anteriores y mostrarlos
        id_1 = id_1 -10;
        id_2 = id_2 -10;
        let tbody = document.getElementsByTagName('tbody')[0];
        tbody.innerHTML= "";//borro el tbody para que no aparezcan todos juntos sino de 10 en 10
        for(let x =id_1-1;x<id_2;x++){
             //creo los elementos necesarios para crear la tabla

            let p = document.createElement('p');

            let td_id = document.createElement('td');
            let td_fecha_i = document.createElement('td');
            let td_fecha_f = document.createElement('td');
            let td_tipo = document.createElement('td');
            let td_estado = document.createElement('td');
            let td_desc = document.createElement('td');
            let tr = document.createElement('tr');

            //les asigno el valor necesario a cada fila

            p = todas_tareas[x]['id'];
            td_id.append(p);
            tr.append(td_id);

            p = todas_tareas[x]['fecha_creacion'];
            td_fecha_f.append(p);
            tr.append( td_fecha_f);

            p = todas_tareas[x]['fecha_finalizacion'];
            td_fecha_i.append(p);
            tr.append(td_fecha_i);

            p = todas_tareas[x]['tipo'];
            if(todas_tareas[x]['prioridad'] == 0){
                tr.style.backgroundColor = 'red';
            }
            td_tipo.append(p);
            tr.append(td_tipo);

            p = todas_tareas[x]['estado'];
            td_estado.append(p);
            tr.append(td_estado);

            p = todas_tareas[x]['descripcion'];
            td_desc.append(p);
            tr.append(td_desc);

            //añado todas las filas al tbody para que aparezcan en la tabla

            tbody.append(tr);
        }
    }
}

function diezDelante(){
    //cogo el primer y último id 
    let id_1 = Number(document.getElementsByTagName('tr')[1].firstElementChild.innerHTML);
    let id_2 = Number(document.getElementsByTagName('tr')[10].firstElementChild.innerHTML);
    
    //compruebo que sea 1 o mayor y 10 o mayor y les sumo 10 para mostrar las 10 tareas siguientes

    if(id_1 >= 1 && id_2>=10){
        id_1 = id_1 +10;
        id_2 = id_2 +10;

        let tbody = document.getElementsByTagName('tbody')[0];
        tbody.innerHTML= ""; //borro el tbody para que no aparezcan todos juntos sino de 10 en 10
        for(let x =id_1-1;x<id_2;x++){ //la x es el primer id -1 porque sino no coge el siguiente valor del ultimo id ej: si el ultimo id anterior ha sido 10 sin el -1 la siguiente vez que vayas a ver  las tareas en vez de empezar en el 11 empiezan en el 12
            
             //creo los elementos necesarios para crear la tabla

            let p = document.createElement('p');

            let td_id = document.createElement('td');
            let td_fecha_i = document.createElement('td');
            let td_fecha_f = document.createElement('td');
            let td_tipo = document.createElement('td');
            let td_estado = document.createElement('td');
            let td_desc = document.createElement('td');
            let tr = document.createElement('tr');

            //les asigno el valor necesario a cada fila

            p = todas_tareas[x]['id'];
            td_id.append(p);
            tr.append(td_id);

            p = todas_tareas[x]['fecha_creacion'];
            td_fecha_f.append(p);
            tr.append( td_fecha_f);

            p = todas_tareas[x]['fecha_finalizacion'];
            td_fecha_i.append(p);
            tr.append(td_fecha_i);

            p = todas_tareas[x]['tipo'];
            if(todas_tareas[x]['prioridad'] == 0){
                tr.style.backgroundColor = 'red';
            }
            else
            if(todas_tareas[x]['prioridad'] == 1){
                tr.style.backgroundColor = 'orange';
            }
            td_tipo.append(p);
            tr.append(td_tipo);

            p = todas_tareas[x]['estado'];
            td_estado.append(p);
            tr.append(td_estado);

            p = todas_tareas[x]['descripcion'];
            td_desc.append(p);
            tr.append(td_desc);

            //añado todas las filas al tbody para que aparezcan en la tabla

            tbody.append(tr);
        }
    }
}

// Listeneres modificaciones filtros
var obtenerDatosAsincrono;
var ms_asincronia = 800;
$('#filtro-num_ref').on('keyup', evt => {
    filtro_numref = evt.target.value;

    clearTimeout(obtenerDatosAsincrono);
    obtenerDatosAsincrono = setTimeout(obtenerDatos, ms_asincronia);
    obtenerDatosAsincrono;
});