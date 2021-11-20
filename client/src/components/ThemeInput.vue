<template>
    <div class="theme-input">
        <div class="label">{{label}}</div>
        <div class="input-container">
            <input class="box" :style="input_style" @change="onFileChange" :type="type" v-model="input_value" :disabled="disable" :placeholder="this.placeholder"/>
            <div :style="button_style" class="button" @click="onClickButton">
                {{title}}
                <md-icon :style="icon_style">
                    {{icon}}
                </md-icon>
            </div>
        </div>
    </div>
</template>
<script>
import {palette} from "@/constants/constants.js"

export default {
    props: {
        type: String,
        label: String,          // Optional
        value: String | Number,          // Optional
        placeholder: String,    // Optional
        buttonTitle: { 
            type: String,
            default: "",
        },                      // Optional
        buttonWidth: {
            type: String,
            default: "50px",
        },                      // Optional
        isIconTitle: {
            type: Boolean,
            default: false,
        },                      // Optional
        isInputBgWhite: {
            type: Boolean,
            default: false
        },                      // Optional
        disable: {
            type: Boolean,
            default: false
        }                       // Optional
    },
    computed: {
        input_value: {
            get() {
                return this.value
            },
            set(value) {
                this.$emit('update:value', value)
            }
        },
        input_style: function() {
            return {
                "width": (this.buttonTitle === "") ? "100%" : "calc(100% - " + this.buttonWidth + ")",
                "border-radius": (this.buttonTitle === "") ? "15px 0px 15px 0px" : "15px 0px 0px 0px",
                "background-color": this.isInputBgWhite ? "var(--theme_white)" : "var(--theme_fore)",
                "box-shadow": this.isInputBgWhite ? "0 1px 2px 0px rgba(17, 17, 17, 0.1)" : "none"
            };
        },
        button_style: function() {
            return {
                "width": this.buttonWidth,
                "border-radius": "0px 0px 15px 0px",
                "background-color": palette[0],
                "height": "40px",
                "display": (this.buttonTitle === "") ? "none" : " flex",
                "justify-content": "center",
                "align-items": "center",
                "color": palette[3],
                "font-size": "16px",
                "font-weight": "600",
            };
        },
        icon_style: function() {
            return {
                "display": this.isIconTitle ? "inline" : "none",
                "color": palette[3],
            }
        }
    },
    data() {
        return {
            title: this.isIconTitle ? "" :  this.buttonTitle,
            icon: !this.isIconTitle ? "" :  this.buttonTitle,
        }
    },
    methods: {
        onClickButton() {
            this.$emit('onClickButton')
        },
        onFileChange(e) {
            if (this.type == 'file') {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                return;
                this.$emit('onFileChange', files[0]);
            }
        },
    }
}
</script>
<style scoped>
    .theme-input {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .label {
        color: #212121;
        font-family: 'OpenSans';
        font-weight: 300;
        font-size: 14px;
        line-height: 20px;
    }

    .box {
        font-size: 16px;
        border-radius: 15px 0px;
        font-weight: 600;
        height: 40px;
        border: none;
        outline: none;
        padding: 0px 8px;
    }

    .box:focus {
        outline-width: 2px;
        outline-style: solid;
        outline-color: var(--theme_jade);
    }

    .input-container {
        width: 100%;
        display: flex;
        align-items: center;
    }

    .box:focus ~ .button {
        outline-width: 2px;
        outline-style: solid;
        outline-color: var(--theme_jade);
    }

    .button:hover {
        cursor: pointer;
        opacity: 0.9;
    }

    .button:active {
        opacity: 0.8;
    }
</style>