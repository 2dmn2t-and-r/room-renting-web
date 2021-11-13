<template>
    <div class="theme-button" :style="style">
        <md-button :style="button_style" @click.native="onClick()">{{ msg }}</md-button>
    </div>
</template>

<script>
export default {
    props: {
        msg: String,
        width: String,
        height: String,
        background_color: String,
        color: String,
        border_radius: String
    },
    computed: {
        button_style: function(){
            return {
                "width": "100%",
                "height": "100%",
                "background-color": this.background_color ? this.background_color : "#caa892",
                "color": this.color ? this.color : "#ffffff",
                "border-radius": (this.border_radius ? this.border_radius : '15px') + " 0px",
                "text-transform": "none",
                "margin": "0px",
            }
        },
        style: function() {
            return {
                "width": this.width ? this.width : '97px',
                "height": this.height ? this.height : '32px',
            }
        }
    },
    methods: {
        onClick() {
            this.$emit('click');
        },
    },
}
</script>

<style scoped>

</style>