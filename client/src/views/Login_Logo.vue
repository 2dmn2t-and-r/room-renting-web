<template>
<div class="logo-container">    
   <projname size="1" color="#ffffff" class="proj"></projname>
</div>
</template>

<script>
import Logo from '@/components/logo.vue'
import Projname from '../components/projname.vue'
export default {
    name: "Login-logo",
    components: {
        Projname
    }
}
</script>
<style scoped>

.logo-container {
   
    height: 100vh;
    background-color: #37806B;
    
}
.proj {
    position: relative;
    top: 35%;
    left: 35%;
    display: flex;
    align-items: center;
}
</style>