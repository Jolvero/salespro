

function eliminarUsuario(id) {
    const elemento = document.getElementById(id);

    Swal.fire({
        title: 'Eliminar',
        text: '¿Deseas eliminar el Usuario?',
        showCancelButton: true,
        confirmButtonColor: '#0379d9',
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si",
        icon: 'warning',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result)=> {
        if(result.value) {
            Swal.fire({
                title: 'Eliminar',
                text: 'Eliminando Usuario',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajax({
                url: '/usuario/'+ id+ '/eliminar',
                method:'DELETE',
                data:({
                    id: id,
                    _token: $('input[name= "_token"]').val()
                })
            }).done(function(res) {
                Swal.fire({
                    title: 'Eliminado',
                    text: 'Usuario Eliminado',
                    icon: 'success'
                });
            })

            elemento.parentElement.parentElement.parentElement.remove()
            $('.child').remove();


        }
    })
}
