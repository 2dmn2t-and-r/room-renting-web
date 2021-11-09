<template>
    <md-button :style="button_style" >{{ msg }}</md-button>
</template>

<script>
export default {
    props: {
        
        msg: String,
        width: String,
        height: String,
        background_color: String,
        color: String,
        border_radius: String, 
        
    },
    computed: {
        button_style: function(){
            return {
                "width": this.width ? this.width : '97px',
                "height": this.height ? this.height : '32px',
                "background-color": this.background_color ? this.background_color : "#caa892",
                "color": this.color ? this.color : "#ffffff",
                "border-radius": (this.border_radius ? this.border_radius : '15px') + " 0px",
                "text-transform": "none"
            }
        },
        
    }
}
</script>