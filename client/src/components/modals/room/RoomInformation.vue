<template>
    <div class="full overflow">
        <div class="half_col_left">
            <div class="image-box">
                <picture-frame v-bind="{
                    width: '100%',
                    height: '100%',
                    width_img: 'calc(100% - 20px)',
                    height_img: 'calc(100% - 20px)'
                }"/>
            </div>
        </div>
        <div style="min-width: 30px"> </div>
        <div class="half_col_right col">
            <div class="font black line row">
                <div class="half_col">
                    <div> Room name:</div>
                    <theme-input v-bind="{
                        type: 'input',
                        value: this.roomName
                    }"/>
                </div>
                <div style="min-width: 10px;"> </div>
                <div class="half_col">
                    <div> Room type:</div>
                    <theme-input v-bind="{
                        type: 'input',
                        value: this.roomType
                    }"/>
                </div>
            </div>
            <div class="font black line row">
                <div class="half_col">
                    <div> Floor:</div>
                    <theme-input v-bind="{
                        type: 'number',
                        value: this.floor
                    }"/>
                </div>
                <div style="min-width: 10px;"> </div>
                <div class="half_col">
                    <div> Seat:</div>
                    <theme-input v-bind="{
                        type: 'number',
                        value: this.seat
                    }"/>
                </div>
            </div>
            <div class="font black line row">
                <div class="half_col">
                    <div> Status:</div>
                    <theme-select v-bind="{
                        values: ['Available', 'Unavailable']
                    }"/>
                </div>
                <div style="min-width: 10px;"> </div>
                <div class="half_col">
                    <div> Price per 30 mins:</div>
                    <theme-input v-bind="{
                        type: 'number',
                        value: this.price
                    }"/>
                </div>
            </div>
            <div class="font black line row">
                <div class="half_col">
                    <div> Open:</div>
                    <theme-select v-bind="{
                        values: timeRange(true)
                    }"/>
                </div>
                <div style="min-width: 10px;"> </div>
                <div class="half_col">
                    <div> Close:</div>
                    <theme-select v-bind="{
                        values: timeRange(false)
                    }"/>
                </div>
            </div>
            <div class="font black line row">
                <div class="col" style="width: 100%;">
                    <div> Address:</div>
                    <theme-input v-bind="{
                        type: 'input',
                        value: this.address
                    }"/>
                </div>
            </div>
            <div class="font black line row">
                <div class="col" style="width: 100%;">
                    <div> Description:</div>
                    <theme-input v-bind="{
                        type: 'input',
                        value: this.description
                    }"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
import PictureFrame from '../../PictureFrame.vue'
import ThemeInput from '../../ThemeInput.vue';
import ThemeSelect from '../../ThemeSelect.vue';
export default {
    props: {
        roomName: String,
        roomType: String,
        floor: Number,
        seat: Number,
        status: String,
        price: Number,
        openTime: String,
        closeTime: String,
        address: String,
        description: String
    },
    components: { PictureFrame, ThemeInput, ThemeSelect },
    computed: {
        pay_style: function(){
            return {
                "color": this.status == "Unpaid" ? "var(--theme_brown)" : "var(--theme_jade)",
            }
        }
    },
    methods: {
        convertDate: function(day) {
            return moment(String(day)).format('DD/MM/YYYY');
        },
        timeRange: function(start = true) {
            var res = [];
            for (var i = 6; i < 22; i++) {
                if (start) {
                    res.push(`${i}:00`);
                    res.push(`${i}:30`);
                }
                else {
                    res.push(`${i}:30`);
                    res.push(`${i + 1}:00`);
                }
            }
            return res;
        }
    }
}
</script>

<style scoped>
    .row {
        display: flex;
        flex-direction: row;
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