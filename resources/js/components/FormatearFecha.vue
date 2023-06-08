<template>
    <span class="font-weight-bold text-white" v-text="formatearFecha"></span>
</template>

<script>
import moment from 'moment'
export default {
    props: ['fecha'],
    computed: {
        formatearFecha() {
            return moment(this.fecha).locale('es').format('DD [de] MMMM [a las] HH:mm')
        }
    }
}
</script>
