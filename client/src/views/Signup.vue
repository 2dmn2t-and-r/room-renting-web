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
              value=""
            /> 
            <theme-input
              class="input-box"
              label="Email:"
              type="text"
              value=""
            /> 
            <theme-input
              class="input-box"
              label="Password:"
              type="password"
              value=""
            /> 
            <theme-input
              class="input-box"
              label="Confirm Password:"
              type="password"
              value=""
            /> 
            <theme-input
              class="input-box"
              label="Birthday:"
              type="date"
              value=""
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
          }"/>
        </div>
      </div>
    </div>
</template>
<script>
import ThemeButton from '../components/ThemeButton.vue'
import ThemeInput from '../components/ThemeInput.vue'

export default {
  name: "Login",
  components: {
    ThemeInput,
    ThemeButton 
  },
  data() {
    return {
      inputs: [
        {
          label: "Username",
          value: "",
          type: 'text'
        },
        {
          label: "Email",
          value: "",
          type: 'email'
        },
        {
          label: 'Password',
          value: "",
          type: 'password'
        },
        {
          label: 'Confirm password',
          value: "",
          type: 'password'
        },
        {
          label: 'Birthday',
          value: "",
          type: 'date'
        }
      ],
      agree: {
        label: "I have agreed with the term of use of this site",
        value: false,
      }
    }
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