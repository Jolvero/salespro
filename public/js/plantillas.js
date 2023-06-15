
$('#formulario').on('submit', function(){

    const nombre = document.getElementById('nombre').value;

    if (nombre == null || nombre == 0 || /^\+$/.test(nombre)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo nombre es requerido',
            icon: 'error',
        });
        return false;

    }
    const plantilla = document.getElementById('plantilla').value;

    if (plantilla == null || plantilla == 0 || /^\+$/.test(plantilla)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo plantilla es requerido',
            icon: 'error',
        });
        return false;

    }

    if(plantilla.length <10) {
        Swal.fire({
            title: 'validación',
            text: 'El campo plantilla debe contener mínimo 10 caractéres',
            icon: 'error',
        });
        return false;

    }

    if(plantilla.length >10000) {
        Swal.fire({
            title: 'validación',
            text: 'El campo plantilla debe contener menos de 10000 caractéres',
            icon: 'error',
        });
        return false;

    }

    Swal.fire({
        title: 'Agregar plantilla',
        text: 'Agregando plantilla',
        icon: 'info',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen:()=> {
            Swal.showLoading();
        }
    })

})

function eliminarPlantilla(id) {
    const elemento = document.getElementById(id)
    Swal.fire({
        title: 'Eliminar',
        text: '¿Deseas eliminar la plantilla?',
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
                text: 'Eliminando plantilla',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajax({
                url: '/plantilla/'+id+'/eliminar',
                method: 'DELETE',
                data:{
                    id: id,
                    _token: $('input[name="_token"]').val()
                }
            }).done(function(res) {
                Swal.fire({
                    title: 'Eliminado',
                    text: 'Plantilla Eliminada',
                    icon: 'success'
                });
            })
            elemento.parentElement.parentElement.parentElement.remove();
            $('.child').remove();
        }
    })
}

function actualizarPlantilla(plantilla, id) {
    $.ajax({
        url: `/plantilla/${id}/${plantilla}/update`,
        method: 'PUT',
        data: {
            plantilla: plantilla,
            _token: $('input[name="_token"]').val()

        }
    }).done(function res() {
        Swal.fire({
            title: 'Plantilla',
            text: 'Plantilla actualizada',
            icon: 'success'
        })
    })
}


