<template>
    <div class="border_other box jade col">
        <div class="title_box title_font white bold">Reservation</div>
        <div class="border content col">
            <reservation-info/>
            <div class="divider_other"> </div>
            <reservation-info/>
            <div class="divider_other"> </div>
            <reservation-info/>
            <div class="divider_other"> </div>
            <reservation-info/>
            <div class="divider_other"> </div>
            <reservation-info/>
            <div class="divider_other"> </div>
            <reservation-info/>
            <div class="divider_other"> </div>
            <reservation-info/>
            <div class="divider_other"> </div>
        </div>
        <div class="date_box row date_box_row">
            <input type="date">
            <div class="divider_other"> </div>
            <input type="date">
        </div>
    </div>
</template>

<script>
import ReservationInfo from './ReservationInfo.vue'
export default {
  components: { ReservationInfo },
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
        overflow: auto;
        padding: 10px 10px 0px 10px;
        background-color: var(--theme_white);
    }
    .white {
        color: var(--theme_white);
    }
    .black {
        color: var(--theme_black);
    }
    .jade {
        background-color: var(--theme_jade);
    }
    .divider_other {
        height: 10px !important;
        min-height: 10px;
        min-width: 10px;
        width: 10px;
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
        width: 250px;
        min-width: 10px;
        border-radius: 20px 0px 20px 0px;
    }
    .date_box_row {
        align-items: center;
        justify-content: space-between;
    }
</style>