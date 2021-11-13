<template>
  <div class="reservation-management">
    <div class="page-container">
      <page-title title="All Reservations"/>
      <reservation-block>
        <div v-for="(item, index) in info_list" :key="index">
          <reservation-info v-bind="{
            user: item.user,
            reserveDate: item.reserveDate,
            showMiddle: item.showMiddle,
            roomName: item.roomName, // Optional if showMiddle
            startDate: item.startDate, // Optional if showMiddle
            duration: item.duration,
            price: item.price,
            img: item.img,
            paid: item.paid
          }" @click.native="changeModal()"/>
          <div class="divider_other"> </div>
        </div>
      </reservation-block>   
    </div>
    <modal-template v-bind="{
      title: 'Reservation',
      step: showModal,
      buttonTitle: ['Remove']
    }" @onClose="changeModal()" @onCancel="changeModal()" @onNextStep="clickRemove()">
      <customer-reservation slot="1" v-bind="{
        title: 'Hall 1',
        status: 'Unpaid'
      }"/>
    </modal-template>
  </div>
</template>

<script>
import CustomerReservation from '../components/modals/reservation/CustomerReservation.vue';
import ModalTemplate from '../components/ModalTemplate.vue';
import PageTitle from '../components/PageTitle.vue'
import ReservationBlock from '../components/ReservationBlock.vue';
import ReservationInfo from '../components/ReservationInfo.vue';
export default {
  components: { PageTitle, ReservationBlock, ReservationInfo, ModalTemplate, CustomerReservation },
  data() {
    return {
      info_list: Array.from({length: 10}, (_, index) => {
        return {
          user: "Cu Meo Num",
          reserveDate: new Date(),
          showMiddle: true,
          roomName: "Hall 1", // Optional if showMiddle
          startDate: new Date(), // Optional if showMiddle
          duration: "4 hours",
          price: 1200,
          img: 'https://i.9mobi.vn/cf/images/2015/03/nkk/nhung-hinh-anh-dep-19.jpg',
          paid: false
        };
      }),
      showModal: -1
    }
  },
  methods: {
    dateString(date) {
      if (date) {
        var year = date.getFullYear();

        var month = (1 + date.getMonth()).toString();
        month = month.length > 1 ? month : '0' + month;

        var day = date.getDate().toString();
        day = day.length > 1 ? day : '0' + day;
        
        return month + '/' + day + '/' + year;
      }
    },
    changeModal: function() {
      this.showModal = -1 - this.showModal;      
    },
    clickRemove: function() {
      this.showModal = -1 - this.showModal;
    }
  }
}
</script>

<style scoped>
  .reservation-management {
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
</style>