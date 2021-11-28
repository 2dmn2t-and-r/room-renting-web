<template>
    <div class="full overflow">
        <div class="half_col_left">
            <div class="image-box">
                <picture-frame v-bind="{
                    width: '100%',
                    height: '100%',
                    width_img: 'calc(100% - 20px)',
                    height_img: 'calc(100% - 20px)',
                    background_img: img
                }"/>
            </div>
        </div>
        <div style="min-width: 30px"> </div>
        <div class="half_col_right col">
            <div class="title_font bold black line">{{ title }}</div>
            <div class="font black line row">
                <div class="half_col">By: <span class="bold">{{ owner }}</span></div>
                <div class="half_col">Type: <span class="bold">{{ type }}</span></div>
            </div>
            <div class="font black line row">
                <div class="half_col">Floor: <span class="bold">{{ floor }}</span></div>
                <div class="half_col">Seat: <span class="bold">{{ seat }}</span></div>
            </div>
            <div class="font black line row">
                <div class="half_col">Book date: <span class="bold">{{ convertDate(bookDate) }}</span></div>
                <div class="half_col">Start date: <span class="bold">{{ convertDate(startDate) }}</span></div>
            </div>
            <div class="font black line row">
                <div class="half_col">Start time: <span class="bold">{{ startTime }}</span></div>
                <div class="half_col">End time: <span class="bold">{{ endTime }}</span></div>
            </div>
            <div class="font black line row">
                <div class="half_col">Price: <span class="bold">{{ price }}.000 VND</span></div>
                <div class="half_col">Duration: <span class="bold">{{ duration }}</span></div>
            </div>
            <div class="font black line row">
                <div class="half_col">Total price: <span class="bold jade">{{ totalPrice }}.000 VND</span></div>
                <div class="half_col">Status: <span class="bold" :style="pay_style">{{ status }}</span></div>
            </div>
            <div class="font black line">Address: <span class="bold">{{ address }}</span></div>
            <div class="font black line">{{ description }}</div>
            <div class="row center_row" v-if="enablePay"> <theme-button :msg="'Set paid'" @click="$emit('setPaid');"/> </div>
        </div>
    </div>
</template>

<script>
import PictureFrame from '../../PictureFrame.vue'
import ThemeButton from '../../ThemeButton.vue';
export default {
    props: {
        title: String,
        owner: String,
        floor: Number,
        seat: Number,
        type: String,
        price: Number,
        bookDate: Date,
        startDate: Date,
        duration: String,
        totalPrice: Number,
        status: String,
        address: String,
        description: String,
        img: String,
        startTime: String,
        endTime: String,
        enablePay: {
            type: Boolean,
            default: false
        }
    },
    components: { PictureFrame, ThemeButton },
    computed: {
        pay_style: function(){
            return {
                "color": this.status == "Unpaid" ? "var(--theme_brown)" : "var(--theme_jade)",
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
    .row {
        display: flex;
        flex-direction: row;
    }
    .center_row {
        justify-content: center;
    }
    .col {
        display: flex;
        flex-direction: column;
    }
    .half_col {
        width: 50%;
    }
    .half_col_left {
        width: 40%;
    }
    .half_col_right {
        width: 60%;
    }
    .image-box {
        width: 100%;
        height: 30vw;
        max-height: 400px;
        padding-right: 10px;
    }
    .title_font {
        font-size: 22px;
    }
    .font {
        font-size: 16px;
    }
    .line {
        line-height: 2.5;
    }
    .bold {
        font-weight: bold;
    }
    .black {
        color: var(--theme_black);
    }
    .jade {
        color: var(--theme_jade);
    }
    .full {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: row;
    }
    .overflow {
        overflow: auto;
    }
    @media only screen and (max-width: 1000px) {
        .font {
            font-size: 14px;
        }
    }
    @media only screen and (max-width: 768px) {
        .half_col_left {
            width: 100%;
        }
        .half_col_right {
            width: 100%;
        }
        .full {
            flex-direction: column;
        }
        .image-box {
            height: 60vw;
        }
    }
    @media only screen and (max-width: 450px) {
        .half_col {
            width: 100%;
        }
        .row {
            flex-wrap: wrap;
        }
    }
</style>