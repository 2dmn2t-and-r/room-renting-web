<template>
    <div class="container">
      <projname color="#ffffff" size="2" class="header"></projname>
      <login-form class="form"></login-form>   
    </div>
    
</template>
<script>
import LoginForm from '../components/Login-form.vue'
import projname from '../components/projname.vue'
export default {
  components: { projname, LoginForm },
    
}
</script>
<style scoped>
.container {
    position: absolute;
    margin: 0 0 0 0;
    width: 100%;
    height: 100%;
    background-color: #37806B;
    
}
.header {
  margin: auto;
  padding-top: 50px;
  top: 50%;
  left: 65%;
  transform: translate(-50%,-50%);
  width: 50%;
 
  
}
.form {
  width: 600px;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
 
}
</style>