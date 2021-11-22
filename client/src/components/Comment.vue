<template>
    <div class="row">
        <div class="image" :style="img_style"></div>
        <div class="col grow">
            <div class="row baseline">
                <div class="large font bold">{{name}}</div>
                <div class="grow"></div>
                <div class="small font">{{((date) => {
                    var year = date.getFullYear();

                    var month = (1 + date.getMonth()).toString();
                    month = month.length > 1 ? month : '0' + month;

                    var day = date.getDate().toString();
                    day = day.length > 1 ? day : '0' + day;
                    
                    return month + '/' + day + '/' + year;
                })(time)}}</div>
                <div v-if="this.deletable" class="medium font close bold baseline row">
                    <span class="material-icons close-icon" v-on:click="executeDelete">
                        close
                    </span>
                </div>
            </div>
            <div class="medium font stretch">{{content}}</div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    props: {
        name: String,
        time: Date,
        content: String,
        img: String,
        deletable: Boolean
    },
    computed: {
        img_style: function(){
            return {
                "background-image": "url(" + (this.img ? this.img : 'https://i.9mobi.vn/cf/images/2015/03/nkk/nhung-hinh-anh-dep-19.jpg') + ")"
            }
        }
    },
    methods: {
        convertDate: function(day) {
            return moment(String(day)).format('DD-MM-YYYY');
        },
        executeDelete: function() {
            this.$emit('onDelete');
        }
    }
}
</script>

<style scoped>
    .row {
        display: flex;
        flex-direction: row;
    }
    .baseline {
        align-items: center;
    }
    .col {
        display: flex;
        flex-direction: column;
    }
    .full_width {
        width: 100%;
    }
    .grow {
        flex-grow: 1;
    }
    .stretch {
        flex-basis: 100%;
    }
    .image {
        height: 74px;
        width: 74px;
        min-width: 74px;
        border-radius: 40px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        margin-right: 15px;
    }
    .large {
        font-size: 18px;
    }
    .small {
        font-size: 8px;
    }
    .medium {
        font-size: 14px;
    }
    .bold {
        font-weight: bold;
    }
    .font {
        color: var(--theme_black);
        line-height: 1.5;
    }
    .close {
        margin-left: 20px;
    }
    .close-icon {
        font-size: 18px;
        cursor: pointer;
    }
</style>