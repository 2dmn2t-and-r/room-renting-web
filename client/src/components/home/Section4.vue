<template src="">
    <div>
    <div class="bare_section">
        <div class="inner_section">
            <div class="text_title">Sign up now to use our services</div>
            <!-- <hr style="width: 40%; color: var(--theme_fore);"> -->
            <!-- <div class="sign_row">
                <md-field md-inline class="type_sign_up">
                    <label>Enter your email address</label>
                    <md-input v-model="inline">Enter your email address</md-input>
                </md-field>
                <theme-button v-bind="{
                    msg: 'Sign Up',
                    background_color: 'var(--theme_jade)',
                    width: '25%',
                    height: '4.21vw',
                    border_radius: '1.32vw'
                }" class='sign_up' style="font-weight: bold"/>
            </div> -->
            <div style="min-height: 20px"> </div>
            <theme-input :buttonTitle="'Sign up'" :buttonWidth="'100px'" :value="'Enter your email address'"/>
        </div>
    </div>
    </div>
</template>

<script>
import PictureFrame from '../PictureFrame.vue'
import ThemeButton from '../ThemeButton.vue'
import ThemeInput from '../ThemeInput.vue'
export default {
  components: { PictureFrame, ThemeButton, ThemeInput },

}
</script>

<style scoped>
.bare_section {
    background-color: white;
    /* height: 28.51vw;
    max-height: 225px; */
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}

.inner_section {
    height: 100%;
    width: 100%;
    max-width: 1140px;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    align-items: center;
    padding: 60px 20px;
}

.text_title {
    font-size: 30px;
    font-weight: bold;
    line-height: 1.5;
    text-align: center;
}

.sign_row {
    width: 70%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}

.sign_up {
    height: 4.21vw;
    max-height: 48px;
    font-size: 1.57vw;
    border-radius: 0px 0px 1.32vw 0px;
}

.type_sign_up {
    display: block;
    height: 4.21vw;
    max-height: 48px;
    font-size: 4vw;
    background-color: var(--theme_fore);
    margin: 0px;
    padding: 0px;
}
.md-field {
    min-height: 0px;
    line-height: 1.0;
}
.md-field .md-input {
    height: 4.21vw;
    max-height: 48px;
    font-size: 1.57vw;
    padding-left: 0.88vw;
}
.md-field.md-has-value .md-input {
    font-size: 1.57vw;
}
.md-field label {
    font-size: 1.57vw;
    line-height: 3.0;
    top: 0px;
}
.md-field.md-inline.md-focused label {
    font-size: 1.57vw;
    top: 0px;
    line-height: 3.0;
}
html.md-theme-default {
    color: var(--theme_jade);
}
.empty_end {
    height: 7.02vw;
    max-height: 80px;
}
@media only screen and (min-width: 768px) {
    .text_title {
        font-size: 48px;
    }
    .sign_up {
        height: 48px;
        font-size: 18px;
    }
    .md-field label {
        font-size: 18px;
    }
    .md-field .md-input {
        font-size: 18px;
    }
    .md-field.md-inline.md-focused label {
        font-size: 18px;
        top: 0px;
    }
    .md-field.md-has-value .md-input {
        font-size: 18px;
    }
}

@media only screen and (max-width: 600px) {
    .text_title {
        font-size: 20px;
    }
}
</style>