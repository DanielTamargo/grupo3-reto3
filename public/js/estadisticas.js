var datos_tareas ;
var datos_tecnicos ;
var rol;
var id;
var tecnicosAverias = [];
var averiasUnAno = [];
var top5_averias = [];
var tareas ;
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: "/api/v1/estadisticas",
        success: function(json){
            console.log(json);
            datos_tareas = json['datos_tarea'];
            datos_tecnicos = json['datos_tecnico'];
            id = json['cod_jefe'];
            rol = json['rol'];
            ftareas();
            ascensorTecncios();
            ascensoresArregladosUnAnno();
            estadistica1Mostrar();
            estadistica2Mostrar();
            top5();
            estadistica3Mostrar();

        }
           
    });
})

function ftareas(){
    tareas =datos_tareas.filter(
        function(element){
            if(element.tipo == 'averia'){
                return element
            }
        }
    );

}

function ascensorTecncios(){
    for(let x =0;x<datos_tecnicos.length;x++){
        let cantidadAverias =0;
        for(let y=0; y<tareas.length;y++){
            if(datos_tecnicos[x]['codigo'] == tareas[y]['tecnico_codigo']){
                cantidadAverias++;
            }

        }
        
       tecnicosAverias.push({name:datos_tecnicos[x]['codigo'],y:cantidadAverias});
    }
}

function estadistica1Mostrar(){
    Highcharts.chart('container1', {
        chart: {
            backgroundColor: 'transparent',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Cada técnico cuantos ascensores ha arreglado en el último mes'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data : tecnicosAverias
        }]
    });
}

function ascensoresArregladosUnAnno(){
    let fecha = new Date();
    let annoActual = fecha.getFullYear();
    let mes_num = [01,02,03,04,05,06,07,08,09,10,11,12];

    if(rol == 'administrador'){
        for(let j=0;j<mes_num.length ;j++){
            let cantidadAverias =0;
            for(let y=0; y<tareas.length ;y++){
                if(tareas[y]['fecha_fin'] != null && Number(tareas[y]['fecha_fin'].substring(0,4)) == annoActual -1 && mes_num[j] == tareas[y]['fecha_fin'].substring(5,7) ){
                    cantidadAverias++
                   
                }
            }
            averiasUnAno.push(cantidadAverias);
        }
        
        
        
        
    }
    else{
        for(let x =0;x<datos_tecnicos.length;x++){
            for(let y =0;y<mes_num.length;y++){
                let cantidadAverias =0;
                for(let z=0;z<tareas.length;z++){
                    if(tareas[y]['fecha_fin'] != null && Number(tareas[y]['fecha_fin'].substring(0,4)) == annoActual -1 && mes_num[j] == tareas[y]['fecha_fin'].substring(5,7) && datos_tecnicos['jefe_codigo'] == id){
                        cantidadAverias++;
                    }
                }
                averiasUnAno.push(cantidadAverias);
            }
        }
    }
}

function estadistica2Mostrar(){
    const chart = Highcharts.chart('container2', {
        title: {
            text: 'Averias de ascensores en el último año'
        },
        chart: {
            backgroundColor: 'transparent',
        },
        subtitle: {
            text: 'Plain'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        series: [{
            type: 'column',
            colorByPoint: true,
            data: averiasUnAno,
            showInLegend: false
        }]
    });
}

function top5(){
    let averiasAscensores= [];
    let idAscensores= [];
    for(let y =0;y<tareas.length;y++){
        for(var x =0;x<idAscensores.length && idAscensores[x] != tareas[y]['ascensor_ref'];x++){}
        if(x == idAscensores.length){
            idAscensores.push(tareas[y]['ascensor_ref'])
        }
    }
   
    for(let j =0;j<idAscensores.length;j++){
        let averias =0;
        for(let z=0;z< tareas.length;z++){
            if(tareas[z]['ascensor_ref'] == idAscensores[j]){
                averias ++;
            }
        }
        averiasAscensores.push({ascensor_ref:idAscensores[j],cantidad_averias:averias});
    }
    for(let i=0;i<averiasAscensores.length;i++){
        if(averiasAscensores[i]['cantidad_averias']>=5){
            top5_averias.push({name:averiasAscensores[i]['ascensor_ref'],y:averiasAscensores[i]['cantidad_averias']});
        }
    }
   
   
}

function estadistica3Mostrar(){
    Highcharts.chart('container3', {
        chart: {
            backgroundColor: 'transparent',
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Top 5 de ascensores averiados',
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%'],
                size: '110%'
            }
        },
        series: [{
            type: 'pie',
            name: 'Averías',
            innerSize: '50%',
            data: top5_averias
        }]
    });
}
    
   


    var select = document.getElementById('opcionesEstadisticas');
    var estadistica1 = document.getElementById('container1');
    var estadistica2 = document.getElementById('container2');
    var estadistica3 = document.getElementById('container3');
    select.addEventListener('change', function(){
       var opcEstadistica = select.value;
       if(opcEstadistica == 'estadistica1'){
            estadistica1.style.display='block';
            estadistica2.style.display='none';
            estadistica3.style.display='none';
        }
        else{
            if(opcEstadistica == 'estadistica2'){
                estadistica1.style.display='none';
                estadistica2.style.display='block';
                estadistica3.style.display='none';
            }
            else{
                if(opcEstadistica == 'estadistica3'){
                    estadistica1.style.display='none';
                    estadistica2.style.display='none';
                    estadistica3.style.display='block';
                }
            }
        }
    })
