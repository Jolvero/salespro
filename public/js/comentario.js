
$('.comentario').on('blur', function(e) {


    const id =$(this).attr('id')
    const comentario =($(this).val())

    $.ajax({
        url: `/comentario/${id}/${comentario}`,
        method: 'PUT',
        data:{
            comentario: $(this).text(),
            _token: $('input[name ="_token"]').val()
        }
    }).done(function() {
        Swal.fire({
            title: 'Comentarios',
            text: 'Comentario actualizado',
            icon: 'success',
            allowOutsideClick: false,
            allowEscapeKey: false
        })
        e.target.parentElement.parentElement.children[1].textContent = comentario;


    })

})

function eliminarComentario(id) {
    const elemento = document.getElementById(id)
    Swal.fire({
        title: 'Eliminar',
        text: '¿Deseas eliminar el comentario?',
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
                text: 'Eliminando comentario',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajax({
                url: '/comentario/'+id+'/eliminar',
                method: 'DELETE',
                data:{
                    id: id,
                    _token: $('input[name="_token"]').val()
                }
            }).done(function(res) {
                Swal.fire({
                    title: 'Eliminado',
                    text: 'Comentario Eliminado',
                    icon: 'success'
                });
            })
            elemento.parentElement.parentElement.parentElement.remove();
            $('.child').remove();
        }
    })
}
