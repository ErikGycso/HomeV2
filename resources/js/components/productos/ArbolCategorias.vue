<template>
  <section id="arbol-categoria" class="card pt2">
    <ul :id="id_principal" :class="id_principal != 'nodo_principal_arbol' ? (ids_activar.includes(id_principal) ? '' : 'oculto') : ''">
        <div  v-for="(nodo, key) in arbol" :key="key" :class="(key == id_actual_cat ? 'nodo_activo' : '')">
          <li :class="countItems(nodo.hijos) > 0 ? 'nodos-principales' : 'nodos-principales2'">
            <v-icon v-if="countItems(nodo.hijos) > 0" @click="openNodo('categoria_' + key)">mdi-chevron-right</v-icon>
            <v-icon v-if="countItems(nodo.hijos) == 0" class="icon-inv">mdi-chevron-right</v-icon>
            <a :href="nodo.url">{{ nodo.nombre }}</a>
            <template v-if="countItems(nodo.hijos) > 0">
              <ul :class="ids_activar.includes('categoria_' + key) ? ' sublista' : 'oculto sublista'" :id="'categoria_' + key">
                  <div v-for="(subnodo, key2) in nodo.hijos" :key="key2" :class="key2 == id_actual_cat ? 'nodo_activo' : ''">
                    <li :class="'subnivel ' + (countItems(subnodo.hijos) > 0 ? 'nodos-principales' : 'nodos-principales2')">
                      <v-icon v-if="countItems(subnodo.hijos) > 0" @click="openNodo('categoria_' + key2)">mdi-chevron-right</v-icon>
                      <v-icon v-if="countItems(subnodo.hijos) == 0" class="icon-inv">mdi-chevron-right</v-icon>
                      <a :href="subnodo.url">{{ subnodo.nombre }}</a>
                      <arbol-categorias :parbol="subnodo.hijos" :pid_principal="'categoria_'+key2" :pids_activar="ids_activar" :pid_actual_cat="id_actual_cat" />
                    </li>
                  </div>
              </ul>
            </template>
          </li>
        </div>
    </ul>
  </section>
</template>

<script>

export default {
  name: "ArbolCategorias",
  props: {
    parbol: {
      type: Object/Array,
      required: false,
      default: () => ({})
    },
    pid_principal: {
      type: String,
      required: false,
      default: 'a'
    },
    pids_activar: {
      type: Array,
      required: false,
      default: () => [],
    },
    pid_actual_cat: {
      required: false,
      default: ''
    },
  },
  data() {
    return {
      arbol: {},
      id_principal: 0,
      ids_activar: [],
      id_actual_cat: 'a'
    }
  },
  mounted() {
    this.$set(this, 'arbol', this.parbol);
    this.$set(this, 'id_principal', this.pid_principal);
    this.$set(this, 'ids_activar', this.pids_activar);
    this.$set(this, 'id_actual_cat', this.pid_actual_cat);
  },
  methods: {
    openNodo(id) {
      $("#" + id).toggle("slow");
    },
    countItems(nodo) {
      if (typeof nodo == 'object') {
        return Object.keys(nodo).length
      }
      return nodo.length;
    },
    setArbol(arbol, id_principal, ids_activar, id_actual_cat) {
      this.$set(this, 'arbol', arbol);
      this.$set(this, 'id_principal', id_principal);
      this.$set(this, 'ids_activar', ids_activar);
      this.$set(this, 'id_actual_cat', id_actual_cat);
    }
  }
}
</script>

<style scoped>
#arbol-categoria{
  height: 35%;
  overflow-y: auto;
}
#arbol-categoria::v-deep(a){
  color: black;
}
.nodos-principales {
  list-style-type: none;
}
.oculto {
    display: none;
}
.icon-inv{
  color: #ffffff00;
}
.subnivel {
    padding-left: 3px;
    list-style-type: none;
}
.sublista{
  padding-left: 10px;
}
</style>