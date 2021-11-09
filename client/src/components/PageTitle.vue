<template>
    <div class="page-title">
        {{title}}
        <div class="line"></div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: "",
        }
    },
}
</script>
<style scoped>
    .page-title {
        width: 100%;
        height: 52px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        color: var(--theme_black);
        font-size: 38px;
        line-height: 38px;
        font-weight: 600;
        margin-bottom: 40px;
    }

    .line {
        height: 2px;
        width: 120px;
        background-color: var(--theme_fore);
    }
</style>