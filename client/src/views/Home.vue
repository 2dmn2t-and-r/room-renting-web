<template>
  <div class="home">
    <section-1/>
    <section-2/>
    <section-3/>
    <section-4/>
    <!-- <modal-template v-bind="{
      title: 'Reservation',
      step: 0,
      buttonTitle: ['Remove']
    }">
      <customer-reservation slot="1"/>
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

export default {
  name: 'Home',
  components: {
    Section1,
    Section4,
    Section2,
    Section3,
    ModalTemplate,
    CustomerReservation
  }
}
</script>
<style scoped>

</style>
