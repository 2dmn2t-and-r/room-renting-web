<template>
  <div class="room">
    <div class="page-container">
      <page-title title="Book Now" class="title"/>

      <div class="main"> 
        <div class="sidebar">
          <side-bar-room-type :types='type'></side-bar-room-type>
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
              @click.native="showModal(index)"
            />
          </div>
          
        </div>
        
      </div>

    </div>
    
    <modal-template  v-bind="{ 
      title: 'Reservation',
      step: this.step,
      buttonTitle: ['Next', 'Next', 'OK']
    }" @onClose="hide()" @onCancel="hide()" @onNextStep="next()">
      <room-reserve-step-1 slot="1" v-bind="{
        title: this.roomList[this.selected].name,
        img: this.roomList[this.selected].img,
        floor: this.roomList[this.selected].floor,
        seat: this.roomList[this.selected].seat,
        status: this.roomList[this.selected].status,
        type: this.roomList[this.selected].type,
        address: this.roomList[this.selected].address,
        description: this.roomList[this.selected].description,
        comments: this.roomList[this.selected].comments,
      }">   </room-reserve-step-1>

      <room-reserve-step-2 slot="2" v-bind="{
        chosenDate: Date(),
        price: 100,
       
      }">  </room-reserve-step-2> 
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
            id: 1
          },
          {
            img: 'https://st.depositphotos.com/3386033/5109/i/600/depositphotos_51097627-stock-photo-banquet-hall-with-colorful-lights.jpg',
            name: 'Hall 2',
            floor: 3,
            seat: 80,
            address: '1 Vo Van Ngan, Thu Duc City',
            status: 'Available',
            type: 'Hall',
            id: 2
          },
          {
            img: 'https://st.depositphotos.com/3386033/5109/i/600/depositphotos_51097627-stock-photo-banquet-hall-with-colorful-lights.jpg',
            name: 'Hall 3',
            floor: 3,
            seat: 80,
            address: '1 Vo Van Ngan, Thu Duc City',
            status: 'Unavailable',
            type: 'Hall',
            id: 3
          }

        ],
        type: [
          'Hall',
          'Meeting room',
          'Stage'
        ],
        step: Number,
        selected: 0,
      }
    },
    methods: {
      showModal: function(index) {
          if (this.step == -1) this.step = 1;
          this.selected = index;
      },

      hide: function() {
        this.step = -1;
      },

      next: function() {
        this.step += 1;
        if (this.step > 3) this.step = -1;
      }
      
    },
    beforeMount: function(){
      this.step = -1;
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
  }

  .sidebar {
    flex-basis: 20%;
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
    
    padding: 18px 18px;
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

