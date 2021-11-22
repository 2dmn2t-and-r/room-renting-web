<template>
    <div class="outer">
        <div class="text_class text_normal">Date filter</div>
        <div class="row">
            <div class="date_text">From:</div>
            <input type="date" v-model="filterStart">
            <!-- <div>
                <theme-input type="date"/>
            </div> -->
        </div>
        <div class="divider"></div>
        <div class="row">
            <div class="date_text">To:</div>
            <input type="date" v-model="filterEnd">
            <!-- <div>
                <theme-input type="date"/>
            </div> -->
        </div>
        <div class="divider"></div>
        <theme-button class="text_button" v-bind:msg="'OK'" v-bind:background_color="'var(--theme_jade)'" v-bind:width="'100%'" v-bind:height="'40px'" @click="triggerFilter"/>
    </div>
</template>

<script>
import ThemeButton from './ThemeButton.vue'
import ThemeInput from './ThemeInput.vue'
import moment from "moment";
export default {
  components: { ThemeButton, ThemeInput },
  data() {
      return {
        filterStart: '2000-01-01',
        filterEnd: (() => {var t = new Date(); t.setFullYear(t.getFullYear() + 1); return moment(t).format('YYYY-MM-DD');})(),
      }
  },
  methods: {
      triggerFilter() {
          this.$emit('triggerFilter', this.filterStart, this.filterEnd);
      }
  }
}
</script>

<style scoped>
    .text_class {
        font-size: 24px;
        line-height: 2.5;
        font-weight: bold;
    }
    .text_button {
        font-size: 18px;
        font-weight: bold;
    }
    .text_normal {
        color: var(--theme_black);
    }
    .row {
        display: flex;
        flex-direction: row;
        align-items: baseline;
        flex-basis: 100%;
    }
    .date_text {
        font-size: 18px;
        line-height: 2.5;
        color: var(--theme_gray);
        width: 55px;
        min-width: 55px;
    }
    input {
        display: block;
        color: var(--theme_gray);
        font-size: 18px;
        line-height: 2.5;
        border: none;
        padding-left: 10px;
        background-color: var(--theme_fore);
        max-height: none;
        max-width: none;
        min-width: 10px;
        flex-basis: 100%;
        border-radius: 20px 0px 20px 0px;
    }
    .divider {
        height: 10px;
        min-height: 10px;
        width: 10px;
        min-width: 10px;
    }
    @media only screen and (max-width: 768px) {
        .outer {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }
        .row {
            flex-basis: 40%;
        }
        .text_class {
            display: none;
        }
    }
    @media only screen and (max-width: 600px) {
        .outer {
            display: flex;
            flex-direction: column;
            justify-content: none;
        }
        .row {
            flex-basis: 100%;
        }
        .text_class {
            display: none;
        }
    }
</style>