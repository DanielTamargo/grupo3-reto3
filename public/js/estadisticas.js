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
        data: [{
            name: 'Tecnico 1',
            y: 61.41,
            sliced: true,
            selected: true
        }, {
            name: 'Tecnico 2',
            y: 11.84
        }, {
            name: 'Tecnico 3',
            y: 10.85
        }, {
            name: 'Tecnico 4',
            y: 4.67
        }, {
            name: 'Tecnico 5',
            y: 4.18
        }, {
            name: 'Tecnico 6',
            y: 1.64
        }, {
            name: 'Tecnico 7',
            y: 1.6
        }, {
            name: 'Tecnico 8',
            y: 1.2
        }, {
            name: 'Tecnico 9',
            y: 2.61
        }]
    }]
});

    Highcharts.chart('container2', {
    chart: {
        backgroundColor: 'transparent',
        type: 'column'
    },
    title: {
        text: 'Tú equipo cuantos ascensores ha arreglado en el último año'
    },
    subtitle: {
        text: 'Click the columns to view versions'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total percent market share'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: "Browsers",
            colorByPoint: true,
            data: [
                {
                    name: "Enero",
                    y: 62.74,
                    drilldown: "Enero"
                },
                {
                    name: "Febrero",
                    y: 10.57,
                    drilldown: "Febrero"
                },
                {
                    name: "Marzo",
                    y: 7.23,
                    drilldown: "Marzo"
                },
                {
                    name: "Abril",
                    y: 5.58,
                    drilldown: "Abril"
                },
                {
                    name: "Mayo",
                    y: 4.02,
                    drilldown: "Mayo"
                },
                {
                    name: "Junio",
                    y: 1.92,
                    drilldown: "Junio"
                },
                {
                    name: "Julio",
                    y: 7.62,
                    drilldown: 'Julio'
                },
                {
                    name: "Agosto",
                    y: 2.50,
                    drilldown: 'Agosto'
                },
                {
                    name: "Septiembre",
                    y: 6.43,
                    drilldown: 'Septiembre'
                },
                {
                    name: "Octubre",
                    y: 8.95,
                    drilldown: 'Octubre'
                },
                {
                    name: "Noviembre",
                    y: 1.33,
                    drilldown: 'Noviembre'
                },
                {
                    name: "Diciembre",
                    y: 3.55,
                    drilldown: 'Diciembre'
                }
            ]
        }
    ],
    drilldown: {
        series: [
            {
                name: "Chrome",
                id: "Chrome",
                data: [
                    [
                        "v65.0",
                        0.1
                    ],
                    [
                        "v64.0",
                        1.3
                    ],
                    [
                        "v63.0",
                        53.02
                    ],
                    [
                        "v62.0",
                        1.4
                    ],
                    [
                        "v61.0",
                        0.88
                    ],
                    [
                        "v60.0",
                        0.56
                    ],
                    [
                        "v59.0",
                        0.45
                    ],
                    [
                        "v58.0",
                        0.49
                    ],
                    [
                        "v57.0",
                        0.32
                    ],
                    [
                        "v56.0",
                        0.29
                    ],
                    [
                        "v55.0",
                        0.79
                    ],
                    [
                        "v54.0",
                        0.18
                    ],
                    [
                        "v51.0",
                        0.13
                    ],
                    [
                        "v49.0",
                        2.16
                    ],
                    [
                        "v48.0",
                        0.13
                    ],
                    [
                        "v47.0",
                        0.11
                    ],
                    [
                        "v43.0",
                        0.17
                    ],
                    [
                        "v29.0",
                        0.26
                    ]
                ]
            },
            {
                name: "Firefox",
                id: "Firefox",
                data: [
                    [
                        "v58.0",
                        1.02
                    ],
                    [
                        "v57.0",
                        7.36
                    ],
                    [
                        "v56.0",
                        0.35
                    ],
                    [
                        "v55.0",
                        0.11
                    ],
                    [
                        "v54.0",
                        0.1
                    ],
                    [
                        "v52.0",
                        0.95
                    ],
                    [
                        "v51.0",
                        0.15
                    ],
                    [
                        "v50.0",
                        0.1
                    ],
                    [
                        "v48.0",
                        0.31
                    ],
                    [
                        "v47.0",
                        0.12
                    ]
                ]
            },
            {
                name: "Internet Explorer",
                id: "Internet Explorer",
                data: [
                    [
                        "v11.0",
                        6.2
                    ],
                    [
                        "v10.0",
                        0.29
                    ],
                    [
                        "v9.0",
                        0.27
                    ],
                    [
                        "v8.0",
                        0.47
                    ]
                ]
            },
            {
                name: "Safari",
                id: "Safari",
                data: [
                    [
                        "v11.0",
                        3.39
                    ],
                    [
                        "v10.1",
                        0.96
                    ],
                    [
                        "v10.0",
                        0.36
                    ],
                    [
                        "v9.1",
                        0.54
                    ],
                    [
                        "v9.0",
                        0.13
                    ],
                    [
                        "v5.1",
                        0.2
                    ]
                ]
            },
            {
                name: "Edge",
                id: "Edge",
                data: [
                    [
                        "v16",
                        2.6
                    ],
                    [
                        "v15",
                        0.92
                    ],
                    [
                        "v14",
                        0.4
                    ],
                    [
                        "v13",
                        0.1
                    ]
                ]
            },
            {
                name: "Opera",
                id: "Opera",
                data: [
                    [
                        "v50.0",
                        0.96
                    ],
                    [
                        "v49.0",
                        0.82
                    ],
                    [
                        "v12.1",
                        0.14
                    ]
                ]
            }
        ]
    }
});
    Highcharts.chart('container3', {
    chart: {
        backgroundColor: 'transparent',
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'Cada ascensor cuantas veces ha sido arreglado en el último mes',
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
        data: [
            ['Ascensor 1', 58.9],
            ['Ascensor 2', 13.29],
            ['Ascensor 3', 13],
            ['Ascensor 4', 3.78],
            ['Ascensor 5', 3.42]
        ]
    }]
});


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
