
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

