<template>
    <md-button :style="button_style" class="md-icon-button md-plain" @click="$emit('onClick')">
        <md-icon :style="icon_style">
            {{icon}}
        </md-icon>
    </md-button>
</template>

<style>
    
</style>

<script>
import { palette } from "@/constants/constants.js"
export default {
    name: 'IconButtons',
    props: {
        icon: String,
        color: String,
        bgColor: {
            type: String,
            default: "transparent",
        }
    },
    computed: {
        button_style: function(){
            return {
                "text-transform": "none",
                "background-color": this.bgColor,
            }
        },
        icon_style: function(){
            return {
                "color": this.color ? this.color : palette[4],
            }
        }
    }
}
</script>