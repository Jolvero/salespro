

$('#formulario-recordatorio').on('submit', function validarFormulario() {
    const asunto = document.getElementById('asunto').value;

    if (asunto == null || asunto == 0 || /^\+$/.test(asunto)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo asunto es requerido',
            icon: 'error',
        })
        return false;

    }

    const fecha = document.getElementById('fecha').value;

    if (fecha == null || fecha == 0 || /^\+$/.test(fecha)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo fecha es requerido',
            icon: 'error',
        })
        return false;
    }

    const prospecto_id = document.getElementById('prospecto_id').value;

    if (prospecto_id == null || prospecto_id == 0 || /^\+$/.test(prospecto_id)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo prospecto es requerido',
            icon: 'error',
        })
        return false;
    }

    const fecha_recordatorio = document.getElementById('fecha_recordatorio').value;

    if (fecha_recordatorio == null || fecha_recordatorio == 0 || /^\+$/.test(fecha_recordatorio)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo fecha de recordatorio es requerido',
            icon: 'error',
        })
        return false;
    }


    // validar tamaño de archivos
    Swal.fire({
        title: 'Recordatorio',
        text: 'Agregando Recordatorio',
        icon: 'info',
        didOpen: () => {
            Swal.showLoading()
        }
    })
})

function eliminarRecordatorio(id) {
    const elemento = document.getElementById(id);

    Swal.fire({
        title: 'Eliminar',
        text: '¿Deseas eliminar el recordatorio?',
        showCancelButton: true,
        confirmButtonColor: '#0379d9',
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si",
        icon: 'warning',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if(result.value) {
            Swal.fire({
                title: 'Eliminar',
                text: 'Eliminando recordatorio',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajax({
                url: '/recordatorio/'+ id + '/eliminar',
                method:'delete',
                data: ({
                    id: id,
                    _token: $('input[name= "_token"]').val()
                })
            }).done((res)=> {
                Swal.fire({
                    title: 'Eliminado',
                    text: 'Recordatorio Eliminado',
                    icon: 'success'
                });
            })

            elemento.parentElement.parentElement.parentElement.remove()
            $('.child').remove()

        }
    })
}
