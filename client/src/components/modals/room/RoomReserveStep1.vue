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
            <div style="min-width: 30px; min-height: 20px;"> </div>
            <div class="row">
                <div class="font black line">Date: </div>
                <div style="min-width: 10px; min-height: 10px;"> </div>
                <theme-input :type="'date'"/>
            </div>
        </div>
        <div style="min-width: 30px; min-height: 20px;"> </div>
        <div class="half_col_right col">
            <description-comment-box v-bind="{
                floor: this.floor,
                seat: this.seat,
                status: this.status,
                type: this.type,
                address: this.address,
                description: this.description,
                comments: this.comments
            }"/>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
import PictureFrame from '../../PictureFrame.vue'
import DescriptionCommentBox from '../reserve/DescriptionCommentBox.vue';
import ThemeInput from '../../ThemeInput.vue';
export default {
    props: {
        floor: Number,
        seat: Number,
        status: String,
        type: String,
        address: String,
        description: String,
        comments: Array // {name: string, time: date, content: string, img: string url}
    },
    components: { PictureFrame, DescriptionCommentBox, ThemeInput },
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
        max-height: 350px;
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