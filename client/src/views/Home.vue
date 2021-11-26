<template>
  <div class="home">
    <section-1
    v-bind="{
      title: title1,
      content: content1,
      img: image1,
    }"
    />
    <section-2/>
    <section-3
    v-bind="{
      title: title2,
      content: content2,
      img: image2,
    }"
    />
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
      refresh: 0,
      editModalStep: -1,
      title1: "",
      content1: "",
      image1: "",
      title2: "",
      content2: "",
      image2: "",
      address: "",
      email: "",
      phone: "",
      facebook: "",
      twitter: "",
      instagram: "",
      tiktok: "",
    }
  },
  mounted(){
    (async() => {
      var token = localStorage.getItem("token");
      let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200) {
          this.userId = res.data["user"]["userId"];
          this.refresh = 1 - this.refresh;
      }
    })();
    (async () => {
      let res = await getDataAPI('info', undefined);
      if (res.data["status"] === 200) {
        this.title1 = res.data["info"]["title1"];
        this.content1 = res.data["info"]["content1"];
        this.image1 = res.data["info"]["image1"];
        this.title2 = res.data["info"]["title2"];
        this.content2 = res.data["info"]["content2"];
        this.image2 = res.data["info"]["image2"];
        this.address = res.data["info"]["address"];
        this.email = res.data["info"]["email"];
        this.phone = res.data["info"]["phone"];
        this.facebook = res.data["info"]["facebook"];
        this.twitter = res.data["info"]["twitter"];
        this.instagram = res.data["info"]["instagram"];
        this.tiktok = res.data["info"]["tiktok"];
      }
    })();
  },
}
</script>
<style scoped>

</style>
