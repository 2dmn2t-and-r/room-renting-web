<template>
    <div class="full overflow">
        <div class="half_col_left">
            <div class="image-box">
                <picture-frame v-bind="{
                    width: '100%',
                    height: '100%',
                    width_img: 'calc(100% - 20px)',
                    height_img: 'calc(100% - 20px)',
                    background_img: this.img,
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
                    }" :value.sync="inputRoomName"/>
                </div>
                <div style="min-width: 10px;"> </div>
                <div class="half_col">
                    <div> Room type:</div>
                    <theme-select v-bind="{
                        values: types
                    }" :value.sync="inputRoomType"/>
                </div>
            </div>
            <div class="font black line row">
                <div class="half_col">
                    <div> Floor:</div>
                    <theme-input v-bind="{
                        type: 'number',
                    }" :value.sync="inputFloor"/>
                </div>
                <div style="min-width: 10px;"> </div>
                <div class="half_col">
                    <div> Seat:</div>
                    <theme-input v-bind="{
                        type: 'number',
                    }" :value.sync="inputSeat"/>
                </div>
            </div>
            <div class="font black line row">
                <div class="half_col">
                    <div> Status:</div>
                    <theme-select v-bind="{
                        values: ['Available', 'Unavailable']
                    }" :value.sync="inputStatus"/>
                </div>
                <div style="min-width: 10px;"> </div>
                <div class="half_col">
                    <div> Price per 30 mins:</div>
                    <theme-input v-bind="{
                        type: 'number',
                    }" :value.sync="inputPrice"/>
                </div>
            </div>
            <div class="font black line row">
                <div class="half_col">
                    <div> Open:</div>
                    <theme-select v-bind="{
                        values: timeRange(true)
                    }" :value.sync="inputOpenTime"/>
                </div>
                <div style="min-width: 10px;"> </div>
                <div class="half_col">
                    <div> Close:</div>
                    <theme-select v-bind="{
                        values: timeRange(false)
                    }" :value.sync="inputCloseTime"/>
                </div>
            </div>
            <div class="font black line row">
                <div class="col" style="width: 100%;">
                    <div> Address:</div>
                    <theme-input v-bind="{
                        type: 'input',
                    }" :value.sync="inputAddress"/>
                </div>
            </div>

            <div class="font black line row">
                <div class="col" style="width: 100%;">
                    <div> Image:</div>
                    <theme-input v-bind="{
                        type: 'file'
                    }" @onFileChange="changeImage"/>
                </div>
            </div>

            <div class="font black line row">
                <div class="col" style="width: 100%;">
                    <div> Description:</div>
                    <theme-input v-bind="{
                        type: 'input',
                    }" :value.sync="inputDescription"/>
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
import { uploadImage } from '../../../utils/uploadImage';

export default {
    props: {
        img: String,
        roomName: String,
        roomType: String,
        floor: Number,
        seat: Number,
        status: String,
        price: Number,
        openTime: String,
        closeTime: String,
        address: String,
        description: String,
        types: Array
    },
    components: { PictureFrame, ThemeInput, ThemeSelect },
    computed: {
        pay_style: function(){
            return {
                "color": this.status == "Unpaid" ? "var(--theme_brown)" : "var(--theme_jade)",
            }
        },
        inputImg: { get() { return this.img }, set(value) { this.$emit('update:img', value) } },
        inputRoomName: { get() { return this.roomName }, set(value) { this.$emit('update:roomName', value) } },
        inputRoomType: { get() { return this.roomType }, set(value) { this.$emit('update:roomType', value) } },
        inputFloor: { get() { return this.floor }, set(value) { this.$emit('update:floor', parseInt(value)) } },
        inputSeat: { get() { return this.seat }, set(value) { this.$emit('update:seat', parseInt(value)) } },
        inputStatus: { get() { return this.status }, set(value) { this.$emit('update:status', value) } },
        inputPrice: { get() { return this.price }, set(value) { this.$emit('update:price', parseInt(value)) } },
        inputOpenTime: { get() { return this.openTime }, set(value) { this.$emit('update:openTime', value) } },
        inputCloseTime: { get() { return this.closeTime }, set(value) { this.$emit('update:closeTime', value) } },
        inputAddress: { get() { return this.address }, set(value) { this.$emit('update:address', value) } },
        inputDescription: { get() { return this.description }, set(value) { this.$emit('update:description', value) } },
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
        },
        changeImage: function(file) {
            uploadImage(file, `${this.roomType}${this.floor.toString()}${this.seat.toString()}`, (value) => {
                this.inputImg = value;
            });
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