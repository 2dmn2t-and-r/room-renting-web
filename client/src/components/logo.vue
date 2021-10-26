<template>
  <div :style="logo_container" v-bind:color="color">
    <div :style="first_rect"></div>
    <div :style="second_rect"></div>
  </div>
</template>
<script>
export default {
    props: {
        width: String,
        color: String
    },
    computed: {
        logo_container: function(){
           return {
             "display": "inline-block",
            "width": (this.width?this.width:"140px"),
            "height": (this.width?this.width:"140px"),
            
            }
        },
        first_rect: function() {
            return {
          "display": "inline-block",
          "position": "relative",
          "width": "90%",
           "height": "90%",
          "border": "4px solid "+ (this.color?this.color:"#CAA892"),
          "box-sizing": "border-box",
          "border-radius": "20px",
          "pointer-events": "none",
            }
        },
        second_rect: function() {
            return { 
            "display": "inline-block",
          "position": "relative",
          "width": "90%",
           "height": "90%",
          "border": "4px solid "+ (this.color?this.color:"#37806B"),
          "box-sizing": "border-box",
          "border-radius": "20px",
          "pointer-events": "none",
            "top": "50%",
            "left": "50%",
            "transform": "translate(-40%,-140%)"}

        }
    }
}
</script>
