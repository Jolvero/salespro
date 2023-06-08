

function notificacion() {
    const fecha = new Date();
    let mes = fecha.getMonth() + 1;
    mes = mes.toString()
    let year = fecha.getFullYear();
    let dia = fecha.getDate().toString()
    let hora = fecha.getHours().toString()
    let minuto = fecha.getMinutes().toString()

    if (mes.length <= 1) {
        mes = '0' + mes
    }
    if (dia.length <= 1) {
        dia = '0' + dia;
    }

    if (hora.length <= 1) {
        hora = '0' + hora
    }

    if (minuto.length <= 1) {
        minuto = '0' + minuto
    }

    const fechaCompleta = year + '-' + mes + '-' + dia + ' ' + hora + ':' + minuto;

    $.get(`/recordatorio/${fechaCompleta}/aviso`, function (data) {

        if(data.length > 0 && data[0].read != 'check') {
            $('.modal-body').append(`<h2 class="font-weight-bold">Recordatorio</h2>
            <p class="font-weight-bold mt-3">Asunto: <span class="font-weight-normal">${data[0].asunto}</span></p>
            <p class="font-weight-bold">Prospecto: <span class="font-weight-normal">${data[0].prospecto.nombre}</span></p>
            <p class="font-weight-bold">Hora: <span class="font-weight-normal">${data[0].fecha}</span></p>`)
            $('#notificacion').modal('show');
        }

    })


}

document.addEventListener('DOMContentLoaded', () => {
    const url = $(location).attr('href')
    if(url != 'http://salespro.mrollogistics.com/login') {
        notificacion()

    }
})

setInterval(() => {
    notificacion()
}, 60000)



