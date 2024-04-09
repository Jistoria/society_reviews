<script setup>
const loading = ref(true);
const route = useRoute();
onMounted(() => {
  loading.value = false;
});
const bg_ver = VerificacionE();
//rutas para donde el footer no debe aparecer

const route_remove = ()=>{
  if(route.name  == 'place-dashboard'){
    return false;
  }else{
    return true;
  }
}
</script>

<template>
    <div class="main_pc_body" 
        :class="{ 'main_pc_body_blue': bg_ver.isChecked }" >

        <HeadCentral  class="main_pc_header" 
        :class="{' header_blue ': bg_ver.isChecked }"
        ></HeadCentral>

        <div class="main_pc">
            <slot  />
            <!-- Div sin nombre para colocar tu loader -->
            <div class="loader-overlay" v-if="loading">
                <!-- Coloca tu loader aquí -->
                <div class="dots-3"></div>
            </div>
        </div>
        <Footer v-if="route_remove()" class="main_pc_footer" 
        :class="{'footer_blue': bg_ver.isChecked }"
        />
    </div>
</template>

<style>
/* Cambios de estilo a tipo light */
.main_pc_body_blue {
    background: #13172e!important; /* Cambiar el color de fondo cuando backgroundActive es verdadero */
    transition: 0.3s; 
}
.header_blue {
    background: #101424  !important;
    border-bottom: 1px solid white !important;
}
.footer_blue {
    background-color: #11051f;
    border-top: 1px solid white !important;
}
.main_pc_cover_blue{
    background: #151f2b !important; 

}

/* Estilos para el loader */
.loader-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255); /* Fondo semi-transparente */
    z-index: 9999; /* Asegura que esté por encima de otros elementos */
    display: flex;
    justify-content: center;
    align-items: center;
    
}
.dots-3 {
    width: 50px;
    height: 28px;
    --_g: no-repeat radial-gradient(farthest-side,#348FE2 94%,transparent);
    background:
      var(--_g) 50%  0,
      var(--_g) 100% 0;
    background-size: 12px 12px;
    position: relative;
    animation: d3-0 1.5s linear infinite;
  }
  .dots-3:before {
    content: "";
    position: absolute;
    height: 12px;
    aspect-ratio: 1;
    border-radius: 50%;
    background: #348FE2;
    left:0;
    top:0;
    animation: 
      d3-1 1.5s linear infinite,
      d3-2 0.5s cubic-bezier(0,200,.8,200) infinite;
  }
  
  @keyframes d3-0 {
    0%,31%  {background-position: 50% 0   ,100% 0}
    33%     {background-position: 50% 100%,100% 0}
    43%,64% {background-position: 50% 0   ,100% 0}
    66%     {background-position: 50% 0   ,100% 100%}
    79%     {background-position: 50% 0   ,100% 0}
    100%    {transform:translateX(calc(-100%/3))}
  }
  
  @keyframes d3-1 {
    100% {left:calc(100% + 7px)}
  }
  
  @keyframes d3-2 {
    100% {top:-0.1px}
  }
</style>
