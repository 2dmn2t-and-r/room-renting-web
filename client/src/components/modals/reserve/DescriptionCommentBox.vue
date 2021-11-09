<template>
    <div class="border full_width col">
        <div class="row">
            <div class="half_box title title_chosen medium bold center bottom_border" v-if="!this.tagComment"><div class="chosen"></div>Description</div>
            <div class="half_box title medium bold center bottom_border" v-on:click="changeTag" v-else>Description</div>
            <div class="half_box title medium bold center bottom_border" v-on:click="changeTag" v-if="!this.tagComment">Comment</div>
            <div class="half_box title title_chosen medium bold center bottom_border" v-else><div class="chosen"></div>Comment</div>
        </div>
        <div class="inner col">
        <span v-if="!this.tagComment">
            <div class="font large bold stretch">Title</div>
            <div class="row font medium">
                <div class="half_col">Floor: <span class="bold">{{floor}}</span></div>
                <div class="half_col">Status: <span class="bold" :style="status_style">{{status}}</span></div>
            </div>
            <div class="row font medium">
                <div class="half_col">Seat: <span class="bold">{{seat}}</span></div>
                <div class="half_col">Type: <span class="bold">{{type}}</span></div>
            </div>
            <div class="row font medium">
                <div class="stretch">Address: <span class="bold">{{address}}</span></div>
            </div>
            <div class="row font medium">
                <div class="stretch">{{description}}</div>
            </div>
        </span>
        <span v-else>
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
            <div class="row baseline">
                <!-- <md-field md-inline>
                    <label>Write your comment</label>
                    <md-input v-model="inline">Write your comment</md-input>
                </md-field>
                <theme-button v-bind="{
                    msg: 'Send',
                    background_color: 'var(--theme_jade)',
                    width: '60px',
                    height: '40px',
                    border_radius: '10px'
                }"/> -->
                <theme-input
                    type="text"
                    value="Write your comment here"
                    buttonTitle="Send"
                    buttonWidth = "60px"
                    isInputBgWhite=true
                >
                </theme-input>
            </div>
        </span>
        </div>
    </div>
</template>

<script>
import Comment from '../../Comment.vue'
import ThemeButton from '../../ThemeButton.vue';
import ThemeInput from '../../ThemeInput.vue';
export default {
    props: {
        floor: Number,
        seat: Number,
        status: String,
        type: String,
        address: String,
        description: String,
        comments: Array // {name: string, time: date, content: string, img: string url}
    },
    data() {
        return {
            tagComment: false
        }
    },
    components: {
        Comment,
        ThemeButton,
        ThemeInput
    },
    methods: {
        changeTag: function() {
            this.tagComment = !this.tagComment;
        }
    },
    computed: {
        status_style: function(){
            return {
                "color": this.status == "Available" ? "var(--theme_jade)" : "var(--theme_gray)",
                "text-decoration": this.status == "Available" ? "none" : "line-through"
            }
        }
    }
}
</script>

<style
Comment scoped>
    .row {
        display: flex;
        flex-direction: row;
    }
    .baseline {
        align-items: baseline;
    }
    .col {
        display: flex;
        flex-direction: column;
    }
    .full_width {
        width: 100%;
    }
    .grow {
        flex-grow: 1;
    }
    .stretch {
        flex-basis: 100%;
    }
    .half_col {
        flex-basis: 50%;
    }
    .half_box {
        width: 50%;
        position: relative;
    }
    .chosen {
        height: 4px;
        background-color: var(--theme_jade);
        position: absolute;
        bottom: 0px;
        width: 100%;
    }
    .bottom_border {
        border-bottom: 1px solid var(--theme_gray);
    }
    .center {
        text-align: center;
    }
    .large {
        font-size: 22px;
    }
    .small {
        font-size: 8px;
    }
    .medium {
        font-size: 18px;
    }
    .bold {
        font-weight: bold;
    }
    .font {
        color: var(--theme_gray);
        line-height: 2.0;
    }
    .title {
        color: var(--theme_black);
        line-height: 3.0;
    }
    .title:hover {
        color: var(--theme_jade)
    }
    .title_chosen {
        color: var(--theme_jade)
    }
    .border {
        border-radius: 10px;
        background-color: var(--theme_fore);
    }
    .inner {
        padding: 20px;
    }
    .divider {
        width: 20px;
        height: 20px;
    }
</style>