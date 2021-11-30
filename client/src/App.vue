<template>
  <div id="app">
    <header-bar v-bind="{
      route: $router.history.current.path,
    }"
    :key="getKey()"/>
    <router-view/>
    <theme-footer v-bind:route="$router.history.current.path" v-bind="{
      address: address,
      email: email,
      phone: phone,
      facebook: facebook,
      twitter: twitter,
      instagram: instagram,
      tiktok: tiktok
    }" :key="refresh"/>
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
        address: "",
        email: "",
        phone: "",
        facebook: "",
        twitter: "",
        instagram: "",
        tiktok: "",
        refresh: 0
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
          res = await getDataAPI('info', undefined);
          if (res.data["status"] === 200) {
            this.address = res.data["info"]["address"];
            this.email = res.data["info"]["email"];
            this.phone = res.data["info"]["phone"];
            this.facebook = res.data["info"]["facebook"];
            this.twitter = res.data["info"]["twitter"];
            this.instagram = res.data["info"]["instagram"];
            this.tiktok = res.data["info"]["tiktok"];
            this.refresh = 1 - this.refresh;
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

