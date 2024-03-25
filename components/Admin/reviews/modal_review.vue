<script setup>
import { defineProps, defineEmits } from 'vue';
const franchiseP = FranchiseAd();
const rawrf = "franquicia";

onMounted(async ()=>{
    await franchiseP.Franchise_get();
})
const handlePageChange = async (page,search) => {
    await franchiseP.Franchise_get_paginacion(page,search)
};
//datos opcionales
const props = defineProps({
  enviar_titulo: String, // Especifica el tipo de la propiedad, en este caso asumimos que es un string
  enviar_id: Number,
});

//emitir datos
const emit = defineEmits(['enviarVariable2']);

const send_data_franchise_selected = async (titulo,id) => {
    emit('enviarVariable2', titulo, id);
    bootstrap.Modal.getInstance(document.getElementById('exampleModal')).hide();
}




</script>
<template>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Buscar franquisias
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">  
  <div class="modal-dialog modal-xl">
    <div class="modal-content relleno_w">
      <div class="modal-header">
            <h1 class="modal-title fs-3" id="exampleModalLabel">Seleccion una franquisia</h1>
            <div class="d-flex justify-content-end">
                <Buscador 
                    :rawr="rawrf"
                    :onSearch="handlePageChange"
                />
                <button type="button" class="btn-close mt-2" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      </div>
      <div class="modal-body">
            <div >
                <div class="base_franchise_select me-2 mt-2" v-for="franchise in franchiseP.franchise.data">
                    <div class="container-fluid">
                        <div class="row align-items-center" :class="{ 'franchise_selected': franchise.franchise_id == enviar_id }">
                            <div class="col-2" >
                                <img class="img_select" :src="`${ franchise.image_url}`" >
                            </div>
                            <div class="col-8">
                                {{ franchise.title }}
                           </div>
                            <div class="col-2 " >
                                <ButtonG  @click="send_data_franchise_selected(franchise.title, franchise.franchise_id)" :class="franchise.franchise_id == enviar_id ? 'btn-success' : 'btn-dark'">
                                    selecionar
                                </ButtonG>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <Paginacion
            :currentPage="franchiseP.franchise.current_page"
            :totalPages="franchiseP.franchise.last_page"
            :onPageChange="handlePageChange"
            />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> 
</template>
<style>
.base_franchise_select{
    border-bottom: 1px solid red;
    border-radius: 5px;
    padding: 5px;
    width: 100%;
}
.img_select{
    width: 150px;
    height: 150px;
    border-radius: 50%;
}
.franchise_selected{
    background: pink;
}
</style>