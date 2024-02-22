<script setup>
const bg_ver = VerificacionE();
// bg_ver.isChecked
</script>
<template>
    <div class="main_pc_body" 
        :class="{ 'main_pc_body_blue': bg_ver.isChecked }" >

        <HeadCentral  class="main_pc_header" 
        :class="{' header_blue ': bg_ver.isChecked }"
        ></HeadCentral>
        
        <div class="main_pc">
            <slot  />
        </div>
        <Footer class="main_pc_footer" 
        :class="{'footer_blue': bg_ver.isChecked }"
        />
    </div>
</template>
<style>
/* cambios de estilo a tipo light */
.main_pc_body_blue {
    background: #13172e!important; /* Cambiar el color de fondo cuando backgroundActive es verdadero */
    transition: 0.3s; 
}
.header_blue{
    background: #101424  !important;
    border-bottom: 1px solid white !important;
}
.footer_blue{
    background-color: #11051f;
    border-top: 1px solid white !important;

}

</style>
