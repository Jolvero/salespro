$('#form-login').on('submit', function(e) {
    $('#access').prop('disabled', true);
    $('.content-login').append('<div style="display:block align-items-center" class="spinner"</div> <div class="modal fade"></div');
    Swal.fire({
        title: 'Espere',
        text: 'Estamos preparando todo',
        imageUrl: '/images/mano.png',
        imageHeight: 100,
        timer: 70000,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
          Swal.showLoading()
        },

      })
})

// Login

  // Logout
  $('#logout').on('click', function logout() {
    Swal.fire({
        title: 'Espere',
        imageUrl: '/images/logout.png',
        text: 'Saliendo',
        imageHeight: 100,
        timer: 70000,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
          Swal.showLoading()
        },

      })
  })

