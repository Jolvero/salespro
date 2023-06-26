
$('#formulario-clientes').on('submit', function() {
    const cliente = document.getElementById('cliente').value;

    if (cliente == null || cliente == 0 || /^\+$/.test(cliente)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo cliente es requerido',
            icon: 'error',
        });
        return false;

    }



    const empresa = document.getElementById('empresa').value;

    if (empresa == null || empresa == 0 || /^\+$/.test(empresa)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo empresa es requerido',
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
})

function eliminarCliente(id) {
    const elemento = document.getElementById(id)
    Swal.fire({
        title: 'Eliminar',
        text: '¿Deseas eliminar el cliente?',
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
                text: 'Eliminando cliente',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajax({
                url: '/cliente/'+id+'/eliminar',
                method: 'DELETE',
                data:{
                    id: id,
                    _token: $('input[name="_token"]').val()
                }
            }).done(function(res) {
                Swal.fire({
                    title: 'Eliminado',
                    text: 'Cliente Eliminado',
                    icon: 'success'
                });
            })
            elemento.parentElement.parentElement.parentElement.remove();
            $('.child').remove();
        }
    })
}
