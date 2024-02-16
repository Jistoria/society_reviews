<script setup lang="ts">
const loginP= LoginStore();
const detail = async ()=>{
    await loginP.get_session_detail();
}
</script>

<template>
<h1 class="ms-4 mt-3">Cuerpo</h1> 
<ButtonG @click="detail" class="btn-primary">tomo</ButtonG>

</template>

