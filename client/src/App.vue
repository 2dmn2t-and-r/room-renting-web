<template>
  <!-- <div>
    <div>Hello there</div>
    <hello-world msg="Bum La Bum"/>
    <theme-button msg="Button 1" background_color="#37806B"/>
    <div class="logo">
     
      <p class="text">this is logo</p>
    </div>
    <div class="name">
      <projname color="white" size="1"/>
    </div>
  </div> -->
  <router-view />
</template>

<script>
import PictureFrame from '@/components/PictureFrame.vue'
import ThemeButton from '@/components/ThemeButton.vue'
import HelloWorld from '@/components/HelloWorld.vue'
import Logo from '@/components/logo.vue'
import Projname from './components/projname.vue'
export default {
  components: {
    PictureFrame,
    ThemeButton,
    HelloWorld,
    Logo,
    Projname
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
