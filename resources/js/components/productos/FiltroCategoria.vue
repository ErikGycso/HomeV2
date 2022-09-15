<template>
  <article id="cont-filtros">
    <section v-if="countItems(categorias) > 0">
      <h5>
        Categorías:
        <v-icon v-if="!view_categoria" class="icons-filtros" @click="view_categoria = true">mdi-chevron-down</v-icon>
        <v-icon v-if="view_categoria" class="icons-filtros" @click="view_categoria = false">mdi-chevron-up</v-icon>
      </h5>
      <ul v-if="view_categoria" class="cont-filtros">
        <li v-for="categoria in categorias" :key="categoria.id">
          <v-checkbox v-model="filtros.categorias" :label="categoria.nombre" :value="categoria.id" hide-details @click="clickFiltro()">
          </v-checkbox>
        </li>
      </ul>
    </section>
    <section v-if="countItems(marcas) > 0">
      <h5>
        Marcas:
        <v-icon v-if="!view_marca" class="icons-filtros" @click="view_marca = true">mdi-chevron-down</v-icon>
        <v-icon v-if="view_marca" class="icons-filtros" @click="view_marca = false">mdi-chevron-up</v-icon>
      </h5>
      <ul v-if="view_marca" class="cont-filtros">
        <li v-for="marca in marcas" :key="marca.id">
          <v-checkbox v-model="filtros.marcas" :label="marca.marca + ' (' + marca.cantidad + ')'" :value="marca.marca" hide-details @click="clickFiltro()">
          </v-checkbox>
        </li>
      </ul>
    </section>
    <section v-if="countItems(caracteristicas) > 0">
      <h5>
        Filtrar por caracteristica:
        <v-icon v-if="!view_caracteristica" class="icons-filtros" @click="view_caracteristica = true">mdi-chevron-down
        </v-icon>
        <v-icon v-if="view_caracteristica" class="icons-filtros" @click="view_caracteristica = false">mdi-chevron-up
        </v-icon>
      </h5>
      <ul v-if="view_caracteristica" class="cont-filtros">
        <li v-for="(filtro, key) in caracteristicas" :key="key">
          <h6>{{ key }}</h6>
          <ul>
            <li v-for="(fil, key_fil) in filtro" :key="key_fil">
              <v-checkbox v-model="filtros.caracteristicas" :label="fil" :value="key_fil" hide-details @click="clickFiltro()"></v-checkbox>
            </li>
          </ul>
        </li>
      </ul>
    </section>
  </article>
</template>

<script>

export default {
  name: "FiltroCategoria",
  props: {
  },
  data() {
    return {
      view_marca: false,
      view_categoria: false,
      view_caracteristica: false,
      categorias: [],
      marcas: [],
      caracteristicas: [],
      filtros: {
        categorias: [],
        marcas: [],
        caracteristicas: [],
      }
    }
  },
  mounted() {
    this.$set(this, 'categorias', this.pcategorias);
  },
  methods: {
    countItems(nodo) {
      if (typeof nodo == 'object') {
        return Object.keys(nodo).length
      }
      if (typeof nodo == 'array') {
        return nodo.length;
      }
      return 0;
    },
    setFiltrosCategorias(categorias) {
      this.$set(this, 'categorias', categorias);
    },
    setFiltrosMarcas(marcas) {
      this.$set(this, 'marcas', marcas);
    },
    setFiltrosCaracteristicas(caracteristicas) {
      this.$set(this, 'caracteristicas', caracteristicas);
    },
    clickFiltro(){
      this.$emit('update-filtros');
      
    }
  }
}
</script>

<style scoped>
#cont-filtros::v-deep(.v-icon) {
    color: rgb(32 92 146);
}
#cont-filtros {
  overflow-y: auto;
  height: 65%;
}
.cont-filtros{
  background-color: white;
}
#cont-filtros::v-deep(.v-input--selection-controls) {
  margin-top: 0px;
  padding-top: 0px;
}

#cont-filtros::v-deep(.v-label) {
  font-size: 12px;
  color: black;
}

.icons-filtros {
  cursor: pointer;
  float: right;
  position: inherit;
}

#cont-filtros::v-deep(button:focus) {
  background-color: #01a5e200;
}
</style>