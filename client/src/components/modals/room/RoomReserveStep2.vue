<template>
    <div class="full">
        <div class="title_font bold line black">Timeline: {{ convertDate(chosenDate) }}</div> 
        <choosetime v-bind="{
            inleft: timeStartToIndex,
            inright: timeEndToIndex,
            availableIndex: availableIndex()
        }" @leftTime="chosenStartInput = $event" @rightTime="chosenEndInput = $event"/>
        <div class="font black line row"> 
            <div class="half_col row">
                <div> Open:</div>
                <theme-select v-bind="{
                    values: timeRange(true),
                }" :value.sync="chosenStartInput"/>
            </div>
            <div style="min-width: 20px;"> </div>
            <div class="half_col row">
                <div> Close:</div>
                <theme-select v-bind="{
                    values: timeRange(false)
                }" :value.sync="chosenEndInput"/>
            </div>
        </div>
        <div class="font black line">
            Price: <span class="bold">{{ price }}.000 VND</span>
        </div>
        <div class="font black line">
            Total price: <span class="jade bold">{{ totalPrice }}.000 VND</span>
        </div>
    </div>
</template>

<script>
import PictureFrame from '../../PictureFrame.vue'
import DescriptionCommentBox from '../reserve/DescriptionCommentBox.vue';
import ThemeInput from '../../ThemeInput.vue';
import Choosetime from './Choosetime.vue';
import ThemeSelect from '../../ThemeSelect.vue';
export default {
    components: { PictureFrame, DescriptionCommentBox, ThemeInput,
        Choosetime,
        ThemeSelect },
    props: {
        chosenDate: Date,
        price: Number,
        totalPrice: Number,
        startDate: {
            type: String,
            default: '6:00'
        },
        endDate: {
            type: String,
            default: '18:00'
        },
        availableTime: {
            type: Array,
            default: []
        },
        chosenStartTime: {
            type: String,
            default: '6:00'
        },
        chosenEndTime: {
            type: String,
            default: '6:30'
        }
    },
    computed: {
        pay_style: function(){
            return {
                "color": this.status == "Unpaid" ? "var(--theme_brown)" : "var(--theme_jade)",
            }
        },
        chosenStartInput: {
            get() {
                return this.chosenStartTime
            },
            set(value) {
                this.$emit('update:chosenStartTime', value)
            }
        },
        chosenEndInput: {
            get() {
                return this.chosenEndTime
            },
            set(value) {
                this.$emit('update:chosenEndTime', value)
            }
        },
        timeStartToIndex: function() {
            var res = this.startDate.split(':');
            return (parseInt(res[0]) - 6) * 2 + Math.round(parseInt(res[1]) / 30);
        },
        timeEndToIndex: function() {
            var res = this.endDate.split(':');
            return (parseInt(res[0]) - 6) * 2 + Math.round(parseInt(res[1]) / 30) - 1;
        },
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
        timeRange: function(start = true) {
            var res = [];
            var tempS = this.startDate.split(':');
            var tempE = this.endDate.split(':');
            tempS[0] = parseInt(tempS[0]);
            tempS[1] = parseInt(tempS[1]);
            var intS = tempS[0] * 100 + tempS[1];
            tempE[0] = parseInt(tempE[0]);
            tempE[1] = parseInt(tempE[1]);
            var intE = tempE[0] * 100 + tempE[1];
            for (var i = 6; i < 22; i++) {
                if (start) {
                    if (i * 100 >= intS && i * 100 < intE)
                        res.push(`${i}:00`);
                    if (i * 100 + 30 >= intS && i * 100 + 30 < intE)
                        res.push(`${i}:30`);
                }
                else {
                    if (i * 100 + 30 > intS && i * 100 + 30 <= intE)
                        res.push(`${i}:30`);
                    if ((i + 1) * 100 > intS && (i + 1) * 100 <= intE)
                        res.push(`${i + 1}:00`);
                }
            }
            return res;
        },
        availableIndex: function() {
            let res = [];
            for (var i = 0; i < this.availableTime.length; i++) {
                var sp = this.availableTime[i].timeframe.split(':');
                res.push((parseInt(sp[0]) - 6) * 2 + Math.round(parseInt(sp[1]) / 30));
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
    .center_all {
        align-items: center;
        justify-content: center;
    }
    .col.center_all > img {
        display: block;
        max-width: 150px;
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
        max-height: 350px;
        padding-right: 10px;
    }
    .title_font {
        font-size: 22px;
    }
    .font {
        font-size: 18px;
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
        flex-direction: column;
    }
    .overflow {
        overflow: auto;
    }
    @media only screen and (max-width: 500px) {
        .half_col {
            width: 100%;
        }
        .row {
            flex-wrap: wrap;
        }
    }
</style>