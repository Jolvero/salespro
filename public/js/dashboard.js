
// clientes
$.get('/cliente/dashboard', function (data) {
    var options = {
        series: [{
            name: 'Clientes',
            data: data
        }],

        chart: {
            height: 350,
            type: 'area',

            animations: {
                enabled: true,
                easing: 'easeout',
                speed: 700,
                animateGradually: {
                    enabled: true,
                    delay: 150
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 150
                }
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            type: 'date',
            categories: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
        },
        tooltip: {
            x: {
                format: 'MM'
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#containerClientes"), options);
    chart.render();
})

$.get('/prospectadores', function(data) {
    let prospectadores = [];

    for(let i = 0; i < data.length; ++i) {
        prospectadores = [... prospectadores, data[i]]
    }

    // importaciones por cliente
    $.get('/prospectos/usuarios', function(data) {
        var options = {
            plotOptions: {
                pie: {
                  customScale: 0.8
                }
              },
            toolbar: {
                show: true,
                offsetX: 0,
                offsetY: 0,
                tools: {
                    selection: true,
                    zoom: true,
                    zoomin: true,
                    zoomout: true,
                    pan: true,
                }
            },
            colors:['#3A83C8', '#415fff', '#9C27B0', '#3acfe7', '#e15018', '#37d962', '#b5ff7c', '#ff3305'],
            series: data,
            chart: {
            width: 450,
            type: 'pie',
          },
          labels: prospectadores,
          responsive: [{
            breakpoint: 480,
            options: {
              chart: {
                width: '100%',
                height: 550
              },
              legend: {
                position: 'bottom',

              }
            }
          }]
          };

          var chart = new ApexCharts(document.querySelector("#mesProspectadores"), options);
          chart.render();

    })
})




$.get('/prospectos/nombres', function (data) {
    let clientes = [];

    for (let i = 0; i < data.length; ++i) {
        clientes = [...clientes, data[i]]
    }

    $.get('/prospectos/mes', function (data) {
        var options = {
            colors:['#33e5f7'],

            series: [{
                name: 'Prospectos',
                data: data
            }],

            chart: {
                height: 350,
                type: 'area',

                animations: {
                    enabled: true,
                    easing: 'easeout',
                    speed: 700,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 150
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'date',
                categories: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
            },
            tooltip: {
                x: {
                    format: 'MM'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#mesProspectos"), options);
        chart.render();

    })
})

