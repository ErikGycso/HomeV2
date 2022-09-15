<template>
  <div id="welcome-page">
    <div class="contenedor1">
      <v-container fluid class="pt7">
        <v-row>
          <v-col cols="12">
            <h5 class="titlen1 center-align fontcw">Tu nueva forma de<br>identificación y acceso</h5>
          </v-col>
          <v-col cols="3" class="vhc-center hide-on-med-and-down">
            <img id="welcome-appc1" class="materialboxed appc" src="/images/app001.png" />
          </v-col>
          <v-col cols="12" md="6" class="vhc-center">
            <v-container fluid class="hide-on-small-only">
              <v-row>
                <v-col v-for="(item, index) in welcomeSlider" sm="3" class="text-center" :key="index">
                  <span :class="'icon-welcome ' + item.icon"></span>
                  <p class="center-align text-welcome1">{{ item.text }}</p>
                </v-col>
              </v-row>
            </v-container>
            <div class="hide-on-med-and-up">
              <v-carousel class="carousel-app" cycle hide-delimiters height="auto">
                  <v-carousel-item v-for="item in [0, 2]" :key="item">
                    <v-container>
                      <v-row>
                        <v-col cols="1"></v-col>
                        <v-col class="text-center">
                          <span :class="'icon-welcome ' + welcomeSlider[item].icon"></span>
                          <p class="center-align text-welcome1">{{ welcomeSlider[item].text }}</p>
                        </v-col>
                        <v-col class="text-center">
                          <span :class="'icon-welcome ' + welcomeSlider[item + 1].icon"></span>
                          <p class="center-align text-welcome1">{{ welcomeSlider[item + 1].text }}</p>
                        </v-col>
                        <v-col cols="1"></v-col>
                      </v-row>
                    </v-container>
                  </v-carousel-item>
              </v-carousel>
            </div>
          </v-col>
          <v-col cols="2" md="3" class="vhc-center hide-on-med-and-down">
            <img class="apps cpointer" src="/images/appstore2.png" @click="openApp('apple')" />
            <img class="apps mt7 cpointer" src="/images/playstore2.png" @click="openApp('android')" />
          </v-col>
          <v-col cols="12" class="hide-on-med-and-up mb3" style="text-align: right;">
            <img class="apps2 cpointer" src="/images/appstore.png" @click="openApp('apple')" />
            <img class="apps2 cpointer" src="/images/playstore.png" @click="openApp('android')" />
          </v-col>
        </v-row>
      </v-container>
    </div>
    <div class="card border0 br0">
      <div class="card-content">
        <v-container fluid>
          <v-row class="carousel-app">
            <v-col cols="8" md="5">
              <p class="subtitulo1 center-align">¿Cómo funciona?</p>
              <p class="titlen1 center-align">Formas de usar GYCSO APP</p>
            </v-col>
            <v-col cols="4" md="7" style="text-align: right">
              <v-btn id="ver_mas" color="blue darken-4" depressed elevation="2" class="white-text">Ver más</v-btn>
            </v-col>
          </v-row>
        </v-container>
        <v-carousel class="carousel-app" cycle hide-delimiters height="auto">
          <template v-for="(item, index) in slider">
            <v-carousel-item v-if="(index + 1) % columns === 1 || columns === 1" :key="index">
              <v-container fluid>
                <v-row>
                  <template v-for="(n, i) in columns">
                    <template v-if="(+index + i) < slider.length">
                      <v-col :key="i" class="vhc-center">
                        <p class="subtitulo1 center-align">
                          {{ slider[index + i].titulo }}
                        </p>
                        <p class="descripcion center-align">
                          {{ slider[index + i].descripcion }}
                        </p>
                        <img class="materialboxed appc mt2" :src="slider[index + i].url" />
                      </v-col>
                    </template>
                  </template>
                </v-row>
              </v-container>
            </v-carousel-item>
          </template>
        </v-carousel>
      </div>
    </div>
    <div class="card pt5 border0 br0">
      <v-container class="soluciones-container">
        <v-row>
          <v-col cols="12">
            <span class="badge light-blue lighten-3 soluciones-title0">Nuestras Soluciones</span>
          </v-col>
          <v-col cols="8" md="3">
            <p class="soluciones-title">Escala tus procesos al siguiente nivel</p>
          </v-col>
          <v-col cols="4" md="9" style="text-align: right">
            <v-btn id="ver_mas0" color="blue darken-4" depressed elevation="2" class="white-text">Ver más</v-btn>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="6" sm="6" md="3">
            <div class="card vhc-center soluciones-item">
              <div class="card-content">
                <span class="soluciones-iconos icon-gycso-card-info"></span>
                <p class="soluciones-text">Sistemas completos de credencialización</p>
              </div>
            </div>
          </v-col>
          <v-col cols="6" sm="6" md="3">
            <div class="card vhc-center soluciones-item">
              <div class="card-content">
                <span class="soluciones-iconos icon-gycso-torniquete"></span>
                <p class="soluciones-text">Acceso peatonal</p>
              </div>
            </div>
          </v-col>
          <v-col cols="6" sm="6" md="3">
            <div class="card vhc-center soluciones-item">
              <div class="card-content">
                <span class="soluciones-iconos icon-gycso-pluma"></span>
                <p class="soluciones-text">Estacionamientos</p>
              </div>
            </div>
          </v-col>
          <v-col cols="6" sm="6" md="3">
            <div class="card vhc-center soluciones-item">
              <div class="card-content">
                <span class="soluciones-iconos icon-gycso-video-camara"></span>
                <p class="soluciones-text">Vigila cada rincón y cada espacio</p>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </div>
    <v-container class="pp0">
      <div class="card card-catalogos ">
        <p class="title">Catálogo de productos {{ new Date().getFullYear() }}</p>
        <p class="subtitle">Encuentra lo mejor al mejor precio</p>
      </div>
    </v-container>
    <div class="card border0 br0">
      <div class="mt-3 center">
        <span class="badge light-blue lighten-3 soluciones-title1">Tecnología</span><br>
        <p class="soluciones-title">Productos Destacados</p>
      </div>
      <v-container class="container-productos">
        <template>
          <v-sheet class="mx-auto" max-width="100%">
            <v-slide-group multiple show-arrows>
              <v-slide-item v-for="n in 25" :key="n">
                <v-card class="mx-auto card-producto" max-width="200px">
                  <v-img class="white--text align-end" height="200px"
                    src="https://cdn.vuetifyjs.com/images/cards/docks.jpg">
                  </v-img>
                  <v-card-text class="text--primary">
                    <div>Whitehaven Beach</div>
                  </v-card-text>
                </v-card>
              </v-slide-item>
            </v-slide-group>
          </v-sheet>
        </template>
      </v-container>
    </div>
    <div class="card border0 br0 pb10 pt10">
      <v-container fluid>
        <v-row>
          <v-col cols class="hide-on-med-and-down"></v-col>
          <v-col cols class="vhc-center">
            <v-img class="white-text align-end img-uneteN" src="/images/torniquete.png">
              <p class="unete-nosotros-text">¿Te interesa GYSCO<br>en tu escuela?</p>
              <button type="button" class="unete-nosotros-btn btn light-blue darken-1 text-white">Únete a GYCSO</button>
            </v-img>
          </v-col>
          <v-col cols class="vhc-center">
            <v-img class="white-text align-end img-uneteN" src="/images/estacionamiento1.jpg">
              <p class="unete-nosotros-text">¿Te interesa GYSCO en<br>tu estacionamiento?</p>
              <button type="button" class="unete-nosotros-btn btn light-blue darken-1 text-white">Únete a GYCSO</button>
            </v-img>
          </v-col>
          <v-col cols class="hide-on-med-and-down"></v-col>
        </v-row>
      </v-container>
    </div>
  </div>
</template>

<script>

export default {
  components: {},
  data() {
    return {
      slider: [
        { titulo: 'Inicia Sesión', descripcion: 'No te registres', url: '/images/app001.png' },
        { titulo: 'Obtén tu credencial', descripcion: 'Tramita tu credencial Física y digital', url: '/images/app002.png' },
        { titulo: 'Abre cualquier acceso', descripcion: 'Abre tus acceso como torniquetes, plumas vehiculares y puertas automatizadas', url: '/images/app003.png' }
      ],
      welcomeSlider: [
        { icon: 'icon-gycso-person', text: 'Tramita tu credencial desde casa' }, { icon: 'icon-gycso-engranaje', text: 'Recopila la información de tus estudiantes y trabajadores; fácil y rápido.' },
        { icon: 'icon-gycso-portafolio', text: 'Toma tu fotografía y firma solo con tu celular' }, { icon: 'icon-gycso-candado', text: 'Abre tus accesos solo con tu celular' },
      ],
      productos: [
        { img: '', titulo: '', url: '' },
        { img: '', titulo: '', url: '' },
        { img: '', titulo: '', url: '' },
        { img: '', titulo: '', url: '' },
        { img: '', titulo: '', url: '' },
      ]
    }
  },
  mounted() {
  },
  methods: {
    openApp(app) {
      let url_app = '';
      switch (app) {
        case 'apple':
          url_app = 'https://apps.apple.com/mx/app/gycso/id1543133809';
          break;
        default:
          url_app = 'https://play.google.com/store/apps/details?id=gycso.com';
          break;
      }
      window.open(url_app, '_blank');
    }
  },
  computed: {
    columns() {
      if (this.$vuetify.breakpoint.xl) {
        return 3;
      }

      if (this.$vuetify.breakpoint.lg) {
        return 3;
      }

      if (this.$vuetify.breakpoint.md) {
        return 3;
      }

      return 1;
    }
  }
}
</script>
<style scoped>
#welcome-page .contenedor1 .appc {
  max-height: 250px;
}

#welcome-page .contenedor1 .apps {
  max-width: 100%;
}

.apps2 {
  max-height: 35px;
  margin-right: 5px;
}

.appc {
  background-color: white;
  border-radius: 20px;
}

#welcome-page .contenedor1 .valign-wrapper {
  width: 100%;
}

.contenedor1 {
  background: rgb(0 0 0 / 34%) url('/images/background1.webp');
  background-repeat: no-repeat;
  background-position: center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  background-blend-mode: darken;
}

#welcome-appc1 {
  margin-top: 10px;
  margin-bottom: 10px;
}

.carousel-app .appc {
  max-height: 200px;
}

.subtitulo1 {
  font-weight: bolder;
  color: gray;
  font-size: 1.1rem;
}

#ver_mas {
  float: right;
}

.soluciones-iconos {
  font-size: 7rem;
}

.soluciones-iconos.icon-gycso-torniquete {
  font-size: 6rem;
}

.soluciones-iconos.icon-gycso-video-camara {
  font-size: 5rem;
}

.soluciones-text {
  color: gray;
  text-align: center;
  font-weight: bolder;
  font-size: 1.25rem;
  margin-top: 1.25rem !important;
}

.soluciones-title {
  color: gray;
  font-weight: bolder;
  font-size: 1.25rem;
}

.soluciones-title0 {
  margin-left: 0;
  float: left;
  border-radius: 5px !important;
  font-size: 1.1rem !important;
  padding: 8px;
  height: auto;
  font-weight: bolder !important;
  color: #083362 !important;
}

.soluciones-title1 {
  border-radius: 5px !important;
  font-size: 1.1rem !important;
  padding: 8px;
  height: auto;
  font-weight: bolder !important;
  color: #083362 !important;
  float: inherit;
}

.soluciones-container .card-content {
  text-align: center;
}

.soluciones-container .card {
  height: 90%;
}

.titlen1 {
  font-size: 1.5rem;
  font-weight: bolder;
  color: black;
}

.text-welcome1 {
  line-height: 1;
  color: white;
}

.fontcw {
  text-shadow: 0px 0 #fff, 0px 0 #fff, 0 1px #fff, 0 0px #fff, 1px 1px #fff, -1px -1px #fff, 1px -1px #fff, 0px 0px #fff;
}

.icon-welcome {
  color: #274376;
  font-size: 2.5rem;
  background: white;
  border-radius: 100%;
}

.carousel-app .v-window__next {
  display: none;
}

.soluciones-container .soluciones-item {
  color: #2464a4;
}

.soluciones-container .soluciones-item:hover {
  background-color: #2c74b4;
  color: white;
}

.soluciones-container .soluciones-item:hover .soluciones-text {
  color: white;
}

.card-catalogos {
  padding: 30px;
  border-radius: 30px;
}

.card-catalogos .title {
  color: #04b4f4;
  font-size: 2rem;
  font-weight: bolder;
  margin-bottom: 0px;
}

.card-catalogos .subtitle {
  color: gray;
  font-weight: bolder;
  font-size: 1.25rem;
}

.card-producto {
  margin-right: 10px !important;
}
.unete-nosotros-btn{
  position: absolute;
  bottom: 14%;
  left: 10%;
}
.unete-nosotros-text{
  position: absolute;
  top: 40px;
  left: 10%;
  font-size: 1.3rem;
  font-weight: bolder;
}

.img-uneteN::v-deep(.v-image__image)  {
    background-color: rgb(0 0 0 / 41%);
    filter: brightness(0.7);
}
.img-uneteN{
  height: 300px;
  max-width: 300px;
}
.border0{
  border: 0px !important;
}
@media (min-width: 992px) {
  .apps {
    max-width: 50% !important;
  }
}

/* X-Small devices (portrait phones, less than 576px)*/
@media (max-width: 575.98px) {
  .soluciones-iconos {
    font-size: 5.5rem;
  }

  .soluciones-iconos.icon-gycso-torniquete {
    font-size: 4.5rem;
  }

  .soluciones-iconos.icon-gycso-video-camara {
    font-size: 3.5rem;
  }

  .soluciones-text {
    font-size: 1rem;
  }

  .container-productos {
    width: 100% !important;
  }
  .img-uneteN{
    height: 200px;
    max-width: 200px;
  }
}
@media (max-width: 768px) {
  .img-uneteN{
    height: 250px;
    max-width: 250px;
  }
}
/* Small devices (landscape phones, 576px and up)*/
@media (min-width: 576px) {
  .card {
    margin: 10px 0px;
  }
}

/* Medium devices (tablets, 768px and up)*/
@media (min-width: 768px) {
  .card {
    margin: 20px 0px;
  }
}

/* Large devices (desktops, 992px and up)*/
@media (min-width: 992px) {
  .card {
    margin: 20px 0px;
  }
}

/* X-Large devices (large desktops, 1200px and up)*/
@media (min-width: 1200px) {
  .card {
    margin: 20px 0px;
  }
}

/* XX-Large devices (larger desktops, 1400px and up)*/
@media (min-width: 1400px) {}
</style>