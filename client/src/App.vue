<template>
  <div>
    <div>Hello there</div>
    <theme-button msg="Button"/>
    <theme-footer/>
  </div>
</template>

<script>
import PictureFrame from '@/components/PictureFrame.vue'
import ThemeButton from '@/components/ThemeButton.vue'
import ThemeFooter from './components/ThemeFooter.vue'
export default {
  components: {
    PictureFrame,
    ThemeButton,
    ThemeFooter,
  }
}
</script>

<style src="./styles/styles.css">
#app {
  font-family: OpenSans;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
