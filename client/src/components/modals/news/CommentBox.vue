<template>
    <div class="comment-box">
        <div class="comment-container">
            <div v-for="(comment, index) in comments" :key="index">
                <comment
                    v-bind="{
                        name: comment['name'],
                        time: comment['time'],
                        content: comment['content'],
                        img: comment['img']
                    }"
                />
                <div class="divider"></div>
            </div>
        </div>
        <theme-input
            class="input-box"
            type="text"
            value=""
            v-bind="{
                isInputBgWhite: true
            }"
        />
    </div>
</template>

<script>
import Comment from '../../Comment.vue'
import ThemeButton from '../../ThemeButton.vue';
import ThemeInput from '../../ThemeInput.vue';
export default {
    props: {
        comments: Array // {name: string, time: date, content: string, img: string url}
    },
    components: {
        Comment,
        ThemeButton,
        ThemeInput
    },
    
}
</script>

<style scoped>
    .comment-box {
        width: 100%;
        height: 100%;
        background-color: var(--theme_fore);
        padding: 20px 40px 20px 40px;
        border-radius: 10px;
    }

    .comment-container {
        height: calc(100% - 50px);
        overflow-y: overlay;
        margin-bottom: 10px;
    }

    .divider {
        margin-top: 20px;
    }
</style>