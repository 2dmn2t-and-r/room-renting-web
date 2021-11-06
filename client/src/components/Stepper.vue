<template>
    <div class="stepper">
        <div class="step-num" :style="step_1">1</div>
        <div class="step-line" :style="line_1"></div>
        <div class="step-num" :style="step_2">2</div>
        <div class="step-line" :style="line_2"></div>
        <div class="step-num" :style="step_3">3</div>
    </div>
</template>

<script>
import { palette } from "@/constants/constants.js"
export default {
    name: 'Stepper',
    props: {
        step: Number,
    },
    computed: {
        step_1: function(){
            return {
                "display": (this.step !== undefined) ? (this.step <= 0 ? "none": "flex") : "flex",
                "background-color": this.step ? ((this.step >= 1) ? palette[0] : palette[1]) : palette[1],
            }
        },
        line_1: function(){
            return {
                "display": (this.step !== undefined) ? (this.step <= 0 ? "none": "flex") : "flex",
                "background-color": this.step ? ((this.step > 1) ? palette[0] : palette[1]) : palette[1],
            }
        },
        step_2: function(){
            return {
                "display": (this.step !== undefined) ? (this.step <= 0 ? "none": "flex") : "flex",
                "background-color": this.step ? ((this.step >= 2) ? palette[0] : palette[1]) : palette[1],
            }
        },
        line_2: function(){
            return {
                "display": (this.step !== undefined) ? (this.step <= 0 ? "none": "flex") : "flex",
                "background-color": this.step ? ((this.step > 2) ? palette[0] : palette[1]) : palette[1],
            }
        },
        step_3: function(){
            return {
                "display": (this.step !== undefined) ? (this.step <= 0 ? "none": "flex") : "flex",
                "background-color": this.step ? ((this.step >= 3) ? palette[0] : palette[1]) : palette[1],
            }
        },
    }
}
</script>

<style scoped>
    .step-num {
        width: 26px;
        height: 26px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        color: var(--theme_white);
        font-size: 12px;
        font-weight: 500;
    }

    .step-line {
        width: 25px;
        height: 1px;
    }
    
    .stepper {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
        margin-bottom: 20px;
        height: 26px;
    }
</style>