<template>
    <div class="card_outer card_padding border card_background card_inner" @click="$router.push($router.history.current.path + '/' + id.toString()).catch(()=>{});">
        <div class="card_img border" :style="img_style"></div>
        <div class="divider"></div>
        <div class="column">
            <div class="room_name bold text_line">{{title}}</div>
            <div class="room_descript text_line">Upload date: <span class="bold">{{uploaddate}}</span></div>
            <div class="room_descript text_line">Modified: <span class="bold">{{modified}}</span></div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        img: String,
        title: String,
        uploaddate: String,
        modified: String,
        id: Number,
    },
    computed: {
        img_style: function(){
            return {
                "background-image": "url(" + (this.img ? this.img : 'https://i.9mobi.vn/cf/images/2015/03/nkk/nhung-hinh-anh-dep-19.jpg') + ")"
            }
        }
    }
}
</script>

<style scoped>
    .room_name {
        font-size: 22px;
    }
    .room_descript {
        font-size: 18px;
    }
    .bold {
        font-weight: bold;
    }
    .card_background {
        color: var(--theme_black);
        background-color: var(--theme_white);
    }
    .card_background:hover {
        color: var(--theme_white);
        background-color: var(--theme_brown);
    }
    .border {
        border-radius: 20px 0px 20px 0px;
    }
    .card_padding {
        padding: 9px;
    }
    .card_outer {
        height: 200px;
        width: 100%;
    }
    .card_outer:hover {
        cursor: pointer;
    }
    .card_img {
        height: 182px;
        width: 218px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    .card_inner {
        display: flex;
        flex-direction: row;
    }
    .two_cols {
        display: flex;
        flex-direction: row;
        width: 100%;
    }
    .column {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        flex-grow: 1;
    }
    .divider {
        width: 18px;
    }
    .text_box {
        flex-basis: 50%;
    }
    .text_box2 {
        flex-basis: 50%;
    }
    @media only screen and (max-width: 768px) {
        .text_box {
            flex-basis: 35%;
        }
        .text_box2 {
            flex-basis: 65%;
        }
    }
    .text_line {
        line-height: 1.8;
    }
    .break {
        flex-basis: 100%;
        height: 0;
    }
</style>