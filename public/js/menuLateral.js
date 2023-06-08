const btn = document.querySelector('#menu-btn');
const menu = document.querySelector('#sidemenu');

if(btn) {
    btn.addEventListener('click', e => {

        if (menu.classList.contains('menu-collapsed')) {
            $('.consultar-cartera').show();
            $('.seguimientos').show();
            $('.consultar-recordatorios').show();
            $('.consultar-clientes').show();
            $('.consultar-usuarios').show();
            $('.item-text').css('display', 'block');
           $('.item-separator').css('display', 'block');
           $('#items-nav').css('margin-right', '30rem');
           $('.logo-panel').css('margin-left', '100px')


        } else {
            menu.classList.remove('menu-collapsed')
            menu.classList.add('menu-expanded')
            $('.consultar-cartera').hide();
            $('.seguimientos').hide();
            $('.consultar-recordatorios').hide();
            $('.consultar-clientes').hide();
            $('.consultar-usuarios').hide();
            $('.li-items').css('margin-right', '0')
            $('#items-nav').css('margin-right', '0');
            $('.logo-panel').css('margin-left', '0')
        }

        menu.classList.toggle("menu-expanded");
        menu.classList.toggle("menu-collapsed");
        document.querySelector('body').classList.toggle('body-expanded');
    })
}


$('#sidemenu').on('mouseleave', function() {
    var mediaqueryList = window.matchMedia("(min-width: 1000px)");
    if(mediaqueryList.matches) {
       if(menu.classList.contains('menu-collapsed')) {
        $('.consultar-cartera').hide();
        $('.seguimientos').hide();
        $('.consultar-recordatorios').hide();
        $('.consultar-clientes').hide();
        $('.consultar-usuarios').hide();
        $('.logo-panel').css('margin-left', '0');
        $('.logo-panel').css('width', '50px');
       }
    }
});

$('#sidemenu').on('mouseover', function() {
    var mediaqueryList = window.matchMedia("(min-width: 1000px)");
    if(mediaqueryList.matches) {
        $('.consultar-cartera').show();
        $('.seguimientos').show();
        $('.consultar-recordatorios').show();
        $('.consultar-clientes').show();
        $('.consultar-usuarios').show();
        $('.logo-panel').css('margin-left', '100px');
        $('.logo-panel').css('width', '100px');

    }});
