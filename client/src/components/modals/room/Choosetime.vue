<template>
    <div class="col">
        <div class="big row font black space_between">
            <div>06:00</div>
            <div>10:00</div>
            <div>14:00</div>
        </div>
        <div class="small row font black space_between">
            <div>06:00</div>
            <div>08:00</div>
            <div>10:00</div>
        </div>
        <div class="row inner">
            <div class="cell" v-for="(item, index) in status" :key="index + whole + left + right" v-bind:style="{
                'background-color': ((status[index] == -1) ? 'var(--theme_gray)' : ((index >= left && index <= right) ? 'var(--theme_jade)' : 'var(--theme_white)'))
            }" v-on:click="changeColor(index)"> </div>
        </div>
        <div class="big row font black space_between">
            <div>14:00</div>
            <div>18:00</div>
            <div>22:00</div>
        </div>
        <div class="small row font black space_between">
            <div>18:00</div>
            <div>20:00</div>
            <div>22:00</div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        inleft: {
            type: Number,
            default: 0
        },
        inright: {
            type: Number,
            default: 0
        },
        availableIndex: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            left: this.inleft,
            right: this.inleft,
            whole: 0,
            pre: -1,
            prepre: -1,
            leftTime: Array.from({length: 32}, (_, index) => `${Math.floor((12 + index) / 2)}:${((12 + index) % 2 == 0) ? '00' : '30'}`),
            rightTime: Array.from({length: 32}, (_, index) => `${Math.floor((13 + index) / 2)}:${((13 + index) % 2 == 0) ? '00' : '30'}`),
            status: (() => {
                let res = Array.from({length: 32}, (_, index) => -1); // -1 disabled, 0 empty, 1 chosen
                for (var i = 0; i < this.availableIndex.length; i++) {
                    if (this.availableIndex[i] >= this.inleft && this.availableIndex[i] <= this.inright) {
                        res[this.availableIndex[i]] = 0;
                    }
                }
                return res;
            })() 
            
        }
    },
    methods: {
        changeColor: function(index) {
            this.whole++;
            if (this.status[index] != -1) {
                if (this.pre == -1) {
                    this.pre = index;
                    this.status[index] = 1;
                    this.left = index;
                    this.right = index;
                }
                else {
                    var a = Math.min(index, this.pre);
                    var b = Math.max(index, this.pre);
                    this.pre = index;
                    this.left = a;
                    this.right = b;
                    for (var i = 0; i < 32; i++) {
                        if (this.status[i] != -1) this.status[i] = 0;
                    }
                    for (var i = a; i <= b; i++) {
                        if (this.status[i] != -1) this.status[i] = 1;
                    }
                }
                this.$emit('leftTime', this.leftTime[this.left]);
                this.$emit('rightTime', this.rightTime[this.right]);
            } 
        }
    }
}
</script>

<style scoped>
    .row {
        display: flex;
        flex-direction: row;
    }
    .space_between {
        justify-content: space-between;
    }
    .col {
        display: flex;
        flex-direction: column;
    }
    .inner {
        padding: 2.5px;
        background-color: var(--theme_brown);
        flex-wrap: wrap;
        border-radius: 10px 0px;
    }
    .cell {
        flex-basis: calc(6.25% - 5px);
        /* background-color: var(--theme_white); */
        margin: 2.5px;
        border-radius: 10px 0px;
        height: min(4.5vw, 40px);
    }
    .big {
        display: flex;
    }
    .small {
        display: none;
    }
    @media only screen and (max-width: 500px) {
        .cell {
            flex-basis: calc(12.5% - 5px);
            height: 9vw;
        }
        .big {
            display: none;
        }
        .small {
            display: flex;
        }
    }
    .black {
        color: var(--theme_black);
    }
    .font {
        font-size: 14px;
        line-height: 2.0;
    }
</style>