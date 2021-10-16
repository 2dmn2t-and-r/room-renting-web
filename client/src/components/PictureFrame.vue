<template>
    <div :style="box_style">
        <div :style="shadow_style"></div>
        <div :style="img_style"></div>
    </div>
</template>

<script>
export default {
    props: {
        width: String,
        height: String,
        width_img: String,
        height_img: String,
        background_img: String,
        border_color: String,
        border_width: String,
        shadow_border_width: String,
        border_radius: String
    },
    computed: {
        img_style: function(){
            return {
                "width": this.width_img ? this.width_img : '200px',
                "height": this.height_img ? this.height_img : '200px',
                "background-image": "url(" + (this.background_img ? this.background_img : 'https://i.9mobi.vn/cf/images/2015/03/nkk/nhung-hinh-anh-dep-19.jpg') + ")",
                "background-size": "cover",
                "background-repeat": "no-repeat",
                "background-position": "center",
                "border": (this.border_width ? this.border_width : '4px') + " solid " + (this.border_color ? this.border_color : '#caa892'),
                "border-radius": (this.border_radius ? this.border_radius : '25px') + " 0px",
                "top": "0px",
                "left": "0px",
                "position": "absolute"
            }
        },
        shadow_style: function(){
            return {
                "width": this.width_img ? this.width_img : '200px',
                "height": this.height_img ? this.height_img : '200px',
                "border": (this.shadow_border_width ? this.shadow_border_width : '1px') + " solid " + (this.border_color ? this.border_color : '#caa892'),
                "border-radius": (this.border_radius ? this.border_radius : '25px') + " 0px",
                "bottom": "0px",
                "right": "0px",
                "position": "absolute"
            }
        },
        box_style: function(){
            return {
                "width": this.width ? this.width : '250px',
                "height": this.height ? this.height : '250px',
                "position": "relative"
            }
        }
    }
}
</script>