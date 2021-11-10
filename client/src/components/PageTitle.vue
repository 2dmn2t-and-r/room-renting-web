<template>
    <div class="page-title">
        <div class="icon-bt">
            <theme-icon-button :style="iconButton" icon="arrow_back"/>
        </div>
        <div class="container">
            {{title}}
            <div class="line"></div>
        </div>
        <div class="icon-bt"></div>
    </div>
</template>

<script>
import ThemeIconButton from './ThemeIconButton.vue'
export default {
  components: { ThemeIconButton },
    props: {
        title: {
            type: String,
            default: "",
        },
        isBack: {
            type: Boolean,
            default: false,
        }
    },
    computed: {
        iconButton: function() {
            return {
                "display": this.isBack ? "inline": "none",
            }
        }
    }
}
</script>
<style scoped>
    .page-title {
        width: 100%;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 40px;
    }

    .container {
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        color: var(--theme_black);
        font-size: 38px;
        line-height: 38px;
        font-weight: 600;
    }

    .line {
        height: 2px;
        width: 120px;
        background-color: var(--theme_fore);
    }

    .icon-bt {
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
    }
</style>