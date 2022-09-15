<template>
    <div id="productos-page">
        <v-container fluid>
            <div class="row" cols="12">
                <v-col>
                    <v-breadcrumbs :items="breadcrumbsItems">
                        <template v-slot:item="{ item }">
                            <v-breadcrumbs-item :href="item.href" :disabled="item.disabled" class="breadcrumbs-item">
                                {{ item.text }}
                            </v-breadcrumbs-item>
                        </template>
                    </v-breadcrumbs>
                </v-col>
            </div>
            <v-row>
                <v-col id="filtros" cols="12" md="3" lg="2">
                    <aside id="c-filtros">
                        <arbol-categorias :parbol="{}" :pid_principal="'a'" :pids_activar="[]" :pid_actual_cat="0"
                            ref="arbol" />
                        <filtro-categoria :pcategorias="[]" ref="filCat" @update-filtros="getProductos"/>
                    </aside>
                </v-col>
                <v-col>
                    <v-row>
                        <v-col class="mb4">{{label_top}}</v-col>
                    </v-row>
                    <v-row id="productos-list">
                        <v-col v-for="producto in productosFiltrados" :key="producto.id" cols="12" sm="4" lg="3">
                            <producto-card :url="producto.directorio" :nombre="producto.nombre"
                                :url_amigable="producto.url_amigable" />
                        </v-col>
                    </v-row>
                    
                    <div id="cont-paginador" class="text-center row">
                        <div class="col-4">
                            <v-select id="itemPage" v-model="no_items" :items="[20,40,60,80,100]" label="" @input="getLengthPages()"></v-select>
                        </div>
                        <div class="col-8 vhc-center">
                            <ul id="pagination" class="pagination">
                                <li :class="page==1?'disabled':'waves-effect'"  @click="page=page-(page==1?0:1)">
                                    <v-icon class="icon-inv">mdi-chevron-left</v-icon>
                                </li>
                                <li :class="page==index?'active':'waves-effect'" v-for="index in length_page" :key="index" @click="page=index"><a>{{index}}</a></li>
                                <li :class="page==length_page?'disabled':'waves-effect'" @click="page=page+(page==length_page?0:1)">
                                    <v-icon class="icon-inv">mdi-chevron-right</v-icon>
                                </li>
                            </ul>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-container>
        <loading v-if="showLoading"></loading>
    </div>
</template>

<script>
import ArbolCategorias from "../productos/ArbolCategorias";
import FiltroCategoria from "../productos/FiltroCategoria";
import ProductoCard from "../productos/ProductoCard";
import Loading from "../Loading";
export default {
    name: "ProductosList",
    components: { ArbolCategorias, FiltroCategoria, ProductoCard, Loading },
    data() {
        return {
            showLoading: true,
            label_top: '',
            categoria: '',
            categoriaObj: { id: '' },
            breadcrumbsItems: [],
            productos: [],
            ids_activar: [],
            arbol: {},
            page: 1,
            no_items: 20,
            length_page: 1,
        }
    },
    mounted() {
        this.categoria = window.location.pathname.split('/')[2]
        this.getBreadcrumbs();
        this.getFiltros();
        this.getProductos();
    },
    methods: {
        countItems(nodo) {
            if (typeof nodo == 'object') {
                return Object.keys(nodo).length
            }
            return nodo.length;
        },
        getBreadcrumbs() {
            let self = this;
            axios({
                method: "get",
                url: '/categorias/get-breadcrumbs/' + self.categoria,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            }).then(function (response) {
                self.$set(self, 'breadcrumbsItems', response.data.migajas);
                self.$set(self, 'categoriaObj', response.data.categoria);
                self.$set(self, 'ids_activar', response.data.map(a => a.id_arbol));

            }).catch(function (error) {
                Vue.notify({ title: error, type: 'error' });
            });
        },
        getFiltros() {
            let self = this;
            axios({
                method: "get",
                url: '/categorias/get-filtros/' + self.categoria,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            }).then(function (response) {
                self.$set(self, 'arbol', response.data.arbol);
                self.$refs.arbol.setArbol(response.data.arbol, 'nodo_principal_arbol', self.ids_activar, self.categoriaObj.id);
                self.$refs.filCat.setFiltrosCategorias(response.data.filtros_categorias);
                self.$refs.filCat.setFiltrosMarcas(response.data.marcas);
            }).catch(function (error) {
                Vue.notify({ title: error, type: 'error' });
            });
        },
        getProductos() {
            let self = this;
            self.showLoading = true;
            let form = new FormData();
            let filtros = this.$refs.filCat.filtros;
            form.append('categoria', self.categoria);
            form.append('filCategorias', filtros.categorias.join());
            form.append('filMarcas', filtros.marcas.join());
            form.append('filCaracteristicas', filtros.caracteristicas.join());
            axios({
                method: "post",
                url: '/get-productos',
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            }).then(function (response) {
                self.$set(self, 'productos', response.data);
                self.getLengthPages();
                self.showLoading = false;

            }).catch(function (error) {
                self.showLoading = false;
                Vue.notify({ title: error, type: 'error' });
            });
        },
        getLengthPages(){
            let length_page = Math.ceil(this.productos.length / this.no_items);
            this.$set(this, 'length_page', length_page);
            this.$set(this, 'page', 1);
        },
        subLista() {
            this.no_items
            this.page
        },
    },
    computed: {
        productosFiltrados() {
            let ini = 0;
            let fin = 0;
            switch (this.page) {
                case 1:
                    ini = 0;
                    fin = this.no_items
                    break;
                default:
                    ini = this.no_items * (this.page-1);
                    fin = ini + this.no_items;
                    break;
            }

            let data = this.productos.slice(ini, fin);
            this.$set(this, 'label_top', ini + 1 + ' al ' + fin + ' de ' + this.productos.length);
            return data;
            /*
            return data = this.productos.filter(row => {
                const name = row.name == null ? '' : row.name.toLowerCase();
                const fist_name = row.fist_name == null ? '' : row.fist_name.toLowerCase();
                const last_name = row.last_name == null ? '' : row.last_name.toLowerCase();
                const matricula = row.matricula == null ? '' : row.matricula.toString().toLowerCase();
                const cuenta_bancaria = row.cuenta_bancaria == null ? '' : row.cuenta_bancaria.toString().toLowerCase();
                const cuenta_interbancaria = row.cuenta_interbancaria == null ? '' : row.cuenta_interbancaria.toString().toLowerCase();
                const search = this.searchBill.trim().toLowerCase();

                return (
                    name.includes(search) || fist_name.includes(search) || last_name.includes(search) || cuenta_bancaria.includes(search) || cuenta_interbancaria.includes(search) || matricula.includes(search)
                );
            })
            */
        },
    }
}
</script>
<style scoped>

#cont-paginador::v-deep(#itemPage){
    display: none;
}
#cont-paginador::v-deep(.v-select){
    max-width: 70px;
}
#productos-list {
    max-height: 76vh;
    scroll-behavior: auto;
    overflow-y: auto;
}
#pagination{
    margin-bottom: 0px !important;
}
.breadcrumbs-item::v-deep(.v-breadcrumbs__item) {
    color: black;
}

#productos-page::v-deep(.v-breadcrumbs) {
    padding: 5px;
}

#c-filtros {
    height: 76vh;
}

#paginador {
    background-color: #ee6e7300;
    box-shadow: 0px 0px;
}

#productos-page::v-deep(.theme--light.v-pagination .v-pagination__item--active) {
    background-color: #2e75b5de;
}

#productos-page::v-deep(.theme--light.v-pagination .v-pagination__item) {
    line-height: 1 !important;
}

#cont-paginador::v-deep(.v-menu) {
    display: block !important;
}

#select_items {
    width: 87px;
    position: absolute;
}

@media (max-width: 960px) {
    #filtros {
        position: relative;
        display: none;
    }
}
</style>