<script setup>
const franchiseP = FranchiseAd();
onMounted(async () => {
    await franchiseP.Franchise_get();

});
</script>
<template>
        <NuxtLink to="/place/admin/franchise/franchisePOST">
            franchisePost
        </NuxtLink>
        <div>
            aqui iria el buscador debe ser universal
        </div>
        <div class="franchise_base">
            <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Estudio de animacion</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(franchise, index) in franchiseP.franchise" :key="index" >
                            <td> {{ index }}</td>
                            <td> {{ franchise }}</td>
                            <td>*estudio de animacion*</td>
                            <td>
                                <ButtonG class="btn-primary me-2">
                                    <i class="bi bi-clipboard"></i>
                                </ButtonG>
                                <ButtonG class="btn-primary ms-2">
                                    <i class="bi bi-trash-fill"></i>
                                </ButtonG>
                            </td>
                        </tr>
                    </tbody>
            </table>
        </div>
</template>
<style>
.franchise_base{
    border: 5px solid rgb(245, 241, 241);
}
</style>