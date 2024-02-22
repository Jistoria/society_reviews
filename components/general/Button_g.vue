<script setup>
const bg_ver = VerificacionE(); 
</script>
<template>
    <button  class="btn " :class="{'btn_mode_blue': bg_ver.isChecked}">
        <slot />
    </button>
    
</template>
<style>
.btn_mode_blue{
    background: rgb(52, 143, 213) !important;
    border: 1px solid rgb(52, 143, 213) !important;
}
.btn_mode_blue:hover{
    background: rgb(52, 143, 213) !important;
}

</style>