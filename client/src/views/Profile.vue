<template>
  <div class="profile">

    <modal-template  v-bind="{
      title: 'Reservation',
      step: 0,
      buttonTitle: ['Next', 'Next', 'OK']
    }">
      <div slot="1" class="change-form">
        <theme-input
          class="input-box"
          label="User name:"
          type="text"
          value=""
        >
        </theme-input>
        <theme-input
          class="input-box"
          label="Email:"
          type="text"
          value=""
        >
        </theme-input>
        <theme-input
          class="input-box"
          label="Address:"
          type="text"
          value=""
        >
        </theme-input>
        <theme-input
          class="input-box"
          label="Birthday:"
          type="date"
          value=""
        >
        </theme-input>
        <theme-input
          class="input-box"
          label="Phone number:"
          type="text"
          value=""
        >
        </theme-input>
      </div>
    </modal-template>
    <modal-template  v-bind="{
      title: 'Reservation',
      step: -1,
      buttonTitle: ['Next', 'Next', 'OK']
    }">
      <div slot="1" class="change-form">
        <theme-input
          class="input-box"
          label="Old password:"
          type="password"
          value=""
        >
        </theme-input>
        <theme-input
          class="input-box"
          label="New password:"
          type="password"
          value=""
        >
        </theme-input>
        <theme-input
          class="input-box"
          label="Confirm new password:"
          type="password"
          value=""
        >
        </theme-input>
      </div>
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

<style scoped>
  .change-form {
    width: 100%;
    padding: 2px 0px 0px 0px;
    max-width: 800px;
    width: 100%;
  }

  .input-box {
    margin-bottom: 10px;
  }
</style>