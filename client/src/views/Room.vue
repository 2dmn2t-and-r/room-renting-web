<template>
  <div class="room">
    <div class="page-container">
      <page-title title="Book Now" class="title"/>
      <div class="main"> 
        <div class="sidebar">
          <side-bar-room-type :types="type" :chosen_index="chosenIndex" @updateIndex="chosenIndex = $event; refreshList();"> </side-bar-room-type>
        </div>
        <div class="left-side" :key="refresh">
          <div class="card-container">
            <div v-for="(room, index) in roomListFilter" :key="index" :id="index">
              <room-card v-bind="{
                img: room.image,
                name: room.roomName,
                floor: parseInt(room.floor),  
                seat: parseInt(room.seat),
                address: room.address,
                status: (room.statusRo == 'A' ? 'Available' : (room.statusRo == 'U' ? 'Unavailable' : 'Removed'))
              }" 
                @click.native="showModal(index)"
              />
              <div style="min-height: 18px;"> </div>
            </div>
            <div style="min-height: 1px;"> </div>
          </div>
          <div style="min-height: 20px"> </div>
          <theme-pagination v-bind="{
            totalItem: roomList.length,
            pageItem: pageItem,
          }" :curPage.sync="curPageChangable"/>
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
        status: this.chosenRoom.statusRo == 'A' ? 'Available' : (this.chosenRoom.statusRo == 'U' ? 'Unavailable' : 'Removed'),
        type: typeCharFull[this.chosenRoom.type],
        address: this.chosenRoom.address,
        description: this.chosenRoom.description,
        comments: comments,
        canComment: userId != '',
        userId: userId
      }" :chosenDate.sync="chosenDate" :key="refresh"/>
      <room-reserve-step-2 slot="2" v-bind="{
        chosenDate: new Date(this.chosenDate),
        startDate: startTime,
        endDate: endTime,
        availableTime: availableTime,
        price: parseInt(this.chosenRoom.price),
        totalPrice: (timeToIndex(this.chosenEndTime) - timeToIndex(this.chosenStartTime)) * parseInt(this.chosenRoom.price)
      }" :key="refresh" :chosenStartTime.sync="chosenStartTime" :chosenEndTime.sync="chosenEndTime"/>      
      <room-reserve-step-3 slot="3"/>
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
  import ThemePagination from '../components/ThemePagination.vue';

  export default {
    name: 'Room',
    components: {
      ModalTemplate,
      PageTitle,
      RoomCard,
      SideBarRoomType,
      RoomReserveStep3, 
      RoomReserveStep2,
      RoomReserveStep1,
      ThemePagination
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
        step: -1,
        selected: 0,
        chosenIndex: 0,
        refresh: 0,
        chosenDate: (new Date()).toISOString().split('T')[0],
        startTime: '06:00',
        endTime: '06:30',
        chosenStartTime: '06:00',
        chosenEndTime: '06:30',
        curPage: 1,
        pageItem: 5,
        userId: "",
        availableTime: []
      }
    },
    computed: {
      curPageChangable: {
        get() {return this.curPage},
        set(val) {this.curPage = val; this.refresh = 1 - this.refresh;}
      },
      firstItem() {
        return (this.curPage - 1) * this.pageItem;
      },
      lastItem() {
        return this.curPage * this.pageItem - 1;
      },
      roomListFilter() {
        return this.roomList.filter((_, i) => (i >= this.firstItem && i <= this.lastItem))
      }
    },
    methods: {
      showModal: function(index) {
          if (this.step == -1) this.step = 1;
          this.selected = index;
          this.chosenRoom = this.roomListFilter[index];
          this.startTime = this.chosenRoom.openTime;
          this.endTime = this.chosenRoom.closeTime;
          this.chosenStartTime = this.startTime;
          this.chosenEndTime = this.startTime;
          this.refresh = 1 - this.refresh;
      },

      hide: function() {
        this.step = -1;
        this.chosenDate = (new Date()).toISOString().split('T')[0];
        this.comments = [];
        this.availableTime = [];
      },
      next: function() {
        if (this.userId == '') {
          this.$router.push('/auth/signin').catch(()=>{});
          return;
        }
        if (this.step == 1) {
          (async () => {
            var token = localStorage.getItem("token");
            let res = await getDataAPI(`room/getAvailableTime/${this.chosenRoom.roomId}/${this.chosenDate}`, token);
            if (res.data["status"] === 200) {
              this.availableTime = res.data['timeframes'];
              this.step += 1;
              this.refresh = 1 - this.refresh;
            }
          })();
          return;
        }
        if (this.step == 2) {
          if ((() => {
            let a = this.chosenStartTime.split(':');
            let b = this.chosenEndTime.split(':');
            return (parseInt(a[0]) * 100 + parseInt(a[1])) < (parseInt(b[0]) * 100 + parseInt(b[1]));
          })())
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
          else alert("Invalid selected timeframe.")
          return;
        }
        this.step += 1;
        if (this.step > 3) {
          this.hide();
        }
      },
      refreshList: function() {
        (async () => {
          var token = localStorage.getItem("token");
          let res = await getDataAPI(`rooms/load/${this.typeChar[this.chosenIndex]}`, token);
          if (res.data["status"] === 200) {
            this.roomList = res.data["rooms"];
          }
          else {
            if (res.data["msg"])
              alert(res.data["msg"]);
            else alert("Connection error. Try again.")
          }
          this.curPage = 1;
          this.refresh = 1 - this.refresh;
        })()
      },      
      timeToIndex: function(time) {
        var res = time.split(':');
        return (parseInt(res[0]) - 6) * 2 + Math.round(parseInt(res[1]) / 30);
      },      
    },
    mounted: function(){
      this.step = -1;
      (async() => {
        var token = localStorage.getItem("token");
        let res = await getDataAPI(`rooms/load/${this.typeChar[this.chosenIndex]}`, token);
        if (res.data["status"] === 200) {
          this.roomList = res.data["rooms"];
        }
        else {
          if (res.data["msg"])
            alert(res.data["msg"]);
          else alert("Connection error. Try again.")
        }
        res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200) {
            this.userId = res.data["user"]["userId"];
        }
        this.curPage = 1;
        this.refresh = 1 - this.refresh;
      })()
    }
  }
</script>

<style>
  .room {
    padding: 20px;
    background-color: var(--theme_white);
    min-height: calc(100vh - 100px);
  }

  .left-side {
    width: calc(100% - 220px);
    padding-left: 20px;
  }

  .card-container {
    width: 100%;
    background-color: var(--theme_fore);
    padding: 18px 18px 0px 18px;
    border-radius: 10px;
  }

  .sidebar {
    width: 220px;
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
    align-items: flex-start;
    flex-basis: 100%;
    margin: 0 auto;
  }

  .margin-item {
    margin-bottom: 18px;
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

    .sidebar {
      width: 100%;
      margin-bottom: 20px;
    }

    .left-side {
      width: 100%;
      padding-left: 0px;
    }
  }
    

  @media only screen and (max-width: 768px) {
      .main {
        display: block;
      }
  }
</style>

