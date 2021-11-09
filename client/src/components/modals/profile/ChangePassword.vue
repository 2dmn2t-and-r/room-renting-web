<template>
    <div class="change-password">
        
    </div>
</template>
<script>
import {palette} from "@/constants/constants.js"

export default {
    props: {
        type: String,
        label: String,          // Optional
        value: String,          // Optional
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
                "width": (this.buttonTitle == "") ? "100%" : "calc(100% - " + this.buttonWidth + ")",
                "border-radius": "15px 0px 0px 0px",
                "background-color": this.isInputBgWhite ? "var(--theme_white)" : "var(--theme_fore)"
            };
        },
        button_style: function() {
            return {
                "width": this.buttonWidth,
                "border-radius": "0px 0px 15px 0px",
                "background-color": palette[0],
                "height": "40px",
                "display": (this.buttonTitle == "") ? "none" : " flex",
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
    }
}
</script>
<style scoped>
    .theme-input {
        width:100%
    }

    .label {
        color: #212121;
        font-family: 'Open Sans';
        font-weight: 300;
        font-size: 14px;
        line-height: 20px;
    }

    .input {
        font-size: 16px;
        /* background-color: var(--theme_fore); */
        border-radius: 15px 0px;
        font-weight: 600;
        height: 40px;
        border: none;
        outline: none;
        padding-left: 8px;
    }

    .input:focus {
        outline-width: 2px;
        outline-style: solid;
        outline-color: var(--theme_jade);
    }

    .input-container {
        width: 100%;
        display: flex;
        align-items: center;
    }

    .input:focus ~ .button {
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