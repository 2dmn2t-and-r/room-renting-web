<template>
    <div class="container">
      <!-- <projname color="#ffffff" size="2" class="header"></projname> -->
      <div class="logo"> 
        <img class="logo-img" src="@/assets/logo/notext_white.png" width="120" height="120" >
        ROOM PRO
      </div>
      <div class="form-container">
        <login-form :inputs="inputs" :check="agree" class="form"></login-form>
      </div>
         
    </div>
    
</template>
<script>
import LoginForm from '../components/Login-form.vue'

export default {
  name: "Login",
  components: {LoginForm },
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
          value: false
      }
      }
      
  },
    
}
</script>
<style scoped>
.container {
    
    height: 100vh;
    background-color: #37806B;
    
}
.logo {
  display: flex;
  justify-content: center;
  align-items: center;
  padding-top: 3%;
  padding-bottom: 3%;
  font-family: Poppins;
  font-size: 48px;
  font-weight: 300;
  color: white;
}
.logo-img {
  padding-right: 20px;
}



.form {
 
  width: 600px;
  top: 50%;
  left: 50%;
  transform: translateX(-50%);
 
}
@media only screen and (max-width: 600px) {
    .form {
      width: 95%;
    }
}
</style>