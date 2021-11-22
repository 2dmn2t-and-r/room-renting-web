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
                            <div>Comfortable</div>
                        </div>
                    </div>
                </md-button>
                <div style="width: 10px; height: 10px;"> </div>
                <md-button class='button_form'>
                    <div class="button_in">
                        <img src="../../assets/icon/house.png" alt="None">
                        <div class="button_text">
                            <div style="font-weight: bold">Hall</div>
                            <div>Modern</div>
                        </div>
                    </div>
                </md-button>
                <div style="width: 10px; height: 10px;"> </div>
                <md-button class='button_form'>
                    <div class="button_in">
                        <img src="../../assets/icon/chair.png" alt="None">
                        <div class="button_text">
                            <div style="font-weight: bold">Stage</div>
                            <div>Professional</div>
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
    /* height: 35.70vw;
    max-height: 407px; */
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}

.inner_section {
    width: 100%;
    max-width: 1140px;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    padding: 60px 20px;
}

.text_title {
    font-size: 48px;
    font-weight: bold;
    line-height: 2.0;
}

.button_row {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    /* height: 13.86vw;
    max-height: 158px; */
    width: 100%;
}

.button_form {
    background-color: white;
    /* max-width: 337px; */
    min-width: none;
    width: 30%;
    height: 100%;
    border-radius: 20px 0px;
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
    padding: 20px 0px;
}

.button_in > img {
    width: 15%;
}

.button_text {
    width: 70%;
    text-align: left;
    font-size: 14px;
    text-transform: none;
    /* overflow-wrap: normal; */
    word-wrap: break-word;
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
        border-radius: 20px 0px;
        box-shadow: 0px 0px 20px #dddddd;
    }
    .button_text {
        font-size: 18px;
    }
}

@media only screen and (max-width: 768px) {
    .text_title {
        font-size: 30px;
    }

    .button_in > img {
        width: 30%;
    }

    .button_in {
        flex-direction: column;
        align-items: center;
    }

    .button_text {
        text-align: center;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
}

@media only screen and (max-width: 600px) {
    .text_title {
        font-size: 30px;
    }
}

@media only screen and (max-width: 500px) {
    .button_in {
        flex-direction: row;
        width: 95%;
    }

    .button_in > img {
        width: 15%;
    }

    .button_row {
        flex-direction: column;
    }

    .button_form {
        width: 100%;
    }

    .button_text {
        text-align: left;
    }
}
</style>