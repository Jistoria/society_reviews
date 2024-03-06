<script setup>
const franchiseP = FranchiseAd();
const tagsP = TagsAd();
const side_form = ref(true);
const side_view = ref(true);
const route = useRouter();
const id = route.currentRoute.value.query.id_fran

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
        console.log(franchise_form_PUT.tag_id);
    } else {
        console.log('franchise_form_PUT.tag_id está vacío');
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

// Obtener los IDs de los tags seleccionados
</script>
<template>
  <div hidden>
      <h1>Estás en la página "Otra página" {{ id }}</h1>
      <h1>{{ franchiseP.franchise_edit }}</h1>
      <h1>{{ franchiseP.franchise_edit_tags }}</h1>
      <h1>{{ tagsP.tags }}</h1>
  </div>
  <div class="border_y" hidden>
    <div>
            <input type="checkbox" v-for="(tag, index) in tagsP.tags" :key="index" :id="'tag_' + tag.tag_id" :value="tag.tag_id" v-model="franchise_form_PUT.tag_id">
            <label class="me-2" v-for="(tag, index) in tagsP.tags" :key="index" :for="'tag_' + tag.tag_id">{{ tag.name_tag }}</label>
            <ButtonG class="btn-primary">que envio</ButtonG>
    </div>
  </div>
    <div class="container-fluidb border_black">
                <div class="row">
                    <div  class="border_r" :class="{'col-5' : side_form, 'separador_none': !side_form}">
                        <form @submit.prevent="send_update_data">
                            <div class="form-floating mb-3">
                                <h1>Titulo</h1>
                                <input v-model="franchise_form_PUT.title" type="text" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <h1>Descripcion</h1>
                                <textarea v-model="franchise_form_PUT.description" class="form-control" placeholder="Leave a comment here"></textarea>
                            </div>
                            <div class="form-floating mb-3">
                                <h1>Estudio de animacion</h1>
                                <input v-model="franchise_form_PUT.animation_studio_latest" type="text" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <h1>imagen de referencia</h1>
                                <!-- hacer codigo de imagen -->
                                <input v-model="franchise_form_PUT.image_url" type="text" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <h1>Author</h1>
                                <input v-model="franchise_form_PUT.author" type="text" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <h1>Trabajo original</h1>
                                <input v-model="franchise_form_PUT.original_work" type="text" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <h1>fecha de lanzamiento</h1>
                                <input v-model="franchise_form_PUT.first_release" type="text" class="form-control">
                            </div>
                            <div>
                                <input type="checkbox" v-for="(tag, index) in tagsP.tags" :key="index" :id="'tag_' + tag.tag_id" :value="tag.tag_id" v-model="franchise_form_PUT.tag_id">
                                <label class="me-2" v-for="(tag, index) in tagsP.tags" :key="index" :for="'tag_' + tag.tag_id">{{ tag.name_tag }}</label>
                            </div>
                            <ButtonG class="btn-primary">enviar formulario</ButtonG>
                        </form>
                    </div>
                    <div class="separador_base">
                        <div class="d-flex justify-content-center">
                            <ButtonG @click="change_side">
                                <i class=" separador_icon bi bi-arrow-left-right"></i>
                            </ButtonG>
                        </div>
                    </div>
                    <div class="border_y" :class="{'col-7' : side_view, 'col-12': !side_view}">
                        <div class="base_view">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-5 border_r">
                                        <h1>{{ franchise_form_PUT.title }}</h1>
                                        <div>
                                            {{ franchise_form_PUT.description }}
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                {{ franchise_form_PUT.author }}
                                            </div>
                                            <div class="col-6">
                                                {{ franchise_form_PUT.original_work }}
                                            </div>
                                            <div class="col-6">
                                                {{ franchise_form_PUT.first_release }}
                                            </div>
                                            <div class="col-6">
                                                {{ franchise_form_PUT.animation_studio_latest }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-7 border_black">
                                        <div class="d-flex justify-content-center">
                                            <img :src="`${franchise_form_PUT.image_url}`" width="465" height="430">
                                        </div>
                                        <div class="d-flex justify-content-center mt-2">
                                            <ButtonG class="btn-primary me-2" v-for="(tagName, tag_id) in franchise_form_PUT.tag_id " :key="tagName"> 
                                                {{ tagName }}
                                            </ButtonG>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</template>
<style>
.base_chek{
    width: 200px;
    height: 200px;
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