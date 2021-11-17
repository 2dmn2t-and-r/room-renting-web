<template>
  <div class="room-detail-management">
    <div class="page-container">
      <page-title title="Room Detail" class="title" v-bind:isBack="true" @onBack="$router.go(-1)"/>
      <div class="main">
        <reservation-block > 
          <reservation-info v-for="(item,index) in reservationsList" :key="index"
            v-bind="{
            user: item.user,
            reserveDate: item.reserveDate,
            duration: item.duration,
            price: item.price,
            paid: item.paid,
            showMiddle: item.showMiddle,
          }" @click.native="showReservation(index)">  </reservation-info>  
        </reservation-block>

         <information-block :room="getRoom()" @click.native="showRoomModal()">   </information-block>
      </div>
    </div>
    <modal-template v-bind="{
        title: 'Customer Reservaion', 
        step: this.reservation,
        buttonTitle: ['Remove']
      }" @onClose="hideModal()" @onCancel="hideModal()" @onNextStep="remove()">
      <customer-reservation slot="1" v-bind="{
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
        status: (this.reservationsList[selectedReservation].paid ? 'Paid': 'Unpaid'),
        address: room.address,
        description: room.description
      }"></customer-reservation>
    </modal-template>

    <modal-template v-bind="{
        title: 'Room Infomation', 
        step: this.roomChange,
        buttonTitle: ['Save']
      }" @onClose="hideModal()" @onCancel="hideModal()" @onNextStep="save()">
      <room-information slot="1" v-bind="{
        roomName: room.name,
        roomType: room.type,
        floor: room.floor,
        seat: room.seat,
        status: room.status,
        price: room.price,
        openTime: '6:00',
        closeTime: '22:00',
        address: room.address,
        description: room.description
      }" ></room-information>
    </modal-template>
  </div>
</template>
<script>
import InformationBlock from '@/components/InformationBlock.vue'
import ReservationBlock from '@/components/ReservationBlock.vue'
import ModalTemplate from '@/components/ModalTemplate.vue';
import PageTitle from '../components/PageTitle.vue'
import Reservation from '../../../../New folder/web-assignment/client/src/views/Reservation.vue';
import ReservationInfo from '../components/ReservationInfo.vue';
import moment from 'moment'
import CustomerReservation from '../components/modals/reservation/CustomerReservation.vue';
import RoomInformation from '../components/modals/room/RoomInformation.vue';
export default {
  components: { InformationBlock, ReservationBlock, ModalTemplate, PageTitle, Reservation, ReservationInfo, CustomerReservation, RoomInformation },
  props: {},
  data() {
    return {
      reservationsList: [
        {
        user: 'Cu Meo',
        reserveDate: Date(),
        duration: "4hr",
        price: 100,
        img: String,
        paid: true,
        showMiddle: false
        },
        {
        user: 'Cu Meo',
        reserveDate: Date(),
        duration: "4hr",
        price: 100,
        img: String,
        paid: false,
        showMiddle: false
        },
        {
        user: 'Cu Meo',
        reserveDate: Date(),
        duration: "4hr",
        price: 100,
        img: String,
        paid: true,
        showMiddle: false
        },
        {
        user: 'Cu Meo',
        reserveDate: Date(),
        duration: "4hr",
        price: 100,
        img: String,
        paid: false,
        showMiddle: false
        },
        {
          user: 'Cu Meo',
        reserveDate: Date(),
        duration: "4hr",
        price: 120,
        img: String,
        paid: true,
        showMiddle: false
        },
        {
          user: 'Cu Meo',
        reserveDate: Date(),
        duration: "4hr",
        price: 100,
        img: String,
        paid: false,
        showMiddle: false
        }

      ],
      roomList: [
          {
            img: 'https://st.depositphotos.com/3386033/5109/i/600/depositphotos_51097627-stock-photo-banquet-hall-with-colorful-lights.jpg',
            name: 'Hall 1',
            floor: 3,
            seat: 80,
            address: '1 Vo Van Ngan, Thu Duc City',
            status: 'Available',
            type: 'Hall',
            comments: [],
            id: 1,
            description: 'Lorem ipsum',
            price: 50,
          },
          {
            img: 'https://st.depositphotos.com/3386033/5109/i/600/depositphotos_51097627-stock-photo-banquet-hall-with-colorful-lights.jpg',
            name: 'Hall 2',
            floor: 3,
            seat: 80,
            address: '1 Vo Van Ngan, Thu Duc City',
            status: 'Available',
            type: 'Hall',
            id: 2,
            description: 'Lorem ipsum',
            price: 50,
          },
          {
            img: 'https://st.depositphotos.com/3386033/5109/i/600/depositphotos_51097627-stock-photo-banquet-hall-with-colorful-lights.jpg',
            name: 'Hall 3',
            floor: 3,
            seat: 80,
            address: '1 Vo Van Ngan, Thu Duc City',
            status: 'Unavailable',
            type: 'Hall',
            id: 3,
            description: 'Lorem ipsum',
            price: 50,
          }

        ],
        roomID: Number,
        room: {
          img: '',
            name: '',
            floor: Number(),
            seat: Number(),
            address: '',
            status: '',
            type: '',
            id: Number(),
            description: '',
            price: Number(),
        },
        reservation: -1,
        selectedReservation: Number(),
        roomChange: -1,
        roomIndex: Number(),
    }
  },

  

  methods: {
    remove: function(){
      let removed = true;
      if (removed) {
        // remove from db
      }
      else {
        //back
      }
      this.reservation = -1;
    },
    save: function(){
      let saved = true;
      if (saved) {
        // save to db
      }
      else {
        //back
      }
      this.roomChange = -1;
    },
    showReservation: function(index){
      this.selectedReservation = index;
      this.reservation = 0;
    },

    hideModal: function(){
      this.reservation = -1;
      this.roomChange = -1;
    },
    showRoomModal: function () {
      this. roomChange = 0;
    } ,
    getRoom: function() {
    // get room and reservation list from db
    for (let index = 0; index < this.roomList.length; index++) {
      const element = this.roomList[index];
      if (element.id == parseInt(this.$route.params.roomId)) {
        Object.assign(this.room, element);
        break;
        }

    }
    return this.room;
    
  },
  }
}
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
  width: 95%;
}

.title {
  margin: 0 auto;
  text-align: center;
}

 @media only screen and (max-width: 768px) {
        .main {
          display: block;
        }
    }
</style>