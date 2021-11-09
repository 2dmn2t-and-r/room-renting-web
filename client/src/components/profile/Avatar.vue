<template>
    <div class="avatar">
        <div class="image-box">
            <div class="block-img">
                <img class="img" v-bind:src="avt" alt="avt">
            </div>
            <theme-icon-button class="edit-bt" icon="mode_edit" bgColor="var(--theme_jade)" color="var(--theme_white)"/>
        </div>
        <theme-button theme-button v-bind="{
            msg: username,
            background_color: 'var(--theme_brown)',
            height: '40px',
            width: '220px',
            border_radius: '15px',
        }"></theme-button>
    </div>
</template>

<script>
import ThemeButton from '../ThemeButton.vue'
import ThemeIconButton from '../ThemeIconButton.vue'
export default {
    components: { 
        ThemeButton,
        ThemeIconButton 
    },
    props: {
        username: {
            type: String,
            default: "",
        },
        avt: {
            type: String,
            default: "",
        }
    },
}
</script>

<style scoped>
    .avatar {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .image-box {
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background-color: var(--theme_brown);
        border: solid var(--theme_brown) 3px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        position: relative;
        overflow: visible;
    }

    .block-img{
        width: 100%;
        height: 100%;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .img {
        width: 100%;
        object-fit: cover;
        display: inline;
    }

    .edit-bt {
        position: absolute;
        top: 180px;
        right: 25px;
    }
</style>