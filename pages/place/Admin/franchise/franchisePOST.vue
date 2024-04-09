<script setup>
//variables
const { showErrorAlert, showLoadingAnimation, showSuccessAlertSkinny, showConfirmationAlert,showErrorNormalAlert} = AlertaSesion();
const franchiseP = FranchiseAd();
const side_form = ref(true);
const side_view = ref(true);
const tagsP = TagsAd();
const tags_selected_emited = ref([]);
const router = useRouter();
const form_franchise = reactive({
    title:'',
    description:'',
    animation_studio_latest:'',
    image_url:'',
    author:'',
    original_work:'',
    first_release:'',
    tag_id:[]

});
const form_inicial = reactive({
    title:'Kono subarashi Sekai',
    description:'Un cojudo y tres pendejas',
    animation_studio_latest:'Studio Deen',
    image_url:'',
    author:'Natsume Akatsuki',
    original_work:'Novela Ligera',
    first_release:'2013-09-1',

});
onMounted(async () => {
    await tagsP.Tags_get();

});
const franchise_form = async() =>{

    try {
        const cof = await showConfirmationAlert('Vas a subir la franquisia, estas seguro?');
        if(cof == true ){
            const franchise = await franchiseP.Franchise_post(form_franchise);
            if(franchise.success == true){
                showSuccessAlertSkinny('Franquisia subida exitosamente subida exitosamente');
                await router.push({ path: '/place/dashboard' });
            }else{
                await showErrorNormalAlert('Error en la eliminacion', franchise.message);
            }
        } 
    } catch (error) {
            console.log(error);
    }
}
const pre_data = ()=>{
    form_franchise.title = 'Tri-gun',
    form_franchise.description ='un tipo pacifista',
    form_franchise.animation_studio_latest ='Madhouse',
    form_franchise.image_url='https://steamuserimages-a.akamaihd.net/ugc/773989158926471047/665BF26EFBCFA750F99C022A4D3C0959AFC21DF1/?imw=5000&imh=5000&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=false',
    form_franchise.author = 'Yasuhiro Nightow',
    form_franchise.original_work ='manga',
    form_franchise.first_release = '1970-08-30',
    form_franchise.tag_id = ['2','6','1']

}
const tag_clas = async() =>{
    await tagsP.Tags_get();

}
const change_side = () =>{
    side_form.value = !side_form.value;
    side_view.value = !side_view.value;
}
const enviar_titulo = ref(false)
// Obtener los IDs de los tags seleccionados
//datos emitidos
const handleVariable2 = (tags_name, tags_id) => {
    // console.log(tags_name);
    tags_selected_emited.value = tags_name.value;
    form_franchise.tag_id = tags_id.value;

};
</script>
<template>
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">Crear Franquisia</h1>
        <ButtonG class="btn-dark" @click="pre_data">rellenar datos pre iniciales</ButtonG>
        <ButtonG class="btn-danger" @click="tag_clas"> llamar los tags</ButtonG>
        <div class="row ">
            <div class="col-7">
                <div class="base_check mt-4">
                    <div class="d-flex justify-content-end" >
                            <ButtonG class="btn-success">
                                <i class="bi bi-arrow-right-circle"></i>
                            </ButtonG>
                    </div>
                    <form  @submit.prevent="franchise_form" class="form_review bordr_r" >
                    <div class="form">
                                    <div class="d-flex">
                                        <h2 class="ms-3 pt-2">Titulo</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_franchise.title == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="text" v-model="form_franchise.title">
                    </div>
                    <div class="form">
                            <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">Descripcion</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_franchise.description == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                            </div>
                                    <textarea type="text" v-model="form_franchise.description" class="form-control edit_form_1"></textarea>
                    </div>
                    <div class="form">
                                    <div class="d-flex">
                                        <h2 class="ms-3 pt-2">Estudio de animacion</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_franchise.animation_studio_latest == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="text" v-model="form_franchise.animation_studio_latest">
                    </div>
                    <div class="form">
                                    <div class="d-flex">
                                        <h2 class="ms-3 pt-2">Imagen de referencia</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_franchise.image_url == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="text" v-model="form_franchise.image_url">
                    </div>
                    <div class="form">
                                    <div class="d-flex">
                                        <h2 class="ms-3 pt-2">Author</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_franchise.author == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="text" v-model="form_franchise.author">
                    </div>
                    <div class="form">
                                    <div class="d-flex">
                                        <h2 class="ms-3 pt-2">Trabajo original</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_franchise.original_work == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="text" v-model="form_franchise.original_work">
                    </div>
                    <div class="form">
                                    <div class="d-flex">
                                        <h2 class="ms-3 pt-2">fecha de lanzamiento</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_franchise.first_release == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="date" v-model="form_franchise.first_release">
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
                                                <ModalFranchise :enviar_tags_id="form_franchise.tag_id" @enviartags="handleVariable2"></ModalFranchise>
                                            </div>
                                        </div>
                                    </div>
                    </div>
                    <div class="d-flex p-3 mb-4 justify-content-end">
                                    <ButtonG class="btn-primary" type="submit">Subir franquisia</ButtonG>
                    </div>
                </form>
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