<template>
    <div class="row center_all">
        <md-button class="md-icon-button not_chosen" v-if="leftPage >= 1" @click="$emit('update:curPage', curPage - 1);">&lt;</md-button>
        <md-button class="md-icon-button disabled" v-if="leftPage < 1">&lt;</md-button>
        <div v-if="leftPage > 1">. . .</div>
        <md-button class="md-icon-button not_chosen" v-if="leftPage >= 1" @click="$emit('update:curPage', curPage - 1);">{{ leftPage }}</md-button>
        <md-button class="md-icon-button chosen">{{ curPage }}</md-button>
        <md-button class="md-icon-button not_chosen" v-if="rightPage <= numPage" @click="$emit('update:curPage', curPage + 1);"> {{ rightPage }}</md-button>
        <div v-if="rightPage < numPage">. . .</div>
        <md-button class="md-icon-button not_chosen" v-if="rightPage <= numPage" @click="$emit('update:curPage', curPage + 1);">&gt;</md-button>
        <md-button class="md-icon-button disabled" v-if="rightPage > numPage">&gt;</md-button>
    </div>
</template>

<script>
export default {
    props: {
        totalItem: { // Total number of items
            type: Number,
            default: 1
        },
        pageItem: { // Number of item on a page
            type: Number,
            default: 1
        },
        curPage: { // Current page
            type: Number,
            default: 1
        }
    },
    computed: {
        numPage() {
            if (this.totalItem == 0) return 1;
            if (this.totalItem % this.pageItem == 0) {
                return this.totalItem / this.pageItem;
            }
            else {
                return Math.floor(this.totalItem / this.pageItem) + 1;
            }
        },
        leftPage() {
            return this.curPage - 1;
        },
        rightPage() {
            return this.curPage + 1;
        }
    },
    mounted() {
        if (this.curPage > this.numPage) {
            this.$emit('update:curPage', this.numPage);
        }
    }
}
</script>

<style scoped>
    .row {
        display: flex;
        flex-direction: row;
    }
    .center_all {
        justify-content: center;
        justify-items: baseline;
        align-items: center;
    }
    .md-icon-button.chosen {
        background-color: var(--theme_jade);
        color: var(--theme_white);
    }
    .not_chosen {
        background-color: var(--theme_fore);
        color: var(--theme_black);
    }
    .not_chosen:hover {
        background-color: var(--theme_jade);
        color: var(--theme_white);
    }
    .md-icon-button.disabled {
        background-color: var(--theme_fore);
        color: var(--theme_white);
    }
</style>