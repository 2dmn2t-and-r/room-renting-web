<template>
    <div class="border_other box jade col">
        <div class="title_box title_font white bold">Information</div>
        <div class="border content content_col col">
            <div class="row">
                <div class="font_info grow">Room name:</div>
                <div class="divider_other"> </div>
                <div class="font_info grow">Room type:</div>
            </div>
            <div class="row">
                <input type="text">
                <div class="divider_other"> </div>
                <input type="text">
            </div>
            <div class="row">
                <div class="font_info grow">Floor:</div>
                <div class="divider_other"> </div>
                <div class="font_info grow">Seat:</div>
            </div>
            <div class="row">
                <input type="text">
                <div class="divider_other"> </div>
                <input type="text">
            </div>
            <div class="row">
                <div class="font_info grow">Status:</div>
                <div class="divider_other"> </div>
                <div class="font_info grow">Price per 30 minutes:</div>
            </div>
            <div class="row">
                <input type="text">
                <div class="divider_other"> </div>
                <input type="text">
            </div>
            <div class="row">
                <div class="font_info grow">Open:</div>
                <div class="divider_other"> </div>
                <div class="font_info grow">Close:</div>
            </div>
            <div class="row">
                <input type="text">
                <div class="divider_other"> </div>
                <input type="text">
            </div>
            <div class="row">
                <div class="font_info grow">Address:</div>
            </div>
            <div class="row">
                <input type="text">
            </div>
            <div class="row">
                <div class="font_info grow">Description:</div>
            </div>
            <div class="row">
                <input type="text">
            </div>
        </div>
        <div class="date_box row date_box_row">
            <theme-button msg="Change" :background_color="'var(--theme_jade)'" height="40px" width="120px"/>
        </div>
    </div>
</template>

<script>
import ThemeButton from './ThemeButton.vue'
export default {
  components: { ThemeButton },
  
}
</script>

<style scoped>
    ::-webkit-scrollbar {
        width: 6px;
    }
    .row {
        display: flex;
        flex-direction: row;
    }
    .col {
        display: flex;
        flex-direction: column;
    }
    .border_other {
        border-radius: 10px;
    }
    .border {
        border-radius: 10px 0px 10px 0px;
    }
    .box {
        padding-left: 10px;
        padding-right: 10px;
        height: 680px;
        width: 100%;
    }
    .title_box {
        height: 60px;
        line-height: 60px;
        width: 100%;
        text-align: center;
    }
    .title_font {
        font-size: 24px;
    }
    .date_font {
        font-size: 18px;
    }
    .date_box {
        height: 120px;
        width: 100%;
    }
    .bold {
        font-weight: bold;
    }
    .content {
        width: 100%;
        height: 500px;
    }
    .white {
        color: var(--theme_white);
    }
    .black {
        color: var(--theme_black);
    }
    .jade {
        background-color: var(--theme_brown);
    }
    .divider_other {
        height: 20px;
        min-height: 20px;
        min-width: 20px;
        width: 20px;
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
        height: 45px;
        max-width: none;
        flex-grow: 1;
        min-width: 10px;
        border-radius: 20px 0px 20px 0px;
    }
    .date_box_row {
        align-items: center;
        justify-content: space-around;
    }
    .content_col {
        justify-content: space-between;
    }
    .font_info {
        font-size: 16px;
        color: white;
    }
    .grow {
        flex-basis: 100%;
    }
</style>