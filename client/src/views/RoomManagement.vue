<template>
  <div class="room-management">
    <div class="page-container">
      <page-title title="Room Manage"/>
      <div class="main"> 
        <div class="sidebar">
          <side-bar-room-type :types="type" :chosen_index="chosenIndex" @updateIndex="chosenIndex = $event; refreshList(); curPage = 1"></side-bar-room-type>
          <theme-button class="btn" v-bind="{
            msg: 'Create',
            color: 'var(--theme_white)',
            background_color: 'var(--theme_jade)',
            width: '90%',
            height: '5vh'
          }" @click.native="showModal()"></theme-button>
        </div>
        <div class="right-bar">
          <div class="card-container" :key="refresh">
            <div class="card" v-for="(room, index) in roomListFilter" :key="index" :id="index" >
              <room-card class="margin-item"  v-bind="{
                img: room.image,
                name: room.roomName,
                floor: parseInt(room.floor),  
                seat: parseInt(room.seat),
                address: room.address,
                status: (room.statusRo == 'A' ? 'Available' : 'Unavailable')
              }" 
                @click.native="intoDetail(index)"
              />
              
            </div>
            <div style="min-height: 1px"> </div>
          </div>
          <div style="min-height: 20px"> </div>
          <theme-pagination v-bind="{
            totalItem: roomList.length,
            pageItem: pageItem,
          }" :curPage.sync="curPageChangable" :key="refreshPagination"/>
        </div>
      </div>
      <modal-template v-bind="{
        title: 'Add A Room',
        step: this.step,
        buttonTitle: ['Add']
      }" @onClose="hideModal()" @onCancel="hideModal()" @onNextStep="add()">
        <add-room slot="1"
          :img.sync="addedRoom.image"
          :roomName.sync="addedRoom.roomName"
          :roomType.sync="addedRoom.type"
          :floor.sync="addedRoom.floor"
          :seat.sync="addedRoom.seat"
          :status.sync="addedRoom.status"
          :price.sync="addedRoom.price"
          :openTime.sync="addedRoom.openTime"
          :closeTime.sync="addedRoom.closeTime"
          :address.sync="addedRoom.address"
          :description.sync="addedRoom.description"
          :types="type"
        ></add-room>

      </modal-template>
    </div>
  </div>
</template>
<script>
  import ModalTemplate from '@/components/ModalTemplate.vue';
  import RoomCard from '@/components/RoomCard.vue';
  import PageTitle from '../components/PageTitle.vue'
  import SideBarRoomType from '../components/SideBarRoomType.vue';
import ThemeButton from '@/components/ThemeButton.vue';

import AddRoom from '@/components/modals/room/AddRoom.vue';
import moment from 'moment';
import { getDataAPI, postDataAPI } from '../utils/fetchData';
import { uploadImage } from '../utils/uploadImage';
import ThemePagination from '../components/ThemePagination.vue';

export default {
  components: {
    ModalTemplate,
    RoomCard,
    PageTitle,
    SideBarRoomType,
    ThemeButton,
    AddRoom,
    ThemePagination,
  },
  data (){
        
      return {
        roomList: [],
        step: -1,
        selected: 0,
        addedRoom: {
          roomName: '', 
          type: '',
          floor: 0,
          seat: 0,
          price: 0,
          statusRo: 'Available',
          openTime: '6:00',
          closeTime: '22:00',
          address: '',
          description: '',
          image: '',
        },
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
        chosenIndex: 0,
        refresh: 0,
        chosenId: 0,
        curPage: 1,
        pageItem: 5,
        refreshPagination: 2
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
      hideModal: function(){
        this.step = -1;
      },

      showModal: function() {
        this.resetAddedRoom();
        this.step = 0;
      },

      add: function(){
        (async () => {
          var token = localStorage.getItem("token");
          this.addedRoom.type = this.addedRoom.type.substring(0, 1);
          this.addedRoom.statusRo = this.addedRoom.statusRo.substring(0, 1);
          let res = await postDataAPI('room/upload', this.addedRoom, token);
          console.log(this.addedRoom);
          console.log(res.data);
          if (res.data["status"] === 200) {
            this.step = -1;
            await this.refreshList();
            this.refreshPagination = 1 - this.refreshPagination;
          }
          else {
            if (res.data["msg"])
              alert(res.data["msg"]);
            else alert("Connection error. Try again.")
          }
          
        })()
      },

      async refreshList() {
        var token = localStorage.getItem("token");
        let res = await getDataAPI(`rooms/load/${this.typeChar[this.chosenIndex]}`, token);
        if (res.data["status"] === 200) {
          this.roomList = res.data["rooms"];
        }
        this.refresh = 1 - this.refresh;
      },

      intoDetail: function(index) {
        this.$router.push(this.$router.history.current.path + '/' + this.roomListFilter[index].roomId.toString()).catch(()=>{});
      },

      resetAddedRoom: function() {
        this.addedRoom = {
          roomName: '', 
          type: '',
          floor: 0,
          seat: 0,
          price: 0,
          statusRo: 'Available',
          openTime: '6:00',
          closeTime: '22:00',
          address: '',
          description: '',
          image: '',
        }
      }
    },
    mounted: function(){
      this.step = -1;
      this.refreshList();
    }
}
</script>
<style scoped>
.room-management {
    padding: 20px;
    background-color: var(--theme_white);
    min-height: calc(100vh - 100px);
    
  }

.right-bar {
  width: 100%;
  flex-basis: 80%;
}

  .card-container {
    width: 100%;
    background-color: var(--theme_fore);
    padding: 18px 18px 0px 18px;
    border-radius: 10px;
  }

  .sidebar {
    flex-basis: 20%;
  }

  .page-container {
    width: 100%;
    max-width: 1140px;
    margin: 0 auto;

  }

  .btn{
    margin: 10px auto;
    text-align: center;
    
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
    align-items: flex-start;
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