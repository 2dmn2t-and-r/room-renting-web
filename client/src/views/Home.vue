<template>
  <div class="home">
    <div>Page này của Trung</div>
    <theme-button msg="Button"/>
    <section-1/>
    <theme-footer/>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'
import PictureFrame from '@/components/PictureFrame.vue'
import ThemeButton from '@/components/ThemeButton.vue'
import ThemeFooter from '@/components/ThemeFooter.vue'
import Section1 from '@/components/home/Section1.vue'

export default {
  name: 'Home',
  components: {
    HelloWorld,
    PictureFrame,
    ThemeButton,
    ThemeFooter,
    Section1,
  }
}
</script>
<style scoped>
.home {
  background-color:aquamarine;
}
</style>
