<script setup>

</script>
<template>
        <div class="border_r" hidden>
            imagen
        </div>
        <div class="card card_config border_y" hidden>
            <h1>imagen</h1>
            <div class="card-header">
            <h2>..</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">....</h5>
            </div>
        </div>
        <div class="container-fluid border_black">
            <div class="row border_y">
                <div class="col-3  base_image">
                    <img src="../../assets/images.jfif" >
                </div> 
                <div class="col-9 border_v base_content">
                    <div class="card">
                        <div class="card-header">
                            Better Call Saul
                        </div>
                        <div class="card-body">
                            <ButtonG>actualizar</ButtonG>
                            <ButtonG>Eliminar</ButtonG>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</template>
<style>
.base_image{
    border: 5px solid red;
    padding: 0 !important;
    margin: 0 !important;
}
.base_image img{
    width: 110px;
    height: 200px;
}
.base_content{
    background: red;
}
.base_image:hover{
    background: black;
    border: 5px solid white;
}
.base_content:hover{
    background-color: rgb(0, 0, 0);
}
</style>