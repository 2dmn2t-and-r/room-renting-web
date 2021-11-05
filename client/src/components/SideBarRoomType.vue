<template>
    <div class="outer">
        <div v-for="(type, index) in types" :key="index">
            <div v-if="chosen_index == index" class="text_class text_chosen large_padding">
                <div class="chosen"></div>{{type}}
            </div>
            <div v-else class="text_class text_normal large_padding" v-on:click="change_chosen_index(index)">
                {{type}}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            chosen_index: 0
        }
    },
    props: {
        types: Array
    },
    methods: {
        change_chosen_index: function(index) {
            this.chosen_index = index;
        }
    }
}
</script>

<style scoped>
    .text_class {
        font-size: 24px;
        line-height: 2.5;
    }
    .text_normal {
        color: var(--theme_black);
    }
    .text_normal:hover {
        color: var(--theme_jade);
    }
    .text_chosen {
        color: var(--theme_jade);
    }
    .large_padding {
        padding-left: 20px;
        position: relative;
    }
    .chosen {
        width: 5px;
        border-radius: 2.5px;
        height: 60px;
        background-color: var(--theme_jade);
        position: absolute;
        top: 0px;
        left: 0px;
    }
    @media only screen and (max-width: 768px) {
        .large_padding {
            padding-left: 0px;
        }
        .chosen {
            width: 100%;
            border-radius: 2.5px;
            height: 5px;
            background-color: var(--theme_jade);
            top: auto;
            bottom: 0px;
        }
        .outer {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }
    }
</style>