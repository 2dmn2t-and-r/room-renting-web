<template>
  <div class="reservation">
    <div class="page-container">
      <page-title title="Reservation History"/>
      <div class="mai">
        <div class="grow1">
          <side-bar-reserve-time/>
        </div>
        <div style="min-height: 10px; min-width: 10px;"> </div>
        <div class="grow4">
          <div v-for="(item, index) in reserveList" :key="index">
            <reservation-card v-bind="{
              img: item.img,
              name: item.name,
              floor: item.floor,
              seat: item.seat,
              address: item.address,
              startdate: dateString(item.startdate),
              duration: item.duration
            }" @click.native="changeModal()"
            />
            <div style="min-height: 18px;"> </div>
          </div>
        </div>
      </div>
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
import CustomerReservation from '../components/modals/reservation/CustomerReservation.vue'
import ModalTemplate from '../components/ModalTemplate.vue'
import PageTitle from '../components/PageTitle.vue'
import ReservationCard from '../components/ReservationCard.vue'
import SideBarReserveTime from '../components/SideBarReserveTime.vue'
export default {
  components: { PageTitle, SideBarReserveTime, ReservationCard, ModalTemplate, CustomerReservation },
  data() {
    return {
      reserveList: [
        {
          img: 'https://i.9mobi.vn/cf/images/2015/03/nkk/nhung-hinh-anh-dep-19.jpg',
          name: 'Hall 1',
          floor: 12,
          seat: 40,
          address: 'Chị Trang ở với Chí Trung',
          startdate: new Date(),
          duration: '4 hours'
        },
        {
          img: 'https://i.9mobi.vn/cf/images/2015/03/nkk/nhung-hinh-anh-dep-19.jpg',
          name: 'Hall 2',
          floor: 14,
          seat: 40,
          address: 'Chị Trang ở với Chí Trung',
          startdate: new Date(),
          duration: '4 hours'
        },
        {
          img: 'https://i.9mobi.vn/cf/images/2015/03/nkk/nhung-hinh-anh-dep-19.jpg',
          name: 'Hall 3',
          floor: 16,
          seat: 40,
          address: 'Chị Trang ở với Chí Trung',
          startdate: new Date(),
          duration: '4 hours'
        }
      ],
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
  .reservation {
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

  .mai {
    display: flex;
    flex-direction: row;
  }

  .grow1 {
    width: 20%;
  }

  .grow4 {
    width: 80%;
    border-radius: 10px;
    background-color: var(--theme_fore);
    padding: 18px 18px 0px 18px;
  }

  @media only screen and (max-width: 768px) {
    .grow1 {
      width: 100%;
      
    }

    .grow4 {
      width: 100%;
    }

    .mai {
      flex-direction: column;
    }
  }
</style>