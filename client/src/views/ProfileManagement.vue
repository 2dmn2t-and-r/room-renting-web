<template>
  <div class="profile-management">
    <div class="page-container">
      <page-title title="Profile"/>
      <div class="content">
        <div class="avt-box">
          <avatar v-bind="{
            avt: 'https://picsum.photos/200/300',
            username: 'Numcumeo',            
          }"/>
          <theme-input
            label="Search for user ID:"
            type="text"
            value=""
            buttonTitle="search"
            :isIconTitle="true"
            buttonWidth = "50px"
          >
          </theme-input>
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
            <theme-button v-bind="{
                msg: 'Change Password',
                height: '40px',
                width: '140px',
                border_radius: '15px'
            }"></theme-button>
            <theme-button v-bind="{
                msg: 'Edit Profile',
                background_color: 'var(--theme_jade)',
                height: '40px',
                width: '140px',
                border_radius: '15px'
            }"></theme-button>
          </div>
        </div>
      </div>
      <modal-template  v-bind="{
        title: 'Reservation',
        step: -1,
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
  </div>
</template>

<script>
  import ModalTemplate from '@/components/ModalTemplate.vue';
  import PageTitle from '../components/PageTitle.vue';
  import Avatar from '../components/profile/Avatar.vue';
  import ThemeButton from '../components/ThemeButton.vue';
  import ThemeInput from '../components/ThemeInput.vue';

  export default {
    name: 'Room',
    components: {
      ModalTemplate,
      ThemeInput,
      PageTitle,
      Avatar,
      ThemeButton,
    }
  }
</script>

<style scoped>
  .profile-management {
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

  .avatar {
    margin-bottom: 20px;
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
      
  }
</style>