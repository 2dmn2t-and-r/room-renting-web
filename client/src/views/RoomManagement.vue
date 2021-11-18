<template>
  <div class="room-management">
    <div class="page-container">
      <page-title title="Room Manage"/>
      <div class="main"> 
        <div class="sidebar">
          <side-bar-room-type :types='type'></side-bar-room-type>
          <theme-button class="btn" v-bind="{
            msg: 'Create',
            color: 'var(--theme_white)',
            background_color: 'var(--theme_jade)',
            width: '90%',
            height: '5vh'
          }" @click.native="showModal()"></theme-button>
        </div>
        <div class="card-container" >
          <div class="card" v-for="(room, index) in roomList" :key="index" :id="index" >
            <room-card class="margin-item"  v-bind="{
              img: room.img,
              name: room.name,
              floor: room.floor,  
              seat: room.seat,
              address: room.address,
              status: room.status 
            }" 
              @click.native="$router.push($router.history.current.path + '/' + roomList[index].id.toString()).catch(()=>{})"
            />
          </div>
          
        </div>
      </div>
      <modal-template v-bind="{
        title: 'Add A Room',
        step: this.step,
        buttonTitle: ['Add']
      }" @onClose="hideModal()" @onCancel="hideModal()" @onNextStep="add()">
      <add-room slot="1" v-model="addedRoom"></add-room>

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

export default {
  components: {
    ModalTemplate,
    RoomCard,
    PageTitle,
    SideBarRoomType,
    ThemeButton,
    AddRoom,

  },
  data (){
        
      return {
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
          }

        ],
        type: [
          'Hall',
          'Meeting room',
          'Stage'
        ],
        step: -1,
        selected: 0,
        addedRoom: {
            img: '',
            name: '',
            floor: Number,
            seat: Number,
            address: '',
            status: '',
            type: '',
            
        }
      }
    },
    methods: {
      hideModal: function(){
        this.step = -1;
      },

      showModal: function() {
        this.step = 0;
      },

      add: function(){
        //prototype
        let added = true;

        if (added) {
          // add room to db
        }
        else {
          // noti for add
        }
        this.step = -1;
      }
    }
}
</script>
<style scoped>
.room-management {
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