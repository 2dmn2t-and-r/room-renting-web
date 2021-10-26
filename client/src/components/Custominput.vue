<template>
    <label>
        <div>{{label}}</div>
        <input :type="type" v-model="inputValue">
    </label>
</template>
<script>
export default {
    props: ['label', 'type' ,'modelValue'],
    computed: {
        inputValue: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', value)
            }
        }
    },
    data() {
        return {
            
        }
    },
}
</script>
<style scoped>
@import url(https://fonts.googleapis.com/css?family=Open+Sans);
div {
    color: #212121;
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 30px;
    padding: 2.5% 1.5%;
}
input {
    background-color: #F8F8F8;
    border-radius: 20px 0px;
    position: relative;
    width: 80%;
    height: 50px;
    left: 10%;
    border: none;
}
</style>