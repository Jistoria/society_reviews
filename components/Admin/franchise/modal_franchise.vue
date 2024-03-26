<script setup>
const tagsP = TagsAd();
const tags_selected= ref([]);
const tagIdsArray = ref([]);

onMounted(async () => {
    await tagsP.Tags_get();
});
const set_tags = (data)=>{
  const index = tags_selected.value.indexOf(data);
  if(index !== -1){
    tags_selected.value.splice(index, 1);
  }else{
    tags_selected.value.push(data);

  }
}
const delete_tag = (data)=>{
  const index = tags_selected.value.indexOf(data);
  tags_selected.value.splice(index, 1);
}
//emitir datos
const emit = defineEmits(['enviartags']);

const save_data = async () => {
    tagIdsArray.value = tags_selected.value.map(item => item.tag_id);
    emit('enviartags', tags_selected, tagIdsArray);
    // bootstrap.Modal.getInstance(document.getElementById('exampleModal')).hide();
}
const props = defineProps({
  enviar_tags_id: Array, // Especifica el tipo de la propiedad, en este caso asumimos que es un string

});
const set_tags_prop = () => {
  const ids_search = props.enviar_tags_id; // Array pasado como prop desde dato_1.vue
  // Filtra los números que se repiten
 
  // const tagsFiltrados = tagsP.tags.filter(tag => ids_search.includes(tag.tag_id));
  // tags_selected.value.push(tagsFiltrados);

  for (const ids of ids_search) {
    const tagEncontrado = tagsP.tags.find(tag => tag.tag_id == ids);
    // Si se encuentra un tag, agrégalo al array de tags encontrados
    const tags_repetido = tags_selected.value.find(tag => tag.tag_id == ids);
    if(tags_repetido){
      return false;
    }
    if (tagEncontrado) {
      tags_selected.value.push(tagEncontrado);
    }
  }

};


</script>
<template>
<!-- Button trigger modal -->
<button @click="set_tags_prop"  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Seleccione los tags
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
  <div class="modal-dialog modal-lg">
    <div class="modal-content relleno_w">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tags seleccionados</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div v-for="tags in tagsP.tags" class="d-inline">
            <a   role="button" class="btn btn-dark me-2 mt-2 mb-2" @click="set_tags(tags)"> 
              {{ tags.name_tag }}
            </a>
        </div>
        <div >
            <h3>Tags seleccionados:</h3>
            <div>
              <a role="button" class="btn btn-success me-2 mt-2 mb-2"  v-for="data in tags_selected" @click="delete_tag(data)"> 
                {{ data.name_tag }}
                
                <i class="bi bi-x-circle ms-2"></i>
              </a>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="save_data()">Guardan cambios</button>
      </div>
    </div>
  </div>
</div>

</template>
<style>

</style>