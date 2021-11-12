<template>
    <div class="timeline">
        <div class="container">
            <a class="grid-item" v-for="time in times" :key="time" ></a>
        </div>
    </div>
</template>
<script>
export default {
    data(){
       return {
           times: 32
       } 
    }
}
</script>
<style scoped>
    .container {
        display: grid;
        grid-template-columns: repeat(auto-fit,50px);
        grid-template-rows: repeat(auto-fit,50px);
        background-color: var(--theme_brown);
        grid-gap: 5px 5px;
        border: 1px solid;
        
    }
    .grid-item {
        width:45px;
        height:45px;
        background-color: var(--theme_white);
        border-radius: 10%;
        
    }

    .grid-item:active {
        background-color: var(--theme_jade);
    }
    .grid-item:disabled {
        background-color: var(--theme_gray);
    }
</style>