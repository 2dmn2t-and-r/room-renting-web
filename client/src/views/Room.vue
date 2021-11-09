<template>
  <div class="room">
    <theme-input
      type="text"
      value="12"
      buttonTitle="clear"
      buttonWidth = "50px"
    >
    </theme-input>
    
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
  import Custominput from '@/components/Custominput.vue';
  import ThemeInput from '@/components/ThemeInput.vue';
  import HeaderBar from '@/components/HeaderBar.vue';

  export default {
    name: 'Room',
    components: {
      ModalTemplate,
      Custominput,
      ThemeInput,
      HeaderBar,
    }
  }
</script>

<style>
  .room {
    background-color: var(--theme_white);
    height: 1000px;
  }
</style>

