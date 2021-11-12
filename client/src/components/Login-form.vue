<template>
    <div class="wrapper">
        <div class="btncontainer">
            <div class="btn">
                
                <router-link :to="{name: 'Login'}">
                    <theme-button msg="Sign In" background_color="#CAA892" class="signin" width="90%" height="40px" ></theme-button>
                </router-link>
                <!-- <theme-button msg="Sign In" background_color="#CAA892" class="signin" width="90%" height="40px" :action="routeTo('/login')"></theme-button> -->
            </div>
            <div class="btn">
                <router-link :to="{name: 'SignUp'}">
                    <theme-button msg="Sign Up" background_color="#37806B" class="signup" width="90%" height="40px" ></theme-button>
                </router-link>
                
                <!-- <theme-button msg="Sign Up" background_color="#37806B" class="signup" width="90%" height="40px" :action="routeTo('/signup')" ></theme-button> -->
            </div>
            
            <div style="clear:both"> </div>
        </div>

        <div class="form-container">
            <form method="POST" @submit.prevent="handleSubmit">
            <custominput v-for="(input, i) in inputs" :key="i"  
                    :label="input.label" 
                    v-model="input.value" 
                    :type="input.type"></custominput>
            <label class="container">
                {{check.label}}
                <input type="checkbox" checked="checked" @change="toggleRemember">

            </label>
            <theme-button type="submit" msg="Accept" width="95%" height="40px" class="accept" ></theme-button>
            </form>
        </div>
       
    
    </div>
    
</template>
<script>
import Custominput from './Custominput.vue'
import ThemeButton from './ThemeButton.vue'
export default {
  components: { Custominput, ThemeButton },
  props: ["inputs", "check"],
  method: {
      handleSubmit: function () {
          console.log("Submitted: ", this.inputs[0].value, this.input[1].value)
      },
      toggleRemember: function () {
          rememberpw.value = !rememberpw.value
      },
      getWidth: function(){
        //   return (window.innerWidth>600? 280 : 200)+"px"
        return "200px";
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
    font-family: Poppins;
    background: #FFFFFF;
    border-radius: 20px;

}
.btncontainer {
    width: 100%;
    height: 15%;
    position: relative;
    display: flex;
}
.btn {
    
    width: 100%;
    height: 100%;
    
}
.signin {
    
   
    float: left;
    width: 40%;
    height: 100%;
    
   
}
.signup {
    
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
    display: flex;;
    padding-left: 2%;
}
.accept:checked {
    background-color: var(--theme_jade)
}
</style>