<template>
<div :style="container_style" class="container">
    
    <logo class="logo" :color="color" :width="getWidth()"/>
    <div class="text" :style="text">ROOM PRO</div>
    <div style="clear: both"></div>
</div>
    
</template>

<script>
import logo from "@/components/logo.vue"

export default {
  components: { logo },
  props: {
      color: String,
      size: String // 1 is biggest (1st login page), 2 is on header and footer
  },
  
  computed: {
      container_style: function(){
          return{
              "display": "block",              
          }
      },
      text: function(){
          return {
        "color": (this.color?this.color:"#000000"),
        "font-size": (this.size=="1"?"48px":"24px"),
        "line-height": (this.size=="1"?"72px":"36px"),
      }
      },
  },
  methods: {
      getWidth() {
          return (this.size=="1"?"140px":"70px")
      }
  }

}
</script>
<style scoped>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');

.text {

    font-family: Poppins;
    
    font-weight: normal;

    display: flex;
    float: left;
    
    align-items: center;
    text-align: center;
    text-transform: uppercase;
    position: relative;
    padding: 25px;
   
    
}
.container {
    width: 100%
    
}
.logo {
    display: flex;
    float: left;
}

</style>