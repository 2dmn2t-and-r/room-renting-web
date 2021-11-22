<template>
  <div class="reservation-management">
    <div class="page-container">
      <page-title title="All Reservations"/>
      <reservation-block :key="refresh" :filterStart.sync="filterStart" :filterEnd.sync="filterEnd" @triggerFilter="refreshList">
        <div v-for="(item, index) in reservationsList" :key="index">
          <reservation-info v-bind="{
              img: item.user.avatar,
              user: item.user.username,
              startDate: new Date(item.reservation.useDate),
              duration: getDuration(item.reservation.startTime, item.reservation.endTime).toString() + ' mins',
              totalPrice: getDuration(item.reservation.startTime, item.reservation.endTime) / 30 * parseInt(item.room.price),
              paid: (item.reservation.statusR === 'P'),
              roomName: item.room.roomName,
              reserveDate: new Date(item.reservation.bookDate),
              showMiddle: true,
            }" @click.native="showReservation(index)"/>
          <div class="divider_other"> </div>
        </div>
      </reservation-block>   
    </div>
    <modal-template v-bind="{
      title: 'Reservation',
      step: showModal,
      buttonTitle: ['Remove']
    }" @onClose="changeModal()" @onCancel="changeModal()" @onNextStep="clickRemove()">
      <customer-reservation slot="1" v-bind="{
          title: chosenReserve.room.roomName,
          owner: chosenReserve.user.username,
          floor: parseInt(chosenReserve.room.floor),
          seat: parseInt(chosenReserve.room.seat),
          type: roomTypes[chosenReserve.room.type],
          price: parseInt(chosenReserve.room.price),
          bookDate: new Date(chosenReserve.reservation.bookDate),
          startDate: new Date(chosenReserve.reservation.useDate),
          duration: getDuration(chosenReserve.reservation.startTime, chosenReserve.reservation.endTime).toString() + ' mins',
          totalPrice: getDuration(chosenReserve.reservation.startTime, chosenReserve.reservation.endTime) / 30 * parseInt(chosenReserve.room.price),
          status: payStatus[chosenReserve.reservation.statusR],
          address: chosenReserve.room.address,
          description: chosenReserve.room.description,
          img: chosenReserve.room.image,
          startTime: shortenTime(chosenReserve.reservation.startTime),
          endTime: shortenTime(chosenReserve.reservation.endTime)
        }"/>
    </modal-template>
  </div>
</template>

<script>
import CustomerReservation from '../components/modals/reservation/CustomerReservation.vue';
import ModalTemplate from '../components/ModalTemplate.vue';
import PageTitle from '../components/PageTitle.vue'
import ReservationBlock from '../components/ReservationBlock.vue';
import ReservationInfo from '../components/ReservationInfo.vue';
import { getDataAPI, postDataAPI } from '../utils/fetchData';
import moment from "moment";
export default {
  components: { PageTitle, ReservationBlock, ReservationInfo, ModalTemplate, CustomerReservation },
  data() {
    return {
      reservationsList: [],
      chosenReserve: {
        reservation: {
          resId: 0,
          bookDate: "2021-10-10",
          useDate: "2021-10-10",
          startTime: "9:00",
          endTime: "12:00",
          totalPrice: 2000,
          statusR: "Paid",
          roomId: 0,
          userId: 0,
        },
        room: {
          roomId: 0,
          roomName: "Hall 1",
          type: "Hall",
          floor: 0,
          price: 0,
          statusRo: "Unpaid",
          openTime: "9:00",
          closeTime: "18:00",
          address: "Some address",
          description: "Some description",
          image: "",
        },
        user: {
          userId: 0,
          username: "",
          password: "",
          sex: "M",
          birthday: "2000-10-10",
          phone: "",
          address: "",
          email: "",
          type: "",
          avatar: "",
        },
      },
      showModal: -1,
      refresh: 0,
      filterStart: '2000-01-01',
      filterEnd: (() => {var t = new Date(); t.setFullYear(t.getFullYear() + 1); return moment(t).format('YYYY-MM-DD');})(),
      payStatus: {
        'U': "Unpaid",
        'P': "Paid",
        'R': "Removed"
      },
      roomTypes: {
        'H': 'Hall',
        'M': 'Meeting room',
        'S': 'Stage'
      }
    }
  },
  methods: {
    dateString(date) {
      if (date) {
        var year = date.getFullYear();

        var month = (1 + date.getMonth()).toString();
        month = month.length > 1 ? month : '0' + month;

        var day = date.getDate().toString();
        day = day.length > 1 ? day : '0' + day;
        
        return month + '/' + day + '/' + year;
      }
    },
    changeModal: function() {
      this.showModal = -1 - this.showModal;      
    },
    clickRemove: function() {
      (async () => {
        var token = localStorage.getItem("token");
        let res = await getDataAPI(`reservation/remove/${this.chosenReserve.reservation.resId}`, token);
        if (res.data["status"] === 200) {
          await this.refreshList();
          this.showModal = -1 - this.showModal;
        }
      })()
    },
    showReservation: function (index) {
      this.chosenReserve = this.reservationsList[index]
      this.showModal = -1 - this.showModal;   
    },
    async refreshList() {
      var token = localStorage.getItem("token");
      let res = await getDataAPI(`reservation/load/${this.filterStart}/${this.filterEnd}`, token);
      if (res.data["status"] === 200) {
        this.reservationsList = res.data["reversations"];
      }
      this.refresh = 1 - this.refresh;
    },
    getDuration(openTime, closeTime) {
      var op = openTime.split(":");
      var cl = closeTime.split(":");
      var dur =
        (parseInt(cl[0]) - parseInt(op[0])) * 60 +
        (parseInt(cl[1]) - parseInt(op[1]));
      return dur;
    },
    dateFormat(date) {
      return moment(Date(date)).format("DD/MM/YYYY");
    },
    shortenTime(time) {
      return time.charAt(0) == "0"
        ? time.substring(1, 5)
        : time.substring(0, 5);
    },
  },
  mounted: function(){
    this.refreshList();
  }
}
</script>

<style scoped>
  .reservation-management {
    padding: 20px;
    background-color: var(--theme_white);
    min-height: calc(100vh - 100px);
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .page-container {
    width: 100%;
    max-width: 1140px;
  }

  .col {
    display: flex;
    flex-direction: column;
  }

  .row {
    display: flex;
    flex-direction: row;
  }
</style>