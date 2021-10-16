<template>
  <div>
    <div>Hello there</div>
    <theme-button msg="Button"/>
  </div>
</template>

<script>
import PictureFrame from '@/components/PictureFrame.vue'
import ThemeButton from '@/components/ThemeButton.vue'
export default {
  components: {
    PictureFrame,
    ThemeButton
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
