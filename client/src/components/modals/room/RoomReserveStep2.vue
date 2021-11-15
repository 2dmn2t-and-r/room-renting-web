<template>
    <div class="full">
        <div class="title_font bold line black">Timeline: {{ convertDate(chosenDate) }}</div>
        <choosetime v-bind="{
            left: timeStartToIndex(),
            right: timeEndToIndex()
        }" @leftTime="startDate = $event" @rightTime="endDate = $event"/>
        <div class="font black line row">
            <div class="half_col row">
                <div> Open:</div>
                <theme-select v-bind="{
                    values: timeRange(true),
                }" :value.sync="startDate"/>
            </div>
            <div style="min-width: 20px;"> </div>
            <div class="half_col row">
                <div> Close:</div>
                <theme-select v-bind="{
                    values: timeRange(false)
                }" :value.sync="endDate"/>
            </div>
        </div>
        <div class="font black line">
            Price: <span class="bold">{{ price }}.000 VND</span>
        </div>
        <div class="font black line">
            Total price: <span class="jade bold">{{ price }}.000 VND</span>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
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
        totalPrice: Number
    },
    data() {
        return {
            startDate: '6:00',
            endDate: '6:30'
        }
    },
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
        },
        timeStartToIndex: function() {
            var res = this.startDate.split(':');
            return (parseInt(res[0]) - 6) * 2 + Math.round(parseInt(res[1]) / 30);
        },
        timeEndToIndex: function() {
            var res = this.endDate.split(':');
            return (parseInt(res[0]) - 6) * 2 + Math.round(parseInt(res[1]) / 30) - 1;
        },
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