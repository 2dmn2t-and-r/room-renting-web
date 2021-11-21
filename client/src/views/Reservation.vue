<template>
  <div class="reservation">
    <div class="page-container">
      <page-title title="Reservation History" />
      <div class="mai">
        <div class="grow1">
          <side-bar-reserve-time />
        </div>
        <div style="min-height: 10px; min-width: 10px"></div>
        <div class="grow4" :key="refresh">
          <div v-for="(item, index) in reserveList" :key="index">
            <reservation-card
              v-bind="{
                img: item.room.image,
                name: item.room.roomName,
                floor: parseInt(item.room.floor),
                seat: parseInt(item.room.seat),
                address: item.room.address,
                startdate: dateFormat(item.room.useDate),
                duration: getDuration(
                  item.reservation.startTime,
                  item.reservation.endTime
                ).toString() + ' mins',
              }"
              @click.native="changeModal(index)"
            />
            <div style="min-height: 18px"></div>
          </div>
        </div>
      </div>
    </div>
    <modal-template
      v-bind="{
        title: 'Reservation',
        step: showModal,
        buttonTitle: ['Remove'],
      }"
      @onClose="changeModal()"
      @onCancel="changeModal()"
      @onNextStep="clickRemove()"
    >
      <customer-reservation
        slot="1"
        v-bind="{
            title: chosenResere.room.roomName,
            owner: chosenResere.user.username,
            floor: parseInt(chosenResere.room.floor),
            seat: parseInt(chosenResere.room.seat),
            type: chosenResere.room.type,
            price: parseInt(chosenResere.room.price),
            bookDate: new Date(chosenResere.reservation.bookDate),
            startDate: new Date(chosenResere.reservation.useDate),
            duration: getDuration(chosenResere.reservation.startTime, chosenResere.reservation.endTime).toString() + ' mins',
            totalPrice: getDuration(chosenResere.reservation.startTime, chosenResere.reservation.endTime) / 30 * parseInt(chosenResere.room.price),
            status: chosenResere.reservation.statusR,
            address: chosenResere.room.address,
            description: chosenResere.room.description
        }"
      />
    </modal-template>
  </div>
</template>

<script>
import moment from "moment";
import CustomerReservation from "../components/modals/reservation/CustomerReservation.vue";
import ModalTemplate from "../components/ModalTemplate.vue";
import PageTitle from "../components/PageTitle.vue";
import ReservationCard from "../components/ReservationCard.vue";
import SideBarReserveTime from "../components/SideBarReserveTime.vue";
import { getDataAPI, postDataAPI } from "../utils/fetchData";
export default {
  components: {
    PageTitle,
    SideBarReserveTime,
    ReservationCard,
    ModalTemplate,
    CustomerReservation,
  },
  data() {
    return {
      reserveList: [],
      chosenResere: {
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
    };
  },
  methods: {
    dateString(date) {
      if (date) {
        var year = date.getFullYear();

        var month = (1 + date.getMonth()).toString();
        month = month.length > 1 ? month : "0" + month;

        var day = date.getDate().toString();
        day = day.length > 1 ? day : "0" + day;

        return month + "/" + day + "/" + year;
      }
    },
    changeModal: function (index = -1) {
        if (index != -1) {
            this.chosenResere = this.reserveList[index];
        }
      this.showModal = -1 - this.showModal;
    },
    clickRemove: function () {
      this.showModal = -1 - this.showModal;
    },
    async refreshList() {
      var token = localStorage.getItem("token");
      let res = await getDataAPI("reservation/individual", token);
      if (res.data["status"] === 200) {
        this.reserveList = res.data["reversations"];
        console.log(this.reserveList);
      }
      this.refresh = 1 - this.refresh;
    },
    shortenTime(time) {
      return time.charAt(0) == "0"
        ? time.substring(1, 5)
        : time.substring(0, 5);
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
      console.log(moment(Date(date)).format("DD/MM/YYYY"));
    },
  },
  beforeMount: function () {
    this.refreshList();
  },
};
</script>

<style scoped>
.reservation {
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

.mai {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
}

.grow1 {
  width: 20%;
}

.grow4 {
  width: 80%;
  border-radius: 10px;
  background-color: var(--theme_fore);
  padding: 18px 18px 0px 18px;
}

@media only screen and (max-width: 768px) {
  .grow1 {
    width: 100%;
  }

  .grow4 {
    width: 100%;
  }

  .mai {
    flex-direction: column;
  }
}
</style>