<template>
    <div>
        <button type="submit" class="btn btn-dark d-block my-2 mb-2 w-100" value="" @click="eliminarUsuario"><img src="/images/eliminar.png" alt=""></button>
    </div>

</template>



<script>

export default {
    props: ['usuarioId'],
    methods: {
        eliminarUsuario() {
            this.$swal({
                title: '¿Deseas Eliminar el Usuario?',
                text: 'Una vez eliminado ya no se podrá recuperar',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
                cancelButtonText: "No",
            }).then((result) => {
                if (result.value) {
                    this.$swal({
                        title: 'Eliminar',
                        text: 'Eliminando Usuario',
                        icon: 'info',
                        allowOutsideClick: false,
                        AllowEscapeKey: false,
                        didOpen: () => {
                            this.$swal.showLoading()
                        }
                    });
                    const params = {
                        id:this.usuarioId
                    };

                    // enviar peticion al servidor
                    axios.post(`/usuario/${this.usuarioId}/eliminar`, {
                        params,
                        _method: "delete",
                    }).then((respuesta) => {
                        this.$swal({
                            title: "Usuario Eliminado",
                            text: "Se eliminó el usuario",
                            icon: "success",
                        });

                        // eliminar del DOM
                        this.$el.parentNode.parentNode.parentNode.removeChild(
                this.$el.parentNode.parentNode);
                    })
                    .catch((error)=> {
                        console.log(error)
                    })
                }
            })
        }
    }
}
</script>
