var todas_tareas = [];
var tecnicos = [];
var tbody = document.getElementsByTagName('tbody')[0];
var filtro_numref = "";
var filtro_estado = "";
var filtro_tipo = "";
var pagina = 1;

var ruta_modelo = $('#ruta-show-modelo').val();
var ruta_tecnico = $('#ruta-show-tecnico').val();

var ascensores = [];
var tecnicos = [];

$(document).ready(function(){
    obtenerDatos();
});


function obtenerDatos(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'GET',
        url:"/api/v1/tareas",
        data:{
            'filtro_numref': filtro_numref,
            'filtro_estado': filtro_estado,
            'filtro_tipo': filtro_tipo
        },
        success: function(json){
            console.log(json);
            //cogo todas las tareas e inicializo las primeras 10
            todas_tareas = json['tareas'];
<<<<<<< HEAD
            tecnicos = json['tecnicos'];
            
=======
            tecnicos = json["tecnicos"];
            ascensores = json["ascensores"];
>>>>>>> 6e29abed016fdeac7baeec5cf700a3b4c3167153
            mostrarTareas(null);
        }
    })
}

function mostrarTareas(suma){
    //creo las variables para coger el primer y último id
  let id_1 = ""
  let id_2 =""

  switch(suma){
      //dependiendo si quiere mostrar mas tareas, las tareas anteriores o es la primera vez que entra haremos diferentes cosas

      case null:
        //si es la primera vez que entra los identificadores serán 1 y 10

       pagina = 1;
        break;
    case true:
        // si quiere ver las siguientes tareas se añadira 10 al id k se este mostrando

        pagina++;
        
        break;
    case false:
         // si quiere ver las tareas anteriores se añadira 10 al id k se este mostrando
        pagina--;
        break;
  }

  // si el id de la primera tarea es menor que 0 le dejamos las 10 primeras tareas
  if (pagina < 1 ) {
      pagina = 1;
      return;
  }

  //vaciamos el tbody para que que aparezcan las 10 tareas que queremos y no se añadan a las que ya estan

  tbody.innerHTML = "";

    for(let x=(pagina - 1) * 10;x<pagina * 10;x++){
        if (!todas_tareas[x]) continue;
        //creo los elementos necesarios para crear la tabla
        let p = document.createElement('p');
        let a = document.createElement('a');
        let tr = document.createElement('tr');
        

        let td_id = document.createElement('td');
        let td_fecha_i = document.createElement('td');
        let td_fecha_f = document.createElement('td');
        let td_tipo = document.createElement('td');
        let td_estado = document.createElement('td');
        let td_asc = document.createElement('td');
        let td_tec = document.createElement('td');
        
            

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
        td_tipo.append(p);
        tr.append(td_tipo);

        let ascensor = ascensores.find((asc) => asc.num_ref == todas_tareas[x]["ascensor_ref"]);
        a = document.createElement('a');
        a.text = todas_tareas[x]['ascensor_ref'];
        a.href = ruta_modelo.replace('modelo_id', ascensor.modelo_id);
        td_asc.append(a);
        tr.append(td_asc);
        
        let tecnico = tecnicos.find((tec) => tec.codigo == todas_tareas[x]["tecnico_codigo"]);
        a = document.createElement('a');
        a.text = todas_tareas[x]['tecnico_codigo'];
        a.href = ruta_tecnico.replace('empleado_id', tecnico.user_id);
        td_tec.append(a);
        tr.append(td_tec);
        
        switch(todas_tareas[x]['estado']){  
            case "sintratar": 
                p = "Sin tratar";
                break;     
            case "imposiblesolucionar": 
                p = "Sin solución";
                break;     
            case "retrasado": 
                p = "Retrasado";
                break;     
            case "finalizado": 
                p = "Finalizado";
                break;     
            case "materialnecesario": 
                p = "Sin material";
                break;     
        }
        td_estado.append(p);
        tr.append(td_estado);
        
        //Dependiendo de la prioridad de la tarea, la fila va a ser de un color u otro

        switch(todas_tareas[x]['prioridad']){  
            case 1: td_estado.style.backgroundColor = 'rgba(56,180,59,0.2)';
                break;
            
            case 2: td_estado.style.backgroundColor = 'rgba(80,80,206,0.2)';
                break;
            
            case 3: td_estado.style.backgroundColor = 'rgba(255,255,0,0.2)';
                break;
            
            case 4: td_estado.style.backgroundColor = 'rgba(236,171,49,0.2)';
                break;
            
            case 5: td_estado.style.backgroundColor = 'rgba(139,0,0,0.2)';
                break;        
        }

        
        //añado todas las filas al tbody para que aparezcan en la tabla
        tbody.append(tr);
    }
}


// Listeneres modificaciones filtros
var obtenerDatosAsincrono;
var ms_asincronia = 800;

//Filtro por la referencia del ascensor

$('#filtro-num_ref').on('keyup', evt => {
    filtro_numref = evt.target.value;

    clearTimeout(obtenerDatosAsincrono);
    obtenerDatosAsincrono = setTimeout(obtenerDatos, ms_asincronia);
    obtenerDatosAsincrono;
});

//Filtro por la referencia por el tipo de tarea

$('#tipo').on('change', evt => {
    filtro_tipo = evt.target.value;

    clearTimeout(obtenerDatosAsincrono);
    obtenerDatosAsincrono = setTimeout(obtenerDatos, ms_asincronia);
    obtenerDatosAsincrono;
});

//Filtro por el estado de la tarea

$('#estado').on('change', evt => {
    filtro_estado = evt.target.value;

    clearTimeout(obtenerDatosAsincrono);
    obtenerDatosAsincrono = setTimeout(obtenerDatos, ms_asincronia);
    obtenerDatosAsincrono;
});