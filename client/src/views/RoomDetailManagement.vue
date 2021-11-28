<template>
  <div class="room-detail-management">
    <div class="page-container">
      <page-title
        title="Room Detail"
        v-bind:isBack="true"
        @onBack="$router.go(-1)"
      />
      <div class="main" :key="refresh">
        <reservation-block class="half_col" :filterStart.sync="filterStart" :filterEnd.sync="filterEnd" @triggerFilter="refreshList">
          <div v-for="(item, index) in reservationsList" :key="index">
            <reservation-info
              v-bind="{
                img: item.user.avatar,
                user: item.user.username,
                startDate: new Date(item.reservation.useDate),
                duration: getDuration(item.reservation.startTime, item.reservation.endTime).toString() + ' mins',
                totalPrice: getDuration(item.reservation.startTime, item.reservation.endTime) / 30 * parseInt(item.room.price),
                paid: (item.reservation.statusR === 'P'),
                showMiddle: false,
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
          @deleteInfo="deleteRoom()"
          @showComments="loadComments()"
        >
        </information-block>
      </div>
    </div>
    <modal-template
      v-bind="{
        title: 'Customer Reservaion',
        step: this.reservation,
        buttonTitle: (chosenReserve.reservation.statusR != 'P') ? ['Remove'] : ['OK'],
      }"
      @onClose="hideModal()"
      @onCancel="hideModal()"
      @onNextStep="remove()"
    >
      <customer-reservation
        slot="1"
        v-bind="{
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
          endTime: shortenTime(chosenReserve.reservation.endTime),
        }" :key="refresh" :enablePay="chosenReserve.reservation.statusR != 'P'" @setPaid="setPayReserve"
      ></customer-reservation>
    </modal-template>

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
        :key="refresh"
      ></add-room>
    </modal-template>

    <modal-template  v-bind="{
        title: 'Comments',
        step: commentsModalStep,
        buttonTitle: ['Send']
      }"
      @onClose="setCommentsModalStep(-1)"
      @onCancel="setCommentsModalStep(commentsModalStep - 1)"
      @onNextStep="uploadComment()"
      >
        <div slot="1" class="slot">
          <comment-box v-bind="{
            comments: comments,
            manager: true,
          }"
          :newComment.sync="newComment"
          @onDelete="(index) => {
            deleteComment(index)
          }"
          />
        </div>
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
import CustomerReservation from "../components/modals/reservation/CustomerReservation.vue";
import RoomInformation from "../components/modals/room/RoomInformation.vue";
import { getDataAPI, postDataAPI } from '../utils/fetchData';
import AddRoom from '../components/modals/room/AddRoom.vue';
import CommentBox from '../components/modals/news/CommentBox.vue';
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
    CommentBox,
  },
  props: {},
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
      refresh: 0,
      filterStart: '2000-01-01',
      filterEnd: (() => {var t = new Date(); t.setFullYear(t.getFullYear() + 1); return t.toISOString().split('T')[0];})(),
      payStatus: {
        'U': "Unpaid",
        'P': "Paid",
        'R': "Removed"
      },
      roomTypes: {
        'H': 'Hall',
        'M': 'Meeting room',
        'S': 'Stage'
      },
      comments: [],
      newComment: "",
      commentsModalStep: -1,
    };
  },

  methods: {
    remove: function () {
      if (this.chosenReserve.reservation.statusR != 'P') {
        (async () => {
          var token = localStorage.getItem("token");
          let res = await getDataAPI(`reservation/remove/${this.chosenReserve.reservation.resId}`, token);
          if (res.data["status"] === 200) {
            await this.refreshList();
            this.reservation = -1;
          }
        })()
      }
      else {
        this.reservation = -1;
      }
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
      this.chosenReserve = this.reservationsList[index];
      this.refresh = 1 - this.refresh;
      this.reservation = 0;
    },
    setPayReserve: function () {
      (async() => {
        var token = localStorage.getItem("token");
        let res = await getDataAPI(`reservation/setPay/${this.chosenReserve.reservation.resId}`, token);
        if (res.data["status"] === 200) {
          await this.refreshList();
          this.refresh = 1 - this.refresh;
          this.reservation = -1;
        }
      })();
    },

    hideModal: function () {
      this.reservation = -1;
      this.roomChange = -1;
    },
    showRoomModal: function () {
      this.modifiedRoom = Object.assign({}, this.curRoom);
      this.refresh = 1 - this.refresh;
      this.roomChange = 0;
    },
    deleteRoom() {
      (async() => {
        var token = localStorage.getItem("token");
        let res = await postDataAPI(`room/delete`, {'roomId': this.$route.params.roomId}, token);
        if (res.data["status"] === 200) {
          this.$router.go(-1);
        }
      })();
    },
    async refreshList() {
      var token = localStorage.getItem("token");
      let res = await getDataAPI(`reservation/loadRoom/${this.$route.params.roomId}/${this.filterStart}/${this.filterEnd}`, token);
      if (res.data["status"] === 200) {
        this.reservationsList = res.data["reversations"];
        // this.refresh = 1 - this.refresh;
      }
      else {
        if (res.data["msg"])
            alert(res.data["msg"]);
          else alert("Connection error. Try again.")
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
      if (date) {
        var year = date.getFullYear();

        var month = (1 + date.getMonth()).toString();
        month = month.length > 1 ? month : '0' + month;

        var day = date.getDate().toString();
        day = day.length > 1 ? day : '0' + day;
        
        return month + '/' + day + '/' + year;
      }
    },
    shortenTime(time) {
      return time.charAt(0) == "0"
        ? time.substring(1, 5)
        : time.substring(0, 5);
    },
    setCommentsModalStep(val) {
      this.commentsModalStep = val;
    },
    async loadComments() {
      var token = localStorage.getItem("token");
      let res = await getDataAPI('room/comments/load/' + this.$route.params.roomId, token);
      if (res.data["status"] === 200) {
        this.comments = res.data["room_comments"]
        this.setCommentsModalStep(0);
      }
    },
    async deleteComment(index) {
      var token = localStorage.getItem("token");
      let res = await postDataAPI('room/comment/delete', {
        commentId: this.comments[index]['commentId'],
      }, token);
      if (res.data["status"] === 200) {
        this.comments.splice(index, 1);
      }
    },
    async uploadComment() {
      if (this.newComment !== "") {
        var token = localStorage.getItem("token");
        let res = await postDataAPI('room/comment/upload', {
          content: this.newComment,
          date: (new Date()).toISOString().split('T')[0],
          roomId: this.$route.params.roomId,
        }, token);
        if (res.data["status"] === 200) {
          this.newComment = "";
          this.setCommentsModalStep(-1);
        }
      }
    },
  },

  mounted: function(){
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
        await this.refreshList();
      }
      else {
        if (res.data["msg"])
            alert(res.data["msg"]);
          else alert("Connection error. Try again.")
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