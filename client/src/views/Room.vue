<template>
  <div class="room">
    <div class="page-container">
      <page-title title="Book Now" class="title"/>

      <div class="main"> 
        <div class="sidebar">
          <side-bar-room-type :types="type" :chosen_index="chosenIndex" @updateIndex="chosenIndex = $event; refreshList();"> </side-bar-room-type>
        </div>
        <div class="card-container" :key="refresh">
            <div v-for="(room, index) in roomList" :key="index" :id="index">
              <room-card v-bind="{
                img: room.image,
                name: room.roomName,
                floor: parseInt(room.floor),  
                seat: parseInt(room.seat),
                address: room.address,
                status: (room.statusRo == 'A' ? 'Available' : 'Unavailable')
              }" 
                @click.native="showModal(index)"
              />
              <div style="min-height: 18px;"> </div>
            </div>
          <div style="min-height: 1px;"> </div>
        </div>
        
      </div>

    </div>
    
    <modal-template  v-bind="{ 
      title: 'Reservation',
      step: this.step,
      buttonTitle: ['Next', 'Next', 'OK']
    }" @onClose="hide()" @onCancel="hide()" @onNextStep="next()">
      <room-reserve-step-1 slot="1" v-bind="{
        roomId: parseInt(this.chosenRoom.roomId),
        title: this.chosenRoom.roomName,
        img: this.chosenRoom.image,
        floor: parseInt(chosenRoom.floor),
        seat: parseInt(chosenRoom.seat),
        status: this.chosenRoom.statusRo == 'A' ? 'Available' : 'Unavailable',
        type: typeCharFull[this.chosenRoom.type],
        address: this.chosenRoom.address,
        description: this.chosenRoom.description,
        comments: comments,
      }" :chosenDate.sync="chosenDate">   </room-reserve-step-1>

      <room-reserve-step-2 slot="2" v-bind="{
        chosenDate: new Date(this.chosenDate),
        startDate: startTime,
        endDate: endTime,
        price: parseInt(this.chosenRoom.price),
        totalPrice: (timeToIndex(this.chosenEndTime) - timeToIndex(this.chosenStartTime)) * parseInt(this.chosenRoom.price)
      }" :key="refresh" :chosenStartTime.sync="chosenStartTime" :chosenEndTime.sync="chosenEndTime">  </room-reserve-step-2> 
      
      <room-reserve-step-3 slot="3"> </room-reserve-step-3> 
    </modal-template>
  </div>
</template>

<script>
  import ModalTemplate from '@/components/ModalTemplate.vue';
  import RoomCard from '@/components/RoomCard.vue';
  import PageTitle from '../components/PageTitle.vue'
  import SideBarRoomType from '../components/SideBarRoomType.vue';

  import RoomReserveStep3 from '@/components/modals/room/RoomReserveStep3.vue'
  import RoomReserveStep2 from '@/components/modals/room/RoomReserveStep2.vue'
  import RoomReserveStep1 from '@/components/modals/room/RoomReserveStep1.vue'
  import { getDataAPI, postDataAPI } from '../utils/fetchData';
import moment from 'moment';

  export default {
    name: 'Room',
    components: {
      ModalTemplate,
      PageTitle,
      RoomCard,
      SideBarRoomType,
      RoomReserveStep3, 
      RoomReserveStep2,
      RoomReserveStep1
    },
    data (){
      return {
        roomList: [],
        chosenRoom: {
          roomId: 0,
          roomName: '', 
          type: '',
          floor: 0,
          seat: 0,
          price: 0,
          statusRo: 'A',
          openTime: new Date(),
          closeTime:	new Date(),
          address: '',
          description: '',
          image: '',
        },
        comments: [],
        type: [
          'Hall',
          'Meeting room',
          'Stage'
        ],
        typeChar: ['hall', 'meeting_room', 'stage'],
        typeCharFull: {
          'H': 'Hall',
          'M': 'Meeting room',
          'S': 'Stage'
        },
        step: Number,
        selected: 0,
        chosenIndex: 0,
        refresh: 0,
        chosenDate: moment(new Date()).format("YYYY-MM-DD"),
        startTime: '06:00',
        endTime: '06:30',
        chosenStartTime: '06:00',
        chosenEndTime: '06:30',
      }
    },
    methods: {
      showModal: function(index) {
          if (this.step == -1) this.step = 1;
          this.selected = index;
          this.chosenRoom = this.roomList[index];
          this.startTime = this.chosenRoom.openTime;
          this.endTime = this.chosenRoom.endTime;
          this.chosenStartTime = this.startTime;
          this.chosenEndTime = this.startTime;
          this.refresh = 1 - this.refresh;
      },

      hide: function() {
        this.step = -1;
      },

      next: function() {
        if (this.step == 2) {
          (async () => {
            var token = localStorage.getItem("token");
            let res = await postDataAPI('reservation/upload', {
              useDate: this.chosenDate, 
              startTime: this.chosenStartTime, 
              endTime: this.chosenEndTime,
              totalPrice: (this.timeToIndex(this.chosenEndTime) - this.timeToIndex(this.chosenStartTime)) * parseInt(this.chosenRoom.price),
              statusR: 'U',
              roomId: this.chosenRoom.roomId
            }, token);
            if (res.data["status"] === 200) {
              if (res.data["result"] !== false) {
                this.step += 1;
              }
              else {
                alert(res.data["msg"]);
              }
            }
          })();
          return;
        }
        this.step += 1;
        if (this.step > 3) this.step = -1;
      },

      refreshList: function() {
        (async () => {
          var token = localStorage.getItem("token");
          let res = await getDataAPI(`rooms/load/${this.typeChar[this.chosenIndex]}`, token);
          if (res.data["status"] === 200) {
            this.roomList = res.data["rooms"];
          }
          this.refresh = 1 - this.refresh;
        })()
      },
      
      timeToIndex: function(time) {
        var res = time.split(':');
        return (parseInt(res[0]) - 6) * 2 + Math.round(parseInt(res[1]) / 30);
      }
    },
    beforeMount: function(){
      this.step = -1;
      this.refreshList();
    }
  }
</script>

<style>
  .room {
    padding: 20px;
    background-color: var(--theme_white);
    min-height: calc(100vh - 100px);
    
  }

  .card-container {
    width: 100%;
    flex-basis: 80%;
    background-color: var(--theme_fore);
    padding: 18px 18px 0px 18px;
    border-radius: 10px;
  }

  .sidebar {
    flex-basis: 20%;
    min-width: 200px;
  }

  .page-container {
    width: 100%;
    max-width: 1140px;
    margin: 0 auto;

  }

  .title {
    margin: 0 auto;
    text-align: center;
  }

  .main {
    width: 100%;
    border-radius: 10px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    flex-basis: 100%;
    margin: 0 auto;
  }

  .margin-item {
    margin-bottom: 18px;
  }

   @media only screen and (max-width: 768px) {
        .main {
          display: block;
        }
    }
  .timeline {
    width: 100%;
    max-width: 1140px;
    margin: 0 auto;
    display: block;
    
  }

   @media only screen and (max-width: 768px) {
        .main {
          display: block;
        }
    }
</style>

