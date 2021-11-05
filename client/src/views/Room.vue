<template>
  <div class="room">
    <h1>Page này của Đức không đc đụng vô !!!!</h1>
    <modal-template  v-bind="{
      title: 'Reservation',
      step: 2,
      buttonTitle: ['Next', 'Next', 'OK']
    }">
      <div slot="1">1</div>
      <div slot="2">2</div>
    </modal-template>
  </div>
</template>

<script>
  import ModalTemplate from '@/components/ModalTemplate.vue'

  export default {
  name: 'Room',
  components: {
    ModalTemplate,
  }
}
</script>

