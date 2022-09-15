<template v-cloak>
  <div>
    <nav-bar></nav-bar>
    <header v-show="allowHeader"></header>
    <loading-session v-if="showLoadingSession"></loading-session>
    <loading v-if="showLoading"></loading>
    <router-view></router-view>
    <footer-app></footer-app>
  </div>
</template>

<script>

let status = true;
let statusActive = true;
import LoadingSession from "./LoadingSession";
import NavBar from "./NavBar";
import Loading from "./Loading";
import FooterApp from './Footer.vue';

export default {
  name: "App",
  components: { Loading, NavBar, LoadingSession,FooterApp },
  data() {
    return {
      allowHeader: true,
      showLoadingSession: true,
      showLoading: false,
    }
  },
  created() {
    this.$set(this, 'showLoadingSession', false);
  },
  mounted() {

  },
  methods: {
  }
}
</script>

<style scoped>
</style>