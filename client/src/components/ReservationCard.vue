<template>
    <div class="card_outer card_padding border card_background card_inner">
        <div class="card_img border" :style="img_style"></div>
        <div class="divider"></div>
        <div class="column">
            <div class="room_name bold text_line">{{name}}</div>
            <div class="two_cols">
                <div class="text_box">
                    <div class="room_descript text_line">Floor: <span class="bold">{{floor}}</span></div>
                </div>
                <div class="text_box2">
                    <div class="room_descript text_line">Start date: <span class="bold">{{startdate}}</span></div>
                </div>
            </div>
            <div class="two_cols"> 
                <div class="text_box room_descript text_line">
                    Seat: <span class="bold">{{seat}}</span>
                </div>
                <div class="text_box2 room_descript text_line">
                    Duration: <span class="bold">{{duration}}</span>
                </div>
            </div>
            <div class="room_descript text_line">Address: <span class="bold">{{address}}</span></div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        img: String,
        name: String,
        floor: Number,
        seat: Number,
        address: String,
        startdate: String,
        duration: String
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
    .card_img {
        height: 182px;
        max-width: 218px;
        width: 30%;
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
        flex-basis: 35%;
    }
    .text_box2 {
        flex-basis: 65%;
    }
    @media only screen and (max-width: 768px) {
        .text_box {
            flex-basis: 35%;
        }
        .text_box2 {
            flex-basis: 65%;
        }
        .room_descript {
            font-size: 16px;
        }
        .card_img {
            max-width: 120px;
        }
    }

    @media only screen and (max-width: 600px) {
        .room_descript {
            font-size: 12px;
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