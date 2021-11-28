<template>
  <div id="app">
    <header-bar v-bind="{
      route: $router.history.current.path,
    }"
    :key="getKey()"/>
    <router-view/>
    <theme-footer v-bind:route="$router.history.current.path"/>
  </div>
</template>

<script>
  import HeaderBar from '@/components/HeaderBar.vue';
  import ThemeFooter from './components/ThemeFooter.vue';
  import {getDataAPI, postDataAPI} from './utils/fetchData';
  import axios from 'axios'

  export default {
    name: 'App',
    components: {
      HeaderBar,
      ThemeFooter,
    },
    methods: {
      getKey() {
        return localStorage.getItem('token');
      }
    },
    data() {
      return {
        isManager: false,
      }
    },
    mounted() {
      (async () => {
        var token = localStorage.getItem("token");
        if (token) {
          let res = await getDataAPI('auth/get', token);
          if (res.data["status"] === 200) {
            this.isManager = res.data["user"]["type"] === 'M';
          }
        }
      })()
    },
  }
</script>



<style src="./styles/styles.css">
  #app {
    font-family: OpenSans;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
  }

  #body {
    width: 100%;
    align-items: center;
    display: flex;
    padding: 0 20px;
  }

  #main {
    width: 100%;
    max-width: 10px;
  }
</style>

