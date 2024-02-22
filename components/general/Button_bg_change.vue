<script setup>
const bg_ver = VerificacionE();
const toggleBackground = async ()=>{
    bg_ver.background();
}

</script>
<style>
.change_bg{
    width: 15vh;
    height:  5.5vh;
    position: relative;
    display: block;
    background: rgba(245, 222, 179, 0.205);
    border-radius: 200px;
    box-shadow: inset 0px 5px 15px rgba(0, 0, 0, 0.4), inset 0px -5px 15px rgba(255,255,255,0.4);
    cursor: pointer;
    transition: 0.3s;
    margin-right: 10px;
}
.change_bg:after{
    content: "";
    width: 4.2vh;
    height: 4vh;
    position: absolute;
    top: 0.7vh;
    left: 0.7vh;
    background: linear-gradient(180deg, rgb(27, 13, 13), rgb(29, 29, 204));
    border-radius: 180px;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
    transition: 0.3s;
}
.change_bg_input{
    width: 0px;
    height: 0px;
    visibility: hidden;

}
.change_bg_input:checked + .change_bg{
    background: violet;
}
.change_bg_input:checked + .change_bg:after{
    left: 13.6vh;
    transform: translateX(-100%);
    background:  linear-gradient(180def, black,blue, yellow );
}
.change_bg:active::after{
    width: 8vh;
}

.change_bg_input:checked + .change_bg + .background{
    background: black;
}
.change_bg .toque{
    border: 0px solid red;
    position: absolute;
    width: 6vh;
    font-size: 3vh; 
    top: 0.5vh;
    z-index: 10;
}
.change_bg .sol_bg{
    left: 1vh;
    color: #fff;
    transition: 0.3;
}
.change_bg .moon_bg{
    left: 10vh;
    color: #000000;
    transition: 0.3;
}
.change_bg_input:checked + .change_bg  .sol_bg{
    color: rgb(41, 17, 17);
}
.change_bg_input:checked + .change_bg  .moon_bg{
    color: rgb(0, 255, 242);
}
</style>
<template>
    <input @change="toggleBackground" class="change_bg_input" type="checkbox" id="darkmode-toggle" />
    <label class="change_bg" for="darkmode-toggle">
        <i class="bi bi-sun sol_bg toque"></i>
        <i class="bi bi-moon moon_bg toque"></i>
    </label> 

</template>