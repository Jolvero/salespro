const alert = document.querySelector('.alert');

if(alert) {
    setTimeout(()=> {
        alert.remove()
    }, 5000)
}


    // Validar formulario
$('#formulario-usuario').on('submit', function(e) {
    console.log(e)

    const nombre = document.getElementById("name").value;
    if( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) )
    {
       Swal.fire({
        title: 'Error',
        text: 'El campo nombre es Requerido',
        icon: 'error'
       })
        return false;
     }

        const username = document.getElementById("username").value;
        if( username == null || username.length == 0 || /^\s+$/.test(username) )
        {
           Swal.fire({
            title: 'Error',
            text: 'El campo username es Requerido',
            icon: 'error'
           })

            return false;
        }

        const emailField = document.getElementById('email');

        // Define our regular expression.
        var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

        // validar email
        if( validEmail.test(emailField.value) ){

        } else{
            Swal.fire({
                title: 'Error',
                text: 'El campo email es Requerido, valida que sea una dirección de correo valida',
                icon: 'error'
               })
            return false;
        }


        // validar rol_id
        const rol_id = document.getElementById("rol_id").value;if( rol_id == null || rol_id.length == 0 || /^\s+$/.test(rol_id) )
        {
           Swal.fire({
            title: 'Error',
            text: 'El campo Rol es Requerido',
            icon: 'error'
           })

            return false;
        }

        // validar password
        const password = document.getElementById("password").value;if( password == null || password.length == 0 || /^\s+$/.test(password) )
        {
           Swal.fire({
            title: 'Error',
            text: 'El campo Password es Requerido',
            icon: 'error'
           })

            return false;
        }

        const password_confirmation = document.getElementById("password_confirmation").value;if( password_confirmation == null || password_confirmation.length == 0 || /^\s+$/.test(password_confirmation) )
        {
           Swal.fire({
            title: 'Error',
            text: 'El campo confirmar contraseña es Requerido',
            icon: 'error'
           })

            return false;
        }

        if(password != password_confirmation) {
            Swal.fire({
                title: 'Error',
                text: 'Las contraseñas no coinciden',
                icon: 'error'
               })

                return false;
        }

            // Formulario validado
    $('#btn-enviar').text('Enviando...')
    $('#btn-enviar').prop('disabled', true);
    $('#btn-enviar').append('<span class="spinner-border spinner-border-sm mx-2"role="status" aria-hidden="true"></span> <span class="sr-only">Loading...</span>')

    Swal.fire({
        title: 'Registro',
        text: 'Registrando Usuario',
        icon: 'info',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen:()=>{
            Swal.showLoading()
        }
    })

});

function mostrarPassword(){
    var cambio = document.getElementById("password");
    if(cambio.type == "password"){
        cambio.type = "text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
        cambio.type = "password";
        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}

//CheckBox mostrar contraseña
$('#ShowPassword').on('click',function () {
    $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
});



