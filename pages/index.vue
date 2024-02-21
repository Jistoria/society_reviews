<script setup lang="ts">
const loginP= LoginStore();
const detail = async ()=>{
    await loginP.get_session_detail();
}
</script>

<template>
<ButtonG @click="detail" class="btn-primary">tomo</ButtonG>


</template>