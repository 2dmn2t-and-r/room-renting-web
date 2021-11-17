<template>
  <div class="profile">
    <div class="page-container">
      <page-title title="Profile"/>
      <div class="content">
        <div class="avt-box">
          <avatar v-bind="{
            avt: 'https://picsum.photos/200/300',
            username: 'Numcumeo',
          }"/>
        </div>
        <div class="form-box">
          <theme-input
            class="input-box"
            label="User ID:"
            type="text"
            value=""
            v-bind:disable="true"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="Email:"
            type="text"
            value=""
            v-bind:disable="true"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="Address:"
            type="text"
            value=""
            v-bind:disable="true"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="Birthday:"
            type="date"
            value=""
            v-bind:disable="true"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="Phone number:"
            type="text"
            value=""
            v-bind:disable="true"
          >
          </theme-input>
          <div class="bt-bar">
            <div class="button">
              <theme-button v-bind="{
                msg: 'Change Password',
                height: '40px',
                width: '100%',
                border_radius: '15px'
              }"
              @click.native="setChangepassModalStep(0)"/>
            </div>
            <div class="button">
              <theme-button v-bind="{
                msg: 'Edit Profile',
                background_color: 'var(--theme_jade)',
                height: '40px',
                width: '100%',
                border_radius: '15px'
              }"
              @click.native="setProfileModalStep(0)"/>
            </div>
          </div>
        </div>
      </div>
      <modal-template  v-bind="{
        title: 'Edit Profile',
        step: profileModalStep,
        buttonTitle: ['Edit']
      }"
      @onClose="setProfileModalStep(-1)"
      @onCancel="setProfileModalStep(profileModalStep - 1)"
      @onNextStep="setProfileModalStep(-1)"
      >
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
        title: 'Change Password',
        step: changepassModalStep,
        buttonTitle: ['Change']
      }"
      @onClose="setChangepassModalStep(-1)"
      @onCancel="setChangepassModalStep(changepassModalStep - 1)"
      @onNextStep="setChangepassModalStep(-1)"
      >
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
  </div>
</template>

<script>
  import ModalTemplate from '@/components/ModalTemplate.vue';
  import ThemeInput from '@/components/ThemeInput.vue';
  import PageTitle from '../components/PageTitle.vue';
  import Avatar from '../components/profile/Avatar.vue';
  import ThemeButton from '../components/ThemeButton.vue';

  export default {
    name: 'Profile',
    components: {
      ModalTemplate,
      ThemeInput,
      PageTitle,
      Avatar,
      ThemeButton,
    },
    data() {
      return {
        profileModalStep: -1,
        changepassModalStep: -1,
      }
    },
    methods: {
      setProfileModalStep(val) {
        this.profileModalStep = val;
      },
      setChangepassModalStep(val) {
        this.changepassModalStep = val;
      }
    }
  }
</script>

<style scoped>
  .profile {
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

  .change-form {
    width: 100%;
    padding: 2px 0px 0px 0px;
    max-width: 800px;
    width: 100%;
  }

  .input-box {
    margin-bottom: 10px;
  }

  .content {
    width: 100%;
    display: flex;
  }

  .avt-box {
    width: 220px;
  }

  .form-box {
    width: calc(100% - 220px);
    padding-left: 80px;
  }
  
  .bt-bar {
    display: flex;
    justify-content: space-between;
    margin-top: 60px;
  }

  .button {
    width: 140px;
  }

  @media only screen and (max-width: 768px) {
    .content {
      flex-direction: column;
    }

    .avt-box {
      width: 100%;
      margin-bottom: 40px;
    }

    .form-box {
      width: 100%;
      padding: 0;
      
    }
  }

  @media only screen and (max-width: 480px) {
    .bt-bar {
      flex-direction: column;
      height: 90px;
      justify-content: space-between;
    }
    .button {
      width: 100%;
    }
  }
</style>