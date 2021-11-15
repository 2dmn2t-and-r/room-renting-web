<template>
  <div class="home">
    <section-1/>
    <section-2/>
    <section-3/>
    <section-4/>
    <!-- <modal-template v-bind="{
      title: 'Reservation',
      step: 2,
      buttonTitle: ['Save']
    }">
      <room-reserve-step-1 slot="1"/>
      <room-reserve-step-2 slot="2"/>
      <room-reserve-step-3 slot="3"/>
    </modal-template> -->
  </div> 
</template>

<script>
import Section1 from '@/components/home/Section1.vue'
import Section4 from '../components/home/Section4.vue'
import Section2 from '../components/home/Section2.vue'
import Section3 from '../components/home/Section3.vue'
import ModalTemplate from '../components/ModalTemplate.vue'
import CustomerReservation from '../components/modals/reservation/CustomerReservation.vue'
import RoomInformation from '../components/modals/room/RoomInformation.vue'
import RoomReserveStep1 from '../components/modals/room/RoomReserveStep1.vue'
import RoomReserveStep3 from '../components/modals/room/RoomReserveStep3.vue'
import RoomReserveStep2 from '../components/modals/room/RoomReserveStep2.vue'

export default {
  name: 'Home',
  components: {
    Section1,
    Section4,
    Section2,
    Section3,
    ModalTemplate,
    CustomerReservation,
    RoomInformation,
    RoomReserveStep1,
    RoomReserveStep3,
    RoomReserveStep2
  }
}
</script>
<style scoped>

</style>
