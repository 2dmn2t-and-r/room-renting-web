<template>
  <div class="home">
    <section-1/>
    <section-2/>
    <section-3/>
  </div> 
</template>

<script>
// @ is an alias to /src
import Section1 from '@/components/home/Section1.vue'
import Section4 from '../components/home/Section4.vue'
import Section2 from '../components/home/Section2.vue'
import Section3 from '../components/home/Section3.vue'

export default {
  name: 'Home',
  components: {
    Section1,
    Section4,
    Section2,
    Section3
  }
}
</script>
<style scoped>

</style>
