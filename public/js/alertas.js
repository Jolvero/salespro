const alerta= document.querySelector('.alert');

if(alerta) {
    setTimeout(() => {
        alerta.remove()
    }, 3000);
}
