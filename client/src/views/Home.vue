<template>
  <div class="home">
    <section-1/>
    <section-2/>
    <section-3/>
    <section-4 v-if="userId == ''" :key="refresh"/>
  </div> 
</template>

<script>
import Section1 from '@/components/home/Section1.vue'
import Section4 from '../components/home/Section4.vue'
import Section2 from '../components/home/Section2.vue'
import Section3 from '../components/home/Section3.vue'
import { getDataAPI, postDataAPI } from '../utils/fetchData';

export default {
  name: 'Home',
  components: {
    Section1,
    Section4,
    Section2,
    Section3
  },
  data() {
    return {
      userId: "",
      refresh: 0
    }
  },
  mounted: function(){
    (async() => {
      var token = localStorage.getItem("token");
      let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200) {
          this.userId = res.data["user"]["userId"];
          this.refresh = 1 - this.refresh;
      }
    })()
  }
}
</script>
<style scoped>

</style>
