<template>
  <div class="room-detail-management">
    <div class="page-container">
      <page-title
        title="Room Detail"
        v-bind:isBack="true"
        @onBack="$router.go(-1)"
      />
      <div class="main">
        <reservation-block class="half_col">
          <div v-for="(item, index) in reservationsList" :key="index">
            <reservation-info
              v-bind="{
                user: item.user,
                reserveDate: item.reserveDate,
                duration: item.duration,
                price: item.price,
                paid: item.paid,
                showMiddle: item.showMiddle,
              }"
              @click.native="showReservation(index)"
            >
            </reservation-info>
            <div style="min-height: 10px; min-width: 10px"></div>
          </div>
        </reservation-block>
        <div style="min-height: 10px; min-width: 10px"></div>
        <information-block
          class="half_col"
          :room="curRoom"
          @changeInfo="showRoomModal()"
          :key="refresh"
        >
        </information-block>
      </div>
    </div>
    <!-- <modal-template
      v-bind="{
        title: 'Customer Reservaion',
        step: this.reservation,
        buttonTitle: ['Remove'],
      }"
      @onClose="hideModal()"
      @onCancel="hideModal()"
      @onNextStep="remove()"
    >
      <customer-reservation
        slot="1"
        v-bind="{
          title: room.name,
          owner: this.reservationsList[selectedReservation].user,
          floor: room.floor,
          seat: room.seat,
          type: room.type,
          price: room.price,
          bookDate: Date(),
          startDate: Date(),
          duration: this.reservationsList[selectedReservation].duration,
          totalPrice: this.reservationsList[selectedReservation].price,
          status: this.reservationsList[selectedReservation].paid
            ? 'Paid'
            : 'Unpaid',
          address: room.address,
          description: room.description,
        }"
      ></customer-reservation>
    </modal-template> -->

    <modal-template
      v-bind="{
        title: 'Room Infomation',
        step: this.roomChange,
        buttonTitle: ['Save'],
      }"
      @onClose="hideModal()"
      @onCancel="hideModal()"
      @onNextStep="save()"
    >
      <add-room slot="1"
        :img.sync="modifiedRoom.image"
        :roomName.sync="modifiedRoom.roomName"
        :roomType.sync="modifiedRoom.type"
        :floor.sync="modifiedRoom.floor"
        :seat.sync="modifiedRoom.seat"
        :status.sync="modifiedRoom.statusRo"
        :price.sync="modifiedRoom.price"
        :openTime.sync="modifiedRoom.openTime"
        :closeTime.sync="modifiedRoom.closeTime"
        :address.sync="modifiedRoom.address"
        :description.sync="modifiedRoom.description"
        :types="type"
      ></add-room>
    </modal-template>
  </div>
</template>
<script>
import InformationBlock from "@/components/InformationBlock.vue";
import ReservationBlock from "@/components/ReservationBlock.vue";
import ModalTemplate from "@/components/ModalTemplate.vue";
import PageTitle from "../components/PageTitle.vue";
import Reservation from "./Reservation.vue";
import ReservationInfo from "../components/ReservationInfo.vue";
import moment from "moment";
import CustomerReservation from "../components/modals/reservation/CustomerReservation.vue";
import RoomInformation from "../components/modals/room/RoomInformation.vue";
import { getDataAPI, postDataAPI } from '../utils/fetchData';
import AddRoom from '../components/modals/room/AddRoom.vue';
export default {
  components: {
    InformationBlock,
    ReservationBlock,
    ModalTemplate,
    PageTitle,
    Reservation,
    ReservationInfo,
    CustomerReservation,
    RoomInformation,
    AddRoom,
  },
  props: {},
  data() {
    return {
      reservationsList: [
        {
          user: "Cu Meo",
          reserveDate: Date(),
          duration: "4hr",
          price: 100,
          img: String,
          paid: true,
          showMiddle: false,
        },
        {
          user: "Cu Meo",
          reserveDate: Date(),
          duration: "4hr",
          price: 100,
          img: String,
          paid: false,
          showMiddle: false,
        },
        {
          user: "Cu Meo",
          reserveDate: Date(),
          duration: "4hr",
          price: 100,
          img: String,
          paid: true,
          showMiddle: false,
        },
        {
          user: "Cu Meo",
          reserveDate: Date(),
          duration: "4hr",
          price: 100,
          img: String,
          paid: false,
          showMiddle: false,
        },
        {
          user: "Cu Meo",
          reserveDate: Date(),
          duration: "4hr",
          price: 120,
          img: String,
          paid: true,
          showMiddle: false,
        },
        {
          user: "Cu Meo",
          reserveDate: Date(),
          duration: "4hr",
          price: 100,
          img: String,
          paid: false,
          showMiddle: false,
        },
      ],
      curRoom: {
        roomId: 0,
        roomName: "",
        type: "",
        floor: 0,
        seat: 0,
        price: 0,
        statusRo: "Available",
        openTime: "6:00",
        closeTime: "22:00",
        address: "",
        description: "",
        image: "",
      },
      modifiedRoom: {
        roomId: 0,
        roomName: "",
        type: "",
        floor: 0,
        seat: 0,
        price: 0,
        statusRo: "Available",
        openTime: "6:00",
        closeTime: "22:00",
        address: "",
        description: "",
        image: "",
      },
      type: [
          'Hall',
          'Meeting room',
          'Stage'
      ],
      reservation: -1,
      selectedReservation: -1,
      roomChange: -1,
      refresh: 0
    };
  },

  methods: {
    remove: function () {
      let removed = true;
      if (removed) {
        // remove from db
      } else {
        //back
      }
      this.reservation = -1;
    },
    async save() {
      var token = localStorage.getItem("token");
      let res = await postDataAPI('room/upload', this.modifiedRoom, token);
      if (res.data["status"] === 200) {
        this.curRoom = Object.assign({}, this.modifiedRoom);
        this.refresh = 1 - this.refresh;
        this.roomChange = -1;
      }
    },
    showReservation: function (index) {
      this.selectedReservation = index;
      this.reservation = 0;
    },

    hideModal: function () {
      this.reservation = -1;
      this.roomChange = -1;
    },
    showRoomModal: function () {
      this.modifiedRoom = Object.assign({}, this.curRoom);
      this.roomChange = 0;
    }
  },

  beforeMount: function(){
    (async () => {
      var token = localStorage.getItem("token");
      let res = await getDataAPI(`room/load/${this.$route.params.roomId}`, token);
      if (res.data["status"] === 200) {
        this.curRoom = res.data["room"];
        this.curRoom.floor = parseInt(this.curRoom.floor);
        this.curRoom.seat = parseInt(this.curRoom.seat);
        this.curRoom.price = parseInt(this.curRoom.price);
        this.curRoom.openTime = ((this.curRoom.openTime.charAt(0) == '0') ? this.curRoom.openTime.substring(1, 5) : this.curRoom.openTime.substring(0, 5));
        this.curRoom.closeTime = ((this.curRoom.closeTime.charAt(0) == '0') ? this.curRoom.closeTime.substring(1, 5) : this.curRoom.closeTime.substring(0, 5));
        this.curRoom.statusRo = ((this.curRoom.statusRo == 'A') ? "Available" : "Unavailable");
        this.curRoom.type = ((val) => {if (val == 'H') return "Hall"; else if (val == 'M') return "Meeting room"; else return "Stage";})(this.curRoom.type);
        this.modifiedRoom = Object.assign({}, this.curRoom);
      }
      this.refresh = 1 - this.refresh;
    })()
  }
};
</script>

<style scoped>
.room-detail-management {
  padding: 20px;
  background-color: var(--theme_white);
  min-height: calc(100vh - 100px);
}

.page-container {
  width: 100%;
  max-width: 1140px;
  margin: 0 auto;
}

.main {
  display: flex;
  width: 100%;
}

.title {
  margin: 0 auto;
  text-align: center;
}
.half_col {
  width: 50%;
}
@media only screen and (max-width: 1000px) {
  .main {
    display: block;
  }
  .half_col {
    width: 100%;
  }
}
</style>