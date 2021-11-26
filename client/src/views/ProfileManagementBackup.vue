<template>
  <div class="profile-management">
    <div class="page-container">
      <page-title title="Profile"/>
      <div class="content">
        <div class="avt-box">
          <avatar v-bind="{
            avt: 'https://picsum.photos/200/300',
            username: username,            
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
            :value.sync="userId"
            v-bind:disable="true"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="Email:"
            type="text"
            :value.sync="email"
            v-bind:disable="true"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="Address:"
            type="text"
            :value.sync="address"
            v-bind:disable="true"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="Birthday:"
            type="date"
            :value.sync="birthday"
            v-bind:disable="true"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="Phone number:"
            type="text"
            :value.sync="phone"
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
      @onNextStep="editProfile()"
      >
        <div slot="1" class="change-form">
          <theme-input
            class="input-box"
            label="User name:"
            type="text"
            :value.sync="modal_username"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="Address:"
            type="text"
            :value.sync="modal_address"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="Birthday:"
            type="date"
            :value.sync="modal_birthday"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="Phone number:"
            type="text"
            :value.sync="modal_phone"
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
      @onNextStep="changePassword()"
      >
        <div slot="1" class="change-form">
          <theme-input
            class="input-box"
            label="Old password:"
            type="password"
            :value.sync="modal_password"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="New password:"
            type="password"
            :value.sync="modal_newPassword"
          >
          </theme-input>
          <theme-input
            class="input-box"
            label="Confirm new password:"
            type="password"
            :value.sync="modal_confirmNewPassword"
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
  import {getDataAPI, postDataAPI} from '../utils/fetchData';
  import HeaderBar from '../components/HeaderBar.vue';

  export default {
    name: 'Profile',
    components: {
      ModalTemplate,
      ThemeInput,
      PageTitle,
      Avatar,
      ThemeButton,
      HeaderBar,
    },
    data() {
      return {
        profileModalStep: -1,
        changepassModalStep: -1,
        userId: "",
        email: "",
        address: "",
        birthday: "",
        username: "",
        phone: "",
        modal_address: "",
        modal_birthday: "",
        modal_username: "",
        modal_phone: "",
        modal_password: "",
        modal_newPassword: "",
        modal_confirmNewPassword: "",
      }
    },
    methods: {
      setProfileModalStep(val) {
        if (val === 0) {
          this.modal_address = this.address;
          this.modal_birthday = this.birthday;
          this.modal_username = this.username;
          this.modal_phone = this.phone;
        }
        this.profileModalStep = val;
      },
      setChangepassModalStep(val) {
        if (val === 0) {
          this.modal_password = ""
          this.modal_newPassword = ""
          this.modal_confirmNewPassword = ""
        }
        this.changepassModalStep = val;
      }, 
      async editProfile() {
        var token = localStorage.getItem('token');
        var res = await postDataAPI('auth/uploadProfile', {
          username: this.modal_username,
          sex: "M",
          birthday: this.modal_birthday,
          phone: this.modal_phone,
          address: this.modal_address,
          avatar: "",
        }, token);
        if (res.data["status"] === 200) {
          this.address = this.modal_address;
          this.birthday = this.modal_birthday;
          this.username = this.modal_username;
          this.phone = this.modal_phone;
          this.setProfileModalStep(-1)
        }
      },
      async changePassword() {
        if (this.modal_newPassword === this.modal_confirmNewPassword) {
          var token = localStorage.getItem('token');
          var res = await postDataAPI('auth/changePassword', {
            oldPassword: this.modal_password,
            newPassword: this.modal_newPassword,
          }, token);
          if (res.data["status"] === 200) {
            this.setChangepassModalStep(-1)
          }
          else {
            alert("Wrong password!")
          }
        }
        else {
          alert("Please fill in a valid value!")
        }
      }
    },
    mounted() {
      (async () => {
        var token = localStorage.getItem("token");
        if (token) {
          let res = await getDataAPI('auth/get', token);
          if (res.data["status"] === 200) {
            this.userId = res.data["user"]["userId"];
            this.email = res.data["user"]["email"];
            this.address = res.data["user"]["address"];
            this.birthday = res.data["user"]["birthday"];
            this.username = res.data["user"]["username"];
            this.phone = res.data["user"]["phone"];
          }
        }
        else {
          this.userId = "";
          this.email = "";
          this.address = "";
          this.birthday = "";
          this.username = "";
          this.phone = "";
        }
      })()
    },
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