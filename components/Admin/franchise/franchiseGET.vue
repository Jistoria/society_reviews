<script setup>
const franchiseP = FranchiseAd();
onMounted(async () => {
    await franchiseP.Franchise_get();

});
const delete_franchise = async (data) =>{
    const response = await franchiseP.Franchise_delete(data);
    if(response == true){
        await franchiseP.Franchise_get();
    }
}
</script>
<template>
        <NuxtLink to="/place/admin/franchise/franchisePOST">
            franchisePost
        </NuxtLink>
        <div>
            aqui iria el buscador debe ser universal
        </div>
        <div class="franchise_base table-responsive">
            <table class="table align-middle">
                    <thead>
                        <tr>
                        <th class="text-center" scope="col">Imagen</th>
                        <th class="text-center" scope="col">Titulo</th>
                        <th class="text-center" scope="col">autor</th>
                        <th class="text-center" scope="col">obra original</th>
                        <th class="text-center" scope="col">Estudio de animacion</th>
                        <th class="text-center" scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(franchise, index) in franchiseP.franchise" :key="index" >
                            <td class="d-flex justify-content-center ">
                                <img width="150px" height="150" src="https://steamuserimages-a.akamaihd.net/ugc/773989158926471047/665BF26EFBCFA750F99C022A4D3C0959AFC21DF1/?imw=5000&imh=5000&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=false" alt="Descripción de la imagen">
                                <!-- <img width="420px" height="420" :src="`${franchise.image_url}`"> -->
                            </td>
                            <td>
                                {{franchise.title}}
                            </td>
                            <td>
                                {{ franchise.author }}
                            </td>
                            <td>
                                {{ franchise.original_work }}
                            </td>
                            <td>
                                {{ franchise.animation_studio_latest }}
                            </td>
                            <td >
                                
                                <div class="d-flex mt-2">
                                    <NuxtLink :to="{ path:'/place/admin/franchise/franchisePUT', query: { id_fran: franchise.franchise_id }}">
                                        <ButtonG class="btn-secondary" >
                                            <i class="bi bi-clipboard"> {{ franchise.franchise_id }}</i>
                                        </ButtonG>
                                    </NuxtLink>
                                    <ButtonG class="btn-danger ms-2" @click="delete_franchise(franchise.franchise_id)">
                                        <i class="bi bi-trash-fill"></i>
                                    </ButtonG>
                                </div>
                            </td>
                        </tr>
                    </tbody>
            </table>
        </div>
</template>
<style>
.franchise_base{
    border: 0px solid rgb(245, 241, 241);
}

</style>