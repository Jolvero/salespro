const date = new Date();

$('#formulario').on('submit', function validarFormulario(e) {

    const nombre = document.getElementById('nombre').value;

    if (nombre == null || nombre == 0 || /^\+$/.test(nombre)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo nombre es requerido',
            icon: 'error',
        });
        return false;

    }

    // const estado_id = document.getElementById('estado_id').value;

    // if (estado_id == null || estado_id == 0 || /^\+$/.test(estado_id)) {
    //     Swal.fire({
    //         title: 'validación',
    //         text: 'El estatus es requerido',
    //         icon: 'error',
    //     })
    //     return false;
    // }

    const empresa = document.getElementById('empresa').value;

    if (empresa == null || empresa == 0 || /^\+$/.test(empresa)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo empresa es requerido',
            icon: 'error',
        })
        return false;
    }

    const servicio_id = document.getElementById('servicio_id').value;

    if (servicio_id == null || servicio_id == 0 || /^\+$/.test(servicio_id)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo servicio es requerido',
            icon: 'error',
        })
        return false;
    }



    const correo = document.getElementById('correo');

    // Define our regular expression.
    let regex = new RegExp("([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\"\(\[\]!#-[^-~ \t]|(\\[\t -~]))+\")@([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\[[\t -Z^-~]*])");
    // validar email
    if (regex.test(correo.value)) {
        if(correo.value.includes('.com,mx')) {
            return;
        }
    } else {
        Swal.fire({
            title: 'Error',
            text: 'El campo email es Requerido, valida que sea una dirección de correo valida',
            icon: 'error'
        })
        return false;
    }

    // validar tamaño de archivos
    const archivos = document.getElementById('cotizacion_id');
    const totalArchivos = archivos.files.length;
    if (totalArchivos > 0) {
        for (let i = 0; i < totalArchivos; i++) {
            var tamaño = archivos.files[i].size
            if (tamaño > 20000000) {
                Swal.fire({
                    title: 'Archivos',
                    text: 'El tamaño máximo de archivo es de 20 M, revisa el tamaño de los archivos cargados',
                    icon: 'error'
                })
                return false;
            }
        }

    }

    const estado_id = document.querySelector('#estado_id');

    if(estado_id) {
        if (estado_id.value == 2) {
            Swal.fire({
                title: 'Cliente',
                text: 'Felicidades!!!!',
                imageUrl: '/images/felicidad.png',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,

            })
            return;
        }

    }

    Swal.fire({
        title: 'Prospecto',
        text: 'Actualizando prospecto',
        icon: 'info',
        didOpen: () => {
            Swal.showLoading()
        }
    })


});

const idProspecto = document.querySelector('#id')

if(idProspecto)
{
    $('#btn-autorizar').on('click', function() {
        $.ajax({
            url: '/tarifa/'+idProspecto.value,
            method: 'PUT',
            data: {
                estatus_id: 2,
                _token: $('input[name="_token"]').val()
            }
        }).done(function(res) {
            Swal.fire({
                title: 'Autorización',
                text: 'Tarifa autorizada',
                icon: 'success'
            })
        })
    });

}

$('#plantilla_id').on('change', function() {
    const plantilla = $('#plantilla_id option:selected').attr('data-texto')
    $('#mensaje').val(plantilla)
})
