<template>
    <div class="full center_all">
        <div class="col center_all">
            <div class="bold title_font jade">Successful!</div>
            <div style="min-height: 20px;"> </div>
            <img src="../../../assets/icon/success.png" alt="Success"/>
        </div>
    </div> 
</template>

<script>
import PictureFrame from '../../PictureFrame.vue'
import DescriptionCommentBox from '../reserve/DescriptionCommentBox.vue';
import ThemeInput from '../../ThemeInput.vue';
export default {
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
        font-size: 30px;
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
    @media only screen and (max-width: 600px) {

    }
</style>