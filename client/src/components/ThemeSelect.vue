<template>
    <div class="theme-input">
        <div class="label">{{label}}</div>
        <div class="input-container">
            <select class="box" :style="input_style" v-model="input_value">
                <option v-for="val in values" :key="val" :value="val">{{ val }}</option>
            </select>
        </div>
    </div>
</template>
<script>

export default {
    props: {
        label: String,          // Optional
        values: Array 
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
                "box-shadow": this.isInputBgWhite ? "0 1px 2px 0px rgba(17, 17, 17, 0.1)" : "none"
            };
        },
    },
    data() {
        return {
            
        }
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