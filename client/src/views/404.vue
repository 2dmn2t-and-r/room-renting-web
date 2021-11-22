<template>
  <div class="page-404">
    <span class="bold">{{"404"}}</span>
    {{" Not found"}}
  </div> 
</template>

<script>

export default {
  name: 'Home',
  components: {
  }
}
</script>
<style scoped>
.page-404 {
    min-height: calc(100vh - 100px);
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
    background-color: var(--theme_white);
}

.bold {
    font-size: 38px;
    font-weight: 700;
    margin-right: 20px;
    color: var(--theme_jade);
    border-right: var(--theme_jade) solid 4px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-right: 10px;
}
</style>
