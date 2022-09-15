<template>
    <footer class="page-footer black pt6 pb2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <span @click="openUrl('android')" class="icon-gycso-iconplaystore text-white footer-apps cpointer"></span>
                    <span @click="openUrl('apple')" class="icon-gycso-ios-icon text-white footer-apps cpointer"></span>
                    <span @click="openUrl('instagram')" class="icon-gycso-instagram1 footer-redes cpointer"></span>
                    <span @click="openUrl('facebook')" class="icon-gycso-facebook1 footer-redes cpointer"></span>
                    <span class="footer-redesS hide-on-small-and-down">Siguenos en</span>
                </div>
            </div>
            <hr class="white">
            <div class="row mt6">
                <div class="col hide-on-small-and-down">
                    <center>
                        <v-img src="/images/logo-negro.png" width="120px"></v-img>
                    </center>
                </div>
                <div class="col">
                    <p class="title">Categorías</p>
                    <ul>
                        <li><a href="">Identificación</a></li>
                        <li><a href="">Control de acceso</a></li>
                        <li><a href="">CCTV</a></li>
                    </ul>
                </div>
                <div class="col">
                    <p class="title">Ayuda</p>
                    <ul>
                        <li><a href="">¿Cómo funciona?</a></li>
                        <li><a href="">Preguntas Frecuentes</a></li>
                        <li><a href="">Términos y condiciones</a></li>
                        <li><a href="">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
export default {
    name: "footerApp",
    data() {return {}},
    created() {},
    methods: {
        openUrl(app) {
            let url_app = '';
            switch (app) {
                case 'apple':
                    url_app = 'https://apps.apple.com/mx/app/gycso/id1543133809';
                break;
                case 'android':
                    url_app = 'https://play.google.com/store/apps/details?id=gycso.com';
                break;
                case 'facebook':
                    url_app='https://www.facebook.com/GYCSO.IT/';
                break;
                case 'instagram':
                    url_app='https://www.instagram.com/gycso_it_solutions/?hl=en';
                break;
            }
            window.open(url_app, '_blank');
        }
    }
}
</script>

<style scoped>
.page-footer li a{
    color: white;
    text-decoration:none;
}
.title{
    font-weight: bolder;
    font-size: 1rem;
}
.footer-apps{
    font-size: 2rem;
}
.footer-redes{
    font-size: 1.5rem;
    float: right;
    margin-right: 1rem;
}
.footer-redesS{
    font-size: 1rem;
    float: right;
    margin-right: 1rem;
}
</style>