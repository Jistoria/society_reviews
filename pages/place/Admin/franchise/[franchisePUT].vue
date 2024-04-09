<script setup>
const franchiseP = FranchiseAd();
const tagsP = TagsAd();
const side_form = ref(true);
const side_view = ref(true);
const route = useRouter();
const id = route.currentRoute.value.query.id_fran
const tags_selected_emited = ref([]);

const franchise_form_PUT = reactive({
    title:'',
    description:'',
    animation_studio_latest:'',
    image_url:'',
    author:'',
    original_work:'',
    first_release:'',
    tag_id:[],
});
onMounted(async () => {
    await franchiseP.Franchiste_get_edit(id);
    await franchiseP.Franchise_get_tags(id);
    await tagsP.Tags_get();
    franchise_form_PUT.title = franchiseP.franchise_edit.title;
    franchise_form_PUT.description = franchiseP.franchise_edit.description;
    franchise_form_PUT.animation_studio_latest = franchiseP.franchise_edit.animation_studio_latest;
    franchise_form_PUT.image_url = franchiseP.franchise_edit.image_url;
    franchise_form_PUT.author = franchiseP.franchise_edit.author;
    franchise_form_PUT.original_work = franchiseP.franchise_edit.original_work;
    franchise_form_PUT.first_release = franchiseP.franchise_edit.first_release;
    franchise_form_PUT.tag_id = franchiseP.franchise_edit_tags;
    if (franchise_form_PUT.tag_id.length > 0) {
        franchise_form_PUT.tag_id = franchise_form_PUT.tag_id.map(tag => tag.tag_id);
        // console.log(franchise_form_PUT.tag_id);
    } else {
        console.log('franchise_form_PUT.tag_id está vacío');
    }
    //
     for (const ids of franchise_form_PUT.tag_id) {
         // Busca el tag correspondiente en el array de datos
         const tagEncontrado = tagsP.tags.find(tag => tag.tag_id == ids);
         // Si se encuentra un tag, agrégalo al array de tags encontrados
         if (tagEncontrado) {
            tags_selected_emited.value.push(tagEncontrado);
         }
    }
});

const change_side = () =>{
    side_form.value = !side_form.value;
    side_view.value = !side_view.value;
}
const send_update_data = async() =>{
    await franchiseP.Franchise_put(franchise_form_PUT,id);
    console.log('termino de actualizar franquisia');

    const tagValues = Object.values(franchise_form_PUT.tag_id);
    const tagStrings = tagValues.map(tag => tag.toString());
    const tags_idO = {
        "tag_id": tagStrings
    };
    await franchiseP.Franchiste_edit_tags(tags_idO,id);

}
const enviar_titulo = ref(false)
// Obtener los IDs de los tags seleccionados
//datos emitidos
const handleVariable2 = (tags_name, tags_id) => {
    tags_selected_emited.value = tags_name.value;
    franchise_form_PUT.tag_id = tags_id.value;

};

</script>
<template>
    <div class="container-fluid" >
        <div class="row">
            <div class="col-7">
                <div class="base_check mt-4">
                    <div class="d-flex justify-content-end" >
                            <ButtonG class="btn-success">
                                <i class="bi bi-arrow-right-circle"></i>
                            </ButtonG>
                    </div>
                    <div>
                        <form @submit.prevent="send_update_data" class="form_review">
                            <div class="form">
                                    <div class="d-flex">
                                        <h2 class="ms-3 pt-2">Titulo</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="franchise_form_PUT.title == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="text" v-model="franchise_form_PUT.title">
                            </div>
                            <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">Descripcion</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="franchise_form_PUT.description == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <textarea type="text" v-model="franchise_form_PUT.description" class="form-control edit_form_1"></textarea>
                            </div>
                            <div class="form">
                                    <div class="d-flex">
                                        <h2 class="ms-3 pt-2">Estudio de animacion</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="franchise_form_PUT.animation_studio_latest == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="text" v-model="franchise_form_PUT.animation_studio_latest">
                            </div>
                            <div class="form">
                                    <div class="d-flex">
                                        <h2 class="ms-3 pt-2">Imagen de referencia</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="franchise_form_PUT.image_url == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="text" v-model="franchise_form_PUT.image_url">
                            </div>
                            <div class="form">
                                    <div class="d-flex">
                                        <h2 class="ms-3 pt-2">Author</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="franchise_form_PUT.author == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="text" v-model="franchise_form_PUT.author">
                            </div>
                            <div class="form">
                                    <div class="d-flex">
                                        <h2 class="ms-3 pt-2">Trabajo original</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="franchise_form_PUT.original_work == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="text" v-model="franchise_form_PUT.original_work">
                            </div>
                            <div class="form">
                                    <div class="d-flex">
                                        <h2 class="ms-3 pt-2">fecha de lanzamiento</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="franchise_form_PUT.first_release == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="date" v-model="franchise_form_PUT.first_release">
                            </div>
                            
                            <div class="review_input">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">Seleccione los tags</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="enviar_titulo == null" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="data_form mt-2 mb-4">
                                            <ButtonG class="btn-dark me-2 ms-2 mt-3 mb-3" v-for="data in tags_selected_emited">
                                                {{data.name_tag}}
                                            </ButtonG>
                                        </div>
                                        <div class=" d-flex justify-content-end flex-grow-1 ">
                                            <div class="align-self-center me-4 mb-3">
                                                <ModalFranchise  :enviar_tags_id="franchise_form_PUT.tag_id" @enviartags="handleVariable2"></ModalFranchise>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex p-3 mb-4 justify-content-end">
                                        <ButtonG class="btn-primary" type="submit">Subir franquisia</ButtonG>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-5">

            </div>
        </div>
    </div>
</template>
<style>
.edit_form{
    width: 76%;
    border-radius: 15px;
    margin-left: 15px;

}
.edit_form_filter{
    width: 76%;
    border-radius: 15px;
    margin-left: 15px; 
    background: violet;
}
.edit_form_1{
    width: 76%;
    border-radius: 15px;
    margin-left: 15px;
    resize: none; 
    height: 140px;
    max-height: 150px; 
}
.review_input{
   border-radius: 15px;
}
.data_form{
    background: white;
    width: 75%;
    margin-left: 15px;
    border-radius: 15px;
    

}
.data_franchise{
    margin-top: 10px;
    margin-left: 15px;
    padding: 5px;
    font-style: italic;

}
.form_review{
    background: lightblue;
    border-radius: 15px;
}
.base_check{
    width: 100%;
    height: 100%;
}
.input_tag{
    width: 20px;
    height: 20px;
}
.separador_none{
    display: none;
}
.separador_base{
    position: absolute;
    right: 17vh;
}
.separador_icon{
    background: wheat;
    border-radius: 15px;
    padding: 10px;
}

.base_view{
    padding: 0px !important;
    margin: 0px !important;
}
</style>