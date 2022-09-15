<template>
  <header class="top-header" v-cloak>
    <v-app-bar id="nav-top" color="black" dense dark style="height:70px; padding-top: 10px;">
      <v-app-bar-nav-icon @click="drawer = true" class="ocultar"></v-app-bar-nav-icon>
      <v-btn icon>
        <v-icon>mdi-facebook</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon>mdi-instagram</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon>mdi-linkedin</v-icon>
      </v-btn>
      <v-spacer></v-spacer>
      <v-btn icon>
        <span class="hide-on-small-only">(222) 342 8657</span>
        <v-icon>mdi-phone</v-icon>
      </v-btn>
      <v-spacer></v-spacer>
      <v-btn icon class="ml-icon">
        <v-icon>mdi-cart-outline</v-icon>
        <span class="text-caption span-shop hide-on-small-only">Carrito</span>
      </v-btn>
      <v-btn icon class="ml-icon">
        <v-icon>mdi-account</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon x-large class="action-whatsapp">mdi-whatsapp</v-icon>
      </v-btn>
    </v-app-bar>
    <v-navigation-drawer v-model="drawer" absolute temporary class="menu">
      <v-list nav dense>
        <v-list-item-group v-model="group" active-class="deep-purple--text text--accent-4">
          <v-list-item>
            <v-list-item-icon>
              <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-title><a href="/">Inicio</a></v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-icon>
              <v-icon>shopping-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title><a href="/categorias/inicio">Productos</a> </v-list-item-title>
          </v-list-item>
          <v-list-item>
            <v-list-item-icon>
              <v-icon>toolbox-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title><a href="#">Servicios</a> </v-list-item-title>
          </v-list-item>
          <v-list-item>
            <v-list-item-icon>
              <v-icon>cellphone-text</v-icon>
            </v-list-item-icon>
            <v-list-item-title><a href="#">App</a> </v-list-item-title>
          </v-list-item>
          <v-list-item>
            <v-list-item-icon>
              <v-icon>card-account-mail-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title><a href="#">Contacto</a> </v-list-item-title>
          </v-list-item>
          <v-list-item>
            <v-list-item-icon>
              <v-icon>tooltip-question-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title><a href="#">Ayuda</a> </v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </header>

</template>

<script>

export default {
  name: "HeaderCustom",
  props: {

  },
  data() {
    return {
      drawer: false,
      group: null,
    }
  },
  watch: {
  },
  mounted() {
  },
  methods: {

  }
}
</script>

<style scoped>
  .menu a{
    color: black;
  }
#nav-top {}
.action-whatsapp {
  color: white;
  background: #0ab80a;
  border-radius: 20px;
}

.span-shop {
  font-size: 0.6rem;
}

.ml-icon {
  margin-left: 10px;
}
@media (min-width: 601px) {
  .ocultar{
    display: none;
  }
}
</style>