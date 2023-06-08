
$('#formulario-correo').on('submit', function validarFormulario() {
    const correo = document.getElementById('destinatario');

    // Define our regular expression.
    var validEmail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

    // validar email
    if (validEmail.test(correo.value)) {

    } else {
        Swal.fire({
            title: 'Error',
            text: 'El campo email es Requerido, valida que sea una dirección de correo valida',
            icon: 'error'
        })
        return false;
    }

    const asunto = document.getElementById('asunto').value;

    if (asunto == null || asunto == 0 || /^\+$/.test(asunto)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo asunto es requerido',
            icon: 'error',
        })
        return false;
    }

    const mensaje = document.getElementById('mensaje').value;

    if (mensaje == null || mensaje == 0 || /^\+$/.test(mensaje)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo mensaje es requerido',
            icon: 'error',
        })
        return false;
    }


    // validar tamaño de archivos
    const archivos = document.getElementById('adjunto');
    const totalArchivos = archivos.files.length;
    if (totalArchivos > 0) {
        for (let i = 0; i < totalArchivos; i++) {
            var tamaño = archivos.files[i].size
            if (tamaño > 10000000) {
                Swal.fire({
                    title: 'Archivos',
                    text: 'El tamaño máximo de archivo es de 10 M, revisa el tamaño de los archivos cargados',
                    icon: 'error'
                })
                return false;
            }
        }

    }

    Swal.fire({
        title: 'Prospecto',
        text: 'Agregando prospecto',
        icon: 'info',
        didOpen: () => {
            Swal.showLoading()
        }
    })
})

// mailing
const categoria = document.querySelector('#tipo')
const plantilla = document.querySelector('#plantilla')
const textArea = document.querySelector('#plantilla-seleccionada');

if(categoria) {
    categoria.addEventListener('change', llenarTabla)

}
if(plantilla) {
    plantilla.addEventListener('change', pasarPlantilla);

}


function llenarTabla() {
    $('#button').remove()
    if (categoria.value == 'clientes' || categoria.value == 'prospectos') {
        $.get('/tipo/' + categoria.value + '/clientes-prospectos', function (data) {
            $('#tabla-contenido').children().remove()
            if (data.length) {
                var tabla = '<table class="table" id="table-mailing"><thead><tr class="text-center"><th>Nombre</th><th>Empresa</th><th>Correo</th></tr></thead><tbody></tbody></table>'
                var button = '<button id="button" class="my-4 btn btn-dark text-white float-right" onClick="pasarCorreos();">Enviar Correos</button>'

                $('#tabla-contenido').append(tabla);
                $('#form-mailing').append(button)
                $('.dataTables_empty').remove()
                for (let i = 0; i < data.length; i++) {
                    $('#table-mailing').append(`<tr class= "text-center"><td>${data[i].nombre}</td>` + `<td>${data[i].empresa}</td>` + `<td>${data[i].correo}</td>` + '</tr>')
                }

                $('#table-mailing').DataTable({
                    responsive: true,
                    colReorder: true,
                    RowReorder: true,
                    select: true,
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 de 0 de 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },

                    }, columnDefs: [
                        {
                            className: 'dt-center', targets: '_all'
                        }
                    ]
                }
                )
            }

            $('#table-mailing tbody').on('click', 'tr', function () {
                $(this).toggleClass('selected');

            });

        })
    } else {
        $('#tabla-contenido').children().remove()
        return;
    }

}

function pasarCorreos() {
    var textArea = '<textarea name="correos" id="correos" cols="30" rows="10" class="d-none"></textarea>';
    $('#form-mailing').append(textArea);
    var table = $('#table-mailing').DataTable();
    if (table.rows('.selected').data().length > 0) {
        for (let i = 0; i < table.rows('.selected').data().length; i++) {
            $('#correos').append(table.rows('.selected').data()[i][2] + '\r');

        }
    } else {
        for (let i = 0; i < table.rows().data().length; i++) {
            $('#correos').append(table.rows().data()[i][2] + '\r');
        }
    }
    return;

}

function pasarPlantilla(e) {
    const plantillaSeleccionada = plantilla.options[plantilla.selectedIndex].text;
    if (plantillaSeleccionada == e.target[0].textContent) {
        textArea.value = '';
        return;
    }
    textArea.value = $('#plantilla option:selected').attr('data-text')
}

