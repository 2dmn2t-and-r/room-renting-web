<template>
    <div class="comment-box">
        <div class="comment-container">
            <div v-for="(comment, index) in comments" :key="index">
                <comment
                    v-bind="{
                        name: comment['username'],
                        time: new Date(comment['date']),
                        content: comment['content'],
                        img: comment['avatar'],
                        deletable: manager || userId === comment['userId'],
                    }"
                    @onDelete="() => {
                        onDelete(index)
                    }"
                />
                <div class="divider"></div>
            </div>
        </div>
        <theme-input
            class="input-box"
            type="text"
            :value.sync="input_value"
            v-bind="{
                isInputBgWhite: true,
                disable: !manager && userId === '',
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
        comments: Array,
        newComment: {
            type: String,
            default: "",
        },
        manager: {
            type: Boolean,
            default: false,
        },
        userId: {
            type: String,
            default: "",
        }
    },
    components: {
        Comment,
        ThemeButton,
        ThemeInput
    },
    computed: {
        input_value: {
            get() {
                return this.newComment
            },
            set(value) {
                this.$emit('update:newComment', value)
            }
        },
    },
    methods: {
        onDelete: function(index) {
            this.$emit('onDelete', index);
        }
    }
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