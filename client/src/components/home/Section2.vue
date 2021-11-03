<template src="">
    <div class="bare_section">
        <div class="inner_section">
            <div class="text_title">Our services</div>
            <div class="button_row">
                <md-button class='button_form'>
                    <div class="button_in">
                        <img src="../../assets/icon/door.png" alt="None">
                        <div class="button_text">
                            <div style="font-weight: bold">Meeting room</div>
                            <div>Super comfortable</div>
                        </div>
                    </div>
                </md-button>
                <md-button class='button_form'>
                    <div class="button_in">
                        <img src="../../assets/icon/house.png" alt="None">
                        <div class="button_text">
                            <div style="font-weight: bold">Hall</div>
                            <div>Amazingly comfortable</div>
                        </div>
                    </div>
                </md-button>
                <md-button class='button_form'>
                    <div class="button_in">
                        <img src="../../assets/icon/chair.png" alt="None">
                        <div class="button_text">
                            <div style="font-weight: bold">Stage</div>
                            <div>Ultra comfortable</div>
                        </div>
                    </div>
                </md-button>
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
    background-color: var(--theme_fore);
    height: 35.70vw;
    max-height: 407px;
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
    flex-direction: column;
    justify-content: space-evenly;
}

.text_title {
    font-size: 4.21vw;
    font-weight: bold;
    line-height: 2.0;
}

.button_row {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    height: 13.86vw;
    max-height: 158px;
    width: 100%;
}

.button_form {
    background-color: white;
    max-width: 337px;
    width: 29.56vw;
    height: 100%;
    border-radius: 5.26vw 0px;
    box-shadow: 0px 0px 1.75vw #dddddd;
    color: var(--theme_black);
    display: flex;
    flex-direction: row;
    align-items: flex-start;
}

.button_in {
    max-width: 280px;
    width: 24.56vw;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
}

.button_in > img {
    width: 15%;
}

.button_text {
    width: 70%;
    text-align: left;
    font-size: 1.58vw;
    text-transform: none;
    overflow-wrap: normal;
    line-height: 2.0;
}

.button_form:hover {
    background-color: var(--theme_brown);
    color: white;
}

@media only screen and (min-width: 1140px) {
    .text_title {
        font-size: 48px;
    }
    .button_form {
        border-radius: 60px 0px;
        box-shadow: 0px 0px 20px #dddddd;
    }
    .button_text {
        font-size: 18px;
    }
}
</style>