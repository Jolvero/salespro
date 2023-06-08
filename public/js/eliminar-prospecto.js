

function eliminarProspecto(id) {
    const elemento = document.getElementById(id)
    Swal.fire({
        title: 'Eliminar',
        text: '¿Deseas eliminar el Prospecto?',
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
                text: 'Eliminando Prospecto',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajax({
                url: '/prospecto/'+id+'/eliminar',
                method: 'DELETE',
                data:{
                    id: id,
                    _token: $('input[name="_token"]').val()
                }
            }).done(function(res) {
                Swal.fire({
                    title: 'Eliminado',
                    text: 'Prospecto Eliminado',
                    icon: 'success'
                });
            })
            elemento.parentElement.parentElement.parentElement.remove();
            $('.child').remove();
        }
    })
}
