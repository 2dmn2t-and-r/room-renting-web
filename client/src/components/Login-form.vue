<template>
    <div class="wrapper">
        <div class="btncontainer">
            <div class="btn">
                <theme-button msg="Sign In" background_color="#CAA892" class="signin" width="280px"></theme-button>
            </div>
            <div class="btn">
                <theme-button msg="Sign Up" background_color="#37806B" class="signup" width="280px"></theme-button>
            </div>
            
            <div style="clear:both"> </div>
        </div>

        <div class="form-container">
            <form method="POST" @submit.prevent="handleSubmit()">
            <custominput v-for="(input, i) in inputs" :key="i"  
                    :label="input.label" 
                    v-model="input.value" 
                    :type="input.type"></custominput>
            <label class="container">
                {{this.rememberpw.label}}
                <input type="checkbox" checked="checked" @change="toggleRemember()">

            </label>
            <theme-button type="submit" msg="Accept" width="580px" class="accept" @click="handleSubmit()"></theme-button>
            </form>
        </div>
       
    
    </div>
    
</template>
<script>
import Custominput from './Custominput.vue'
import ThemeButton from './ThemeButton.vue'
export default {
  components: { Custominput, ThemeButton },
  data() {
      return {
     inputs: [
          {
              label: "Email",
              value: "",
              type: 'email'
          },
          {
              label: 'Password',
              value: "",
              type: 'password'
          }
      ],
      rememberpw: {
          label: "Remember password",
          value: false
      }
      }
      
  },
  method: {
      handleSubmit: function () {
          console.log("Submitted: ", this.inputs[0].value, this.input[1].value)
      },
      toggleRemember: function () {
          rememberpw.value = !rememberpw.value
      },
      getWidth: function(){
          return "200px"
      }
  }
    
}
</script>
<style scoped>
.wrapper {
    position: relative;
    width: 100%;
    left: 25%;
    top: 30%;

    background: #FFFFFF;
    border-radius: 20px;

}
.btncontainer {
    width: 100%;
    height: 15%;
    position: relative;
  
}
.btn {
    
    width: 100%;
    height: 100%;
    
}
.signin {
    
    display: flex;
    float: left;
    width: 40%;
    height: 100%;
    
   
}
.signup {
    
    display: flex;
    float: right;
    width: 33.33%;
    box-sizing: border-box;
}
.container {
    display: block;
    padding: 15px;
}
.accept {
    width: 100%;
}
</style>