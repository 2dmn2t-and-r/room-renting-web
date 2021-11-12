<template>
  <div class="room">
    <div class="page-container">
      <page-title title="Book Now"/>

      <div class="main">
        <div class="sidebar">
          <side-bar-room-type :types='type'></side-bar-room-type>
        </div>
        <div class="card-container">
          <room-card class="margin-item" v-for="(room, index) in roomList" :key="index" v-bind="{
            img: room.img,
            name: room.name,
            floor: room.floor,
            seat: room.seat,
            address: room.address,
            status: room.status
        }"/>
        </div>
        
      </div>
    </div>
    
    <modal-template  v-bind="{
      title: 'Reservation',
      step: -1,
      buttonTitle: ['Next', 'Next', 'OK']
    }">
      <div slot="1">1</div>
      <div slot="2">2</div>
      <div slot="2">3</div>
    </modal-template>
  </div>
</template>

<script>
  import ModalTemplate from '@/components/ModalTemplate.vue';
  import RoomCard from '@/components/RoomCard.vue';
  import PageTitle from '../components/PageTitle.vue'
import SideBarRoomType from '../components/SideBarRoomType.vue';
  export default {
    name: 'Room',
    components: {
      ModalTemplate,
      PageTitle,
      RoomCard,
        SideBarRoomType
    },
    data () {
      return {
        roomList: [
          {
            img: 'https://st.depositphotos.com/3386033/5109/i/600/depositphotos_51097627-stock-photo-banquet-hall-with-colorful-lights.jpg',
            name: 'Hall 1',
            floor: 3,
            seat: 80,
            address: '1 Vo Van Ngan, Thu Duc City',
            status: 'Available'
          },
          {
            img: 'https://st.depositphotos.com/3386033/5109/i/600/depositphotos_51097627-stock-photo-banquet-hall-with-colorful-lights.jpg',
            name: 'Hall 1',
            floor: 3,
            seat: 80,
            address: '1 Vo Van Ngan, Thu Duc City',
            status: 'Available'
          },
          {
            img: 'https://st.depositphotos.com/3386033/5109/i/600/depositphotos_51097627-stock-photo-banquet-hall-with-colorful-lights.jpg',
            name: 'Hall 1',
            floor: 3,
            seat: 80,
            address: '1 Vo Van Ngan, Thu Duc City',
            status: 'Unavailable'
          }

        ],
        type: [
          'Hall',
          'Meeting room',
          'Stage'
        ]
      }
    }
  }
</script>

<style>
  .room {
    padding: 20px;
    background-color: var(--theme_white);
    min-height: calc(100vh - 100px);
    display: flex;
    justify-content: center;
  }

  .card-container {
    width: 100%;
  }

  .sidebar {
    flex-basis: 20%;
  }

  .page-container {
    width: 100%;
    max-width: 1140px;
    

  }

  .main {
    width: 100%;
    
    padding: 18px 18px;
    border-radius: 10px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    
    
  }

  .margin-item {
    margin-bottom: 18px;
  }

   @media only screen and (max-width: 768px) {
        .main {
          display: block;
        }
    }
</style>

