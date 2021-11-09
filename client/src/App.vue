<template>
  <div id="app">
    <!-- <header-bar v-bind="{
      isAuth: true,
      isManager: false,
      avt: 'https://picsum.photos/200/300',
      route: $router.history.current.path
    }"/> -->
    <router-view/>
  </div>
</template>

<script>
  import HeaderBar from '@/components/HeaderBar.vue';
  
  export default {
    name: 'Room',
    components: {
      HeaderBar,
    }
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

