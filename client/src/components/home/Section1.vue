<template src="">
    <div class="bare_section">
        <div class="inner_section">
            <div style="width: 1%"></div>
            <div class="info">
                <div class="text_title">ROOM PRO</div>
                <div class="text_info">We provide renting meeting rooms, halls and stages for your professional events.</div>
                <div class="divider"></div>
                <theme-button v-bind="{
                    msg: 'Book Now',
                    background_color: 'var(--theme_jade)',
                    height: '16.02%',
                    width: '48.46%',
                    border_radius: '15px'
                }" class="text_info" style="font-weight: bold"/>
            </div>
            <div class="divider"></div>
            <div class="illust">
                <picture-frame v-bind="{
                    width: '100%',
                    width_img: '95.83%',
                    height: '100%',
                    height_img: '95.83%',
                    border_radius: '21.42%'
                }"/>
            </div>
        </div>
    </div>
</template>

<script>
import PictureFrame from '../PictureFrame.vue'
import ThemeButton from '../ThemeButton.vue'
export default {
  components: { PictureFrame, ThemeButton },

}
</script>

<style scoped>
.bare_section {
    height: 79.30vw;
    max-height: 904px;
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}

.inner_section {
    height: 70.13%;
    width: 100%;
    max-width: 1140px;
    display: flex;
    flex-direction: row;
    align-items: center;
}

.divider {
    display: flex;
    flex: 1;
}

.illust {
    width: 51.49%;
    height: 100%;
}

.info {
    width: 40%;
    height: 51.77%;
    display: flex;
    flex-direction: column;
}

.text_title {
    font-size: 4.21vw;
    font-weight: bold;
    line-height: 2.0;
}

.text_info {
    font-size: 1.58vw;
    line-height: 2.0;
}

@media only screen and (min-width: 1140px) {
    .text_title {
        font-size: 48px;
    }

    .text_info {
        font-size: 18px;
    }
}
</style>