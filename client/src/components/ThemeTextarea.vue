<template>
    <div class="theme-textarea">
        <div class="label">{{label}}</div>
        <div class="input-container">
            <textarea class="box" :style="input_style" v-model="input_value" :disabled="disable"/>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        label: String,          // Optional
        value: String,          // Optional
        height: {
            type: String,
            default: "40px",
        },
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
                "width": "100%",
                "border-radius": "15px 0px 15px 0px",
                "background-color": this.isInputBgWhite ? "var(--theme_white)" : "var(--theme_fore)",
                "box-shadow": this.isInputBgWhite ? "0 1px 2px 0px rgba(17, 17, 17, 0.1)" : "none",
                "height": this.height,
            };
        },
    },
}
</script>
<style scoped>
    .theme-textarea {
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
        border: none;
        outline: none;
        padding: 4px 8px;
        resize: none;
    }

    .input-container {
        width: 100%;
        display: flex;
        align-items: center;
    }

    .box:focus {
        outline-width: 2px;
        outline-style: solid;
        outline-color: var(--theme_jade);
    }
</style>