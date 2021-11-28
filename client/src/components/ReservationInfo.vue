<template>
    <div class="row border contain">
        <div style="min-width: 10px"> </div>
        <div class="image" :style="img_style"></div>
        <div style="min-width: 10px"> </div>
        <div class="col part linespace">
            <div class="font">By: <span class="bold">{{user}}</span></div>
            <div class="font">Start: <span class="bold">{{convertDate(startDate)}}</span></div>
        </div>
        <div style="min-width: 10px"> </div>
        <div v-if="this.showMiddle" class="col part linespace">
            <div class="font">Room: <span class="bold">{{roomName}}</span></div>
            <div class="font">Book: <span class="bold">{{convertDate(reserveDate)}}</span></div>
        </div>
        <div style="min-width: 10px" v-if="this.showMiddle"> </div>
        <div class="not_show col part linespace" v-if="this.showMiddle">
            <div class="font">Duration: <span class="bold">{{duration}}</span></div>
            <div class="font">Price: <span class="bold cost">{{totalPrice}}.000 VND</span></div>
        </div>
        <div style="min-width: 10px" v-if="this.showMiddle"> </div>
        <div class="col part linespace" v-if="!this.showMiddle">
            <div class="font">Duration: <span class="bold">{{duration}}</span></div>
            <div class="font">Total: <span class="bold cost">{{totalPrice}}.000 VND</span></div>
        </div>
        <div style="min-width: 10px" v-if="!this.showMiddle"> </div>
        <img v-if="this.paid" src="../assets/icon/paid.png" class="pay" alt="pay">
        <img v-else src="../assets/icon/unpaid.png" class="pay" alt="pay">
        <div style="min-width: 10px"> </div>
    </div>
</template>

<script>
export default {
    props: {
        user: String,
        reserveDate: Date, // Optional if showMiddle
        showMiddle: {
            type: Boolean,
            default: false
        },
        roomName: String, // Optional if showMiddle
        startDate: Date, 
        duration: String,
        price: Number,
        totalPrice: Number,
        img: String,
        paid: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        img_style: function(){
            return {
                "background-image": "url(" + (this.img ? this.img : 'https://i.9mobi.vn/cf/images/2015/03/nkk/nhung-hinh-anh-dep-19.jpg') + ")"
            }
        }
    },
    methods: {
        convertDate: function(date) {
            if (date) {
                var year = date.getFullYear();

                var month = (1 + date.getMonth()).toString();
                month = month.length > 1 ? month : '0' + month;

                var day = date.getDate().toString();
                day = day.length > 1 ? day : '0' + day;
                
                return day + '/' + month + '/' + year;
            }
        },
    }
}
</script>

<style scoped>
    .border {
        border-radius: 10px 0px 10px 0px;
    }
    .row {
        display: flex;
        flex-direction: row;
    }
    .col {
        display: flex;
        flex-direction: column;
    }
    .contain {
        background-color: var(--theme_fore);
        justify-content: space-around;
        align-items: center;
        color: var(--theme_black);
        cursor: pointer;
    }
    .cost {
        color: var(--theme_jade);
    }
    .contain:hover {
        background-color: var(--theme_gray);
        color: var(--theme_white);
    }
    .image {
        height: 74px;
        width: 74px;
        min-width: 74px;
        border-radius: 40px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    .pay {
        width: 35px;
        display: block;
    }
    .part {
        height: 80px;
        width: 200px;
    }
    .linespace {
        justify-content: space-evenly;
    }
    .font {
        font-size: 18px;
    }
    .bold {
        font-weight: bold;
    }

    @media only screen and (max-width: 768px) {
        .part {
            width: 33%;
        }
        .font {
            font-size: 15px;
        }
        .image {
            width: 60px;
            height: 60px;
            min-height: 60px;
            min-width: 60px;
        }
    }

    @media only screen and (max-width: 600px) {
        .part {
            width: 33%;
        }
        .font {
            font-size: 12px;
        }
        .image {
            width: 50px;
            height: 50px;
            min-height: 50px;
            min-width: 50px;
        }
        .not_show {
            display: none;
        }
        .pay {
            width: 30px;
        }
    }

    @media only screen and (max-width: 400px) {
        .part {
            width: 33%;
        }
        .font {
            font-size: 10px;
        }
        .image {
            width: 40px;
            height: 40px;
            min-height: 40px;
            min-width: 40px;
        }
        .not_show {
            display: none;
        }
        .pay {
            width: 16px;
        }
    }
</style>