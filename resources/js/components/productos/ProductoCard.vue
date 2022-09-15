<template>
    <v-card class="mx-auto my-12" max-width="374" >
        <v-img height="250" :src="'/'+url" class="card-img"></v-img>
        <hr>
        <center>
            <v-rating class="producto-rating" :value="4.5" color="amber" dense half-increments readonly size="14"></v-rating>
        </center>
        <v-card-title class="producto-titulo cpointer" @click="openUrl()">{{nombre}}</v-card-title>
    </v-card>
</template>

<script>

export default {
    name: "ProductoCard",
    props: {
        url: {
            type: String,
            required: true,
            default: ''
        },
        url_amigable: {
            type: String,
            required: true,
            default: ''
        },
        nombre: {
            type: String,
            required: true,
            default: ''
        },
    },
    data() {
        return {

        }
    },
    mounted() {
    },
    methods: {
        openUrl(){
            location.replace('/producto/'+this.url_amigable)
        },
    }
}
</script>

<style scoped>
    .producto-titulo{
        font-size: 12px;
        line-height: 1.6;
        height: 75px;
        overflow: clip;
    }
    .producto-rating::v-deep(button){
        color: #dede14;
    }
    .card-img::v-deep(.v-image__image){
        background-repeat: no-repeat;
        background-size: contain;
        
    }
</style>