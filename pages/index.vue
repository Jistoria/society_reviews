<script setup lang="ts">
const loginP= LoginStore();

const detail = async ()=>{
    await loginP.get_session_detail();
}
definePageMeta({
  middleware:'check-filter'
})
</script>

<template>
<ButtonG @click="detail" class="btn-primary">tomo</ButtonG>
<NuxtLink to="/place/dashboard">
    voy a dashboard de admin
</NuxtLink>
<div>
{{ loginP.url }}
</div>
<div>
  <Main></Main>
</div>
</template>