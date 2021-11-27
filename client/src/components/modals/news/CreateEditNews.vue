<template>
    <div class="create-edit-news">
        <div class="image-box">
            <picture-frame v-bind="{
                width: '100%',
                width_img: '95.83%',
                height: '100%',
                height_img: '95.83%',
                border_radius: '7vw',
            }" :background_img="img"/>
        </div>
        <div class="form-box">
            <theme-textarea v-bind="{
                height: '60px',
                label: 'Title:',
            }"
            :value.sync="title_value"/>
            <div class="divider"></div>
            <theme-textarea v-bind="{
                height: '150px',
                label: 'Content:',
            }"
            :value.sync="content_value"/>
            <div class="checkbox">
                <div class="check-icon" @click="statusChanged()">
                    <md-icon class="icon">{{checked ? "check_box" : "check_box_outline_blank"}}</md-icon>
                </div>
                Public news
            </div>
            <div class="divider"></div>
            <theme-button :msg="'Choose Image'" :background_color="'var(--theme_jade)'" :width="'100%'" @click="$emit('chooseImage')"/>
        </div>
    </div>
</template>

<script>
import Comment from '../../Comment.vue';
import PictureFrame from '../../PictureFrame.vue';
import ThemeButton from '../../ThemeButton.vue';
import ThemeInput from '../../ThemeInput.vue';
import ThemeTextarea from '../../ThemeTextarea.vue';
export default {
    props: {
        comments: Array, // {name: string, time: date, content: string, img: string url}
        checked: {
            type: Boolean,
            default: false,
        },
        title: {
            type: String,
            default: "",
        },
        content: {
            type: String,
            default: "",
        },
        img: {
            type: String,
            default: "",
        }
    },
    components: {
        Comment,
        ThemeButton,
        ThemeInput,
        PictureFrame,
        ThemeTextarea,
    },
    methods: {
        statusChanged() {
            this.$emit('on-check', !this.checked);
        },
    },
    computed: {
        title_value: {
            get() {
                return this.title
            },
            set(value) {
                this.$emit('update:title', value)
            }
        },
        content_value: {
            get() {
                return this.content
            },
            set(value) {
                this.$emit('update:content', value)
            }
        },
    },
}
</script>

<style scoped>
    .create-edit-news {
        width: 100%;
        min-height: 100%;
        display: flex;
    }

    .image-box {
        width: 50%;
        height: 30vw;
        max-height: 400px;
        padding-right: 10px;
    }

    .form-box {
        width: 50%;
        padding-left: 10px;
    }

    .divider {
        margin-top: 10px;
    }

    .checkbox {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        width: 200px;
        margin-top: 40px;
    }

    .icon {
        color: var(--theme_jade) !important;
        width: 24px;
    }

    .check-icon {
        width: 24px;
        margin-right: 8px;
    }

    .check-icon:hover {
        cursor: pointer;
    }

    @media only screen and (max-width: 768px) {
        .create-edit-news {
            flex-direction: column;
        }

        .image-box {
            width: 100%;
            padding: 0;
            height: calc(50vw);
            max-height: calc(50vw);
        }
        
        .form-box {
            width: 100%;
            padding: 0;
        }
    }

    @media only screen and (max-width: 480px) {
        
    }
</style>