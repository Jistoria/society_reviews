<script setup>
const bg_ver = VerificacionE();

</script>
<template>
    <div class="main_pc_body" :class="{ 'background-active': bg_ver.isChecked }" >

        <HeadCentral  class="main_pc_header"></HeadCentral>
        
        <div class="main_pc">
            <slot  />
        </div>
        <Footer class="main_pc_footer" />
    </div>
</template>
<style>
.background-active {
    background-color: lightblue; /* Cambiar el color de fondo cuando backgroundActive es verdadero */
    transition: 0.3s;
  
}

</style>
