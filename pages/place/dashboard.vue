<script setup>
let stageSet = ref ('reviews')
const viewstage = (data)=>{
    console.log(data);
    stageSet.value = data;
}

</script>
<template>
    <!-- componente de dashboard para admins y superadmin -->
    <div>
        <nav class="nav_dashboard">
            <ul class="linear">
                <li>
                    <a class="base_dashboard" :class="{ 'active_stage' : stageSet == 'reviews' }">
                        <i class="fas bi bi-back"></i>
                        <span class="dashboard_item" @click="viewstage('reviews')">Reseñas</span>
                    </a>
                </li>
                <li>
                    <a class="base_dashboard" :class="{ 'active_stage' : stageSet == 'franchise' }">
                        <i class="fas bi bi-diagram-3-fill"></i>
                        <span class="dashboard_item"    @click="viewstage('franchise')">Franquicias</span>
                    </a>
                </li>
                <li>
                    <a class="base_dashboard" :class="{ 'active_stage' : stageSet == 'tags' }">
                        <i class="fas bi bi-exclude"></i>
                        <span class="dashboard_item"  @click="viewstage('tags')">Tags</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- componente de estructura para cada ruta ya sea reseñas, franquicias y tags -->
    <!-- hacer un composable para franquisias y tags con el mismo para reseñas -->
        <div class="container-fluid">
            <div class="container-xl ">
                <ReviewsGET v-if="stageSet == 'reviews'"></ReviewsGET>
                <FranchiseGET v-if="stageSet == 'franchise'"></FranchiseGET>
                <TagsGet v-if="stageSet == 'tags'"></TagsGet>
            </div>
        </div>

</template>
<style>
h1{
    color: rgb(0, 153, 255);
}
/* esti es lo del dashboard de tipo side */
.active_stage{
    background: rgba(37, 27, 27, 0.397);
}
.nav_dashboard{
    border: 0px solid rgb(0, 0, 0);
    position: absolute;
    left: 0;
    width: 40px;
    height:  stretch;
    background: #fff;
    overflow: hidden;
    transition: width 0.2s linear;
    box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
    z-index: 100;
}
.linear{
    margin: 0;
    padding: 0;
}
.base_dashboard{
    position: relative;
    color: red;
    text-decoration: none;
    font-size: 14px;
    display: table;
    width: 300px;
    padding: 10px;
}

.fas{
    position: relative;
    width: 70px;
    height: 40px;
    top: 0px;
    font-size: 20px;
    text-align: center;
}
.dashboard_item{
    position: relative;
    top: 0px;
    margin-left: 10px;
}
.base_dashboard:hover{
    background: rgba(37, 27, 27, 0.397);
}
.nav_dashboard:hover{
    width: 280px;
    transition: all 0.5 ease;
}

.base_t{
    width: 246px;
    
}
.base_r{
    border: 5px solid blue;
}
</style>