<script setup>
const franchiseP = FranchiseAd();
const rawrf = "franquicia";
onMounted(async () => {
    await franchiseP.Franchise_get();
});
const delete_franchise = async (data) =>{
    const response = await franchiseP.Franchise_delete(data);
    if(response == true){
        console.log(franchiseP.franchise.current_page)
        await franchiseP.Franchise_get_paginacion(franchiseP.franchise.current_page);
    }
}
//Cambia la pagina con los botones de navegacion en la paginacion
const handlePageChange = async (page,search) => {
    await franchiseP.Franchise_get_paginacion(page,search)
};
</script>
<template>

        <div>
            <Buscador
            :rawr="rawrf"
            :onSearch="handlePageChange"
            />
        </div>
        <div class="btn btn-dark">
            <NuxtLink to="/place/admin/franchise/franchisePOST" style="color:white; text-decoration: none;">
                franchisePost
            </NuxtLink>
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
                        <tr v-for="(franchise, index) in franchiseP.franchise.data" :key="index" >
                            <td class="d-flex justify-content-center ">
                                <img width="150px" height="150" :src="`${franchise.image_url}`" alt="Descripción de la imagen">
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
                                            <i class="bi bi-clipboard"></i>
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
            <Paginacion
            :currentPage="franchiseP.franchise.current_page"
            :totalPages="franchiseP.franchise.last_page"
            :onPageChange="handlePageChange"
            :items="franchiseP.franchise.data"
            />
        </div>
</template>
<style>
.franchise_base{
    border: 0px solid rgb(245, 241, 241);
}

</style>