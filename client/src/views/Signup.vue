<template>
    <div class="sign-up">
      <div class="logo" @click="$router.push('/').catch(()=>{})"> 
        <img class="logo-img" src="@/assets/logo/logo_white.png" width="60" height="60" />
        ROOM PRO
      </div>
      <div class="container">
        <div class="top">
          <div class="toggle">
            <div class="button">
              <theme-button v-bind="{
                msg: 'Sign In',
                height: '40px',
                width: '100%',
                border_radius: '15px'
              }"
              @click.native="$router.push('/auth/signin').catch(()=>{})"/>
            </div>
            <div class="button">
              <theme-button v-bind="{
                msg: 'Sign Up',
                background_color: 'var(--theme_jade)',
                height: '40px',
                width: '100%',
                border_radius: '15px'
              }"/>
            </div>
          </div>
          <div class="form">
            <theme-input
              class="input-box"
              label="Username:"
              type="text"
              :value.sync="username"
            /> 
            <theme-input
              class="input-box"
              label="Email:"
              type="email"
              :value.sync="email"
            /> 
            <theme-input
              class="input-box"
              label="Password:"
              type="password"
              :value.sync="password"
            /> 
            <theme-input
              class="input-box"
              label="Confirm Password:"
              type="password"
              :value.sync="cPassword"
            /> 
            <theme-input
              class="input-box"
              label="Birthday:"
              type="date"
              :value.sync="date"
            /> 
          </div>
        </div>
        <div class="bottom">
          <theme-button v-bind="{
            msg: 'Accept',
            background_color: 'var(--theme_jade)',
            height: '40px',
            width: '100%',
            border_radius: '15px'
          }"
          @click="signUp"/>
        </div>
      </div>
    </div>
</template>
<script>
import ThemeButton from '../components/ThemeButton.vue'
import ThemeInput from '../components/ThemeInput.vue'
import { getDataAPI, postDataAPI } from '../utils/fetchData'

export default {
  name: "Login",
  components: {
    ThemeInput,
    ThemeButton 
  },
  data() {
    return {
      username: "",
      email: '',
      password: '',
      cPassword: '',
      date: '',
      sex: 'M',
      phone: '',
      address: '',
    }
  },
  methods: {
    verify() {
      if (this.username === "") {
        alert("Username is required!");
        return false;
      }
      else if (this.email.split('@').length !== 2 || this.email.split('@')[1].split('.').length !== 2) {
        alert("Email is invalid!");
        return false;
      }
      else if (this.password.length < 6) {
        alert("Password length is at least 6");
        return false;
      }
      else if (this.password !== this.cPassword) {
        alert("Confirm password does not match");
        return false;
      }
      else if (this.date === "") {
        alert("Birthday is required!");
        return false;
      }
      return true;
    },
    async signUp() {
      var checkForm = this.verify();
      if (!checkForm) return;
      var res = await postDataAPI('auth/register', {
        username: this.username,
        password: this.password,
        email: this.email,
        birthday: this.date,
        sex: this.sex,
        phone: this.phone,
        address: this.address,
        avatar: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXa1s1BI-GgogSRmwZYZiDRGN2Elkr5hfysw&usqp=CAU"
      })
      if (res.data["status"] === 200) {
        this.$router.push('/auth/signin').catch(()=>{})
      }
      else {
        alert("Sign up failed!");
      }
    },
    
  }   
}
</script>
<style scoped>
.sign-up {
  height: 100vh;
  background-color: var(--theme_jade);
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 0 5px 30px 5px;
}

.logo {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 30px 0 30px 0;
  font-family: Poppins;
  font-size: 24px;
  font-weight: 300;
  color: white;
}

.logo:hover {
  cursor: pointer;
}

.logo-img {
  margin-right: 20px;
}

.container {
  width: 100%;
  max-width: 540px;
  background-color: var(--theme_white);
  height: calc(100vh - 150px);
  padding: 30px 28px;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  overflow: hidden;
}

.top {
  width: 100%;
  height: calc(100% - 80px);
}

.toggle {
  display: flex;
  justify-content: space-between;
  margin-bottom: 30px;
  padding: 0 2px;
}

.button {
  width: 47%;
}

.form {
  overflow-y: overlay;
  padding: 0 2px;
  height: calc(100% - 70px);
}

.input-box {
  margin-top: 10px;
}

.bottom {
  width: 100%;
  padding: 0 2px;
}

@media only screen and (max-width: 768px) {
  
}

@media only screen and (max-width: 480px) {
  .container {
    padding: 30px 10px;
  }
}
</style>