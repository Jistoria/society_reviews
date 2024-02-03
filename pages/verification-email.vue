<script setup>
import { getCurrentInstance } from 'vue';
const Vemail = VerificacionE();
const instance = getCurrentInstance();
onMounted(async()=>{
    console.log('se monto')
    const id = instance.proxy.$route.query.id;
    const hash = instance.proxy.$route.query.hash;


    await Vemail.check({id,hash});
})
</script>
<template>

    <div>
    <h1>esto es un placeholder muy inestable</h1>
    <h1>Verificación de Email </h1>
    <p>ID: {{ $route.query.id }}</p>
    <p>Hash: {{ $route.query.hash }}</p>
  </div>

</template>
