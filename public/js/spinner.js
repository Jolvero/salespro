

$(window).on('beforeunload unload', function() {

})

document.addEventListener('DOMContentLoaded', quitarSpinners)

$('.link').on('click', function(e) {

    $('.spinner-section').css('height', '100%')
    spinners()
});
$('#form-crear').on('submit', function(e) {
   spinners();
})

function spinners() {
    const crear = document.createElement('DIV')
    crear.innerHTML = `
    <div class="spinner"></div>`
  $('.spinner').css('heigth', '100%');
  $('.spinner').css('background', '#000000');
  $('.spinner-section').append(crear);
  $('.spinner-section').css('display', 'flex');


}

function quitarSpinners() {
    $('.spinner-section').css('display', 'none')
    }

