<template>
  <div>
    <header-custom></header-custom>
    <div id="navbar-desktop" class="cointainer-nav hide-on-small-only">
      <nav class="navbar-top white">
        <div class="nav-wrapper">
          <ul>
            <li>
              <v-img src="/images/logo.png" width="90px" id="logo-top" @click="openUrl('/')"></v-img>
            </li>
            <li class="input-search">
              <v-text-field label="" prepend-inner-icon="mdi-magnify"></v-text-field>
            </li>
            <li class="primer-nivel">
              <a id="categorias-nav" href="/categorias/inicio" @mouseover="openMenu('categorias-nav', true)"
                @mouseleave="openMenu('categorias-nav', false)">Categorías<v-icon>mdi-menu-down</v-icon></a>
              <ul class="segundo-nivel" @mouseover="openMenu('categorias-nav', true)"
                @mouseleave="openMenu('categorias-nav', false)">
                <div class="container container--fluid">
                  <div class="row">
                    <div class="col-sm-4">
                      <li v-for="item in menu.productos" :key="item.id" :id="'producto' + item.id" class="item-menu1"
                        @mouseover="openSubmenu(item, 2, 'productos')"><a :href="item.url_amigable">{{ item.nombre }}<v-icon
                            v-if="item.have_children == 1" class="icon-item">mdi-menu-down</v-icon></a></li>
                    </div>
                    <div class="col-sm-4">
                      <li v-for="item in productosN2" :key="item.id" :id="'producto' + item.id" class="item-menu2"
                        @mouseover="openSubmenu(item, 3, 'productos')"><a :href="item.url_amigable">{{ item.nombre }}<v-icon
                            v-if="item.have_children == 1" class="icon-item">mdi-menu-down</v-icon></a></li>
                    </div>
                    <div class="col-sm-4">
                      <li v-for="item in productosN3" :key="item.id" :id="'producto' + item.id" class="item-menu3"
                        @mouseover="openSubmenu(item, 4, 'productos')"><a :href="item.url_amigable">{{ item.nombre }}</a></li>
                    </div>
                  </div>
                </div>
              </ul>
            </li>
            <li>
              <a id="servicios-nav" href="" class="segundo-nivel" @mouseover="openMenu('servicios-nav', true)"
                @mouseleave="openMenu('servicios-nav', false)">Servicios<v-icon>mdi-menu-down</v-icon></a>
              <ul class="segundo-nivel" @mouseover="openMenu('servicios-nav', true)"
                @mouseleave="openMenu('servicios-nav', false)">
                <div class="container container--fluid">
                  <div class="row">
                    <div class="col-sm-4">
                      <li v-for="item in menu.servicios" :key="item.url" :id="'serv' + item.url" class="item-menu1"
                        @mouseover="openSubmenu(item, 2,'servicios')"><a href="#">{{ item.nombre }}<v-icon v-if="item.have_children == 1"
                            class="icon-item">mdi-menu-down</v-icon></a></li>
                    </div>
                    <div class="col-sm-4">
                      <li v-for="item in serviciosN2" :key="item.url" :id="'serv' + item.url" class="item-menu2" @mouseover="openSubmenu(item, 3,'servicios')"><a href="#">{{ item.nombre }}</a></li>
                    </div>
                  </div>
                </div>
              </ul>
            </li>
            <li class="ocultar"><a href="#">App</a></li>
            <li class="ocultar"><a href="#">Nosotros</a></li>
            <li><a href="#">Contacto</a></li>
            <li class="ocultar"><a href="#">Ayuda</a></li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</template>
<script>
import HeaderCustom from "./HeaderCustom";
export default {
  name: "navBar",
  components: { HeaderCustom },
  props: {
  },
  data() {
    return {
      menu: [],
      productosN2: [],
      productosN3: [],
      serviciosN2: [],
    }
  },
  created() {
  },
  mounted() {
    this.getMenu();
  },
  methods: {
    getMenu() {
      let self = this;
      axios({
        method: "get",
        url: '/home/nav',
        headers: {
          "Content-Type": "multipart/form-data"
        },
      })
        .then(function (response) {
          self.$set(self, 'menu', response.data);
        })
        .catch(function (error) {
          Vue.notify({ title: error, type: 'error' });
        });
    },
    openUrl(url){
            location.replace(url)
    },
    openMenu(item_id, status) {
      if (!status) {
        $('#' + item_id).parent().removeClass('active')
        this.$set(this, 'productosN2', []);
        this.$set(this, 'productosN3', []);
        this.$set(this, 'serviciosN2', []);
      } else {
        $('.primer-nivel').removeClass('active')
        $('#' + item_id).parent().addClass('active')
      }
    },
    openSubmenu(item, nivel, tipo) {
      if (tipo == 'productos') {
        switch (nivel) {
          case 2:
            $('.item-menu1').removeClass('item-select');
            this.$set(this, 'productosN3', []);
            this.$set(this, 'productosN2', item.children);
            break;
          case 3:
            $('.item-menu2').removeClass('item-select');
            this.$set(this, 'productosN3', item.children);
            break;
          case 4:
            $('.item-menu3').removeClass('item-select');
            break;
          default:
            break;
        }
        $('#producto' + item.id).addClass('item-select');
      } else if(tipo == 'servicios') {
        switch (nivel) {
          case 2:
            $('.item-menu1').removeClass('item-select');
            //this.$set(this, 'productosN3', []);
            this.$set(this, 'serviciosN2', item.children);
            break;
          case 3:
            $('.item-menu2').removeClass('item-select');
            //this.$set(this, 'productosN3', item.children);
            break;
            
        }
        $('#serv' + item.url).addClass('item-select');
      }

    }
  }
}
</script>

<style scoped>
.navbar-top ul a {
  font-size: 1rem;
  color: black;
  cursor: pointer;
}

#logo-top {
  margin-left: 15px;
}
#navbar-desktop .navbar-top {
  padding: 10px 20px;
  height: 85px !important;
}

#navbar-desktop .input-search {
  margin-left: 10px;
  width: 120px;
}

#navbar-desktop ul ul {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  padding: 0;
}

.segundo-nivel {
  z-index: 1;
  ;
}

.segundo-nivel li {
  float: initial !important;
  line-height: 2;
}

#navbar-desktop ul li.active>ul {
  display: block;
}

#navbar-desktop .segundo-nivel {
  background-color: white;
  width: 100%;
}

#navbar-desktop .item-select {
  border-left: 2px solid #0d47a1;
}

.icon-item {
  height: auto;
}
#navbar-desktop nav ul a {
    padding: 0 8px;
}
@media (max-width: 770px) {
  .ocultar{
    display: none;
  }
}
</style>