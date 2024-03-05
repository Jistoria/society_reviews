<script setup>
//variables
const franchiseP = FranchiseAd();
const side_form = ref(true);
const side_view = ref(true);
const tagsP = TagsAd();
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
    await franchiseP.Franchise_post(form_franchise);
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
</script>
<template>

    <div class="container-fluid border_r">
        <h1 class="d-flex justify-content-center">Crear Franquisia</h1>
        <ButtonG class="btn-dark" @click="pre_data">rellenar datos pre iniciales</ButtonG>
        <ButtonG class="btn-danger" @click="tag_clas"> llamar los tags</ButtonG>
        <div class="border_y">
            <div class="row">
                <div  class="border_r" :class="{'col-5' : side_form, 'separador_none': !side_form}">
                    <form @submit.prevent="franchise_form" >
                            <div class="form-floating mb-3">
                                <h1>Titulo</h1>
                                <input v-model="form_franchise.title" type="text" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <h1>Descripcion</h1>
                                <textarea v-model="form_franchise.description" class="form-control" placeholder="Leave a comment here"></textarea>
                            </div>
                            <div class="form-floating mb-3">
                                <h1>Estudio de animacion</h1>
                                <input v-model="form_franchise.animation_studio_latest" type="text" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <h1>imagen de referencia</h1>
                                <!-- hacer codigo de imagen -->
                                <input v-model="form_franchise.image_url" type="text" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <h1>Author</h1>
                                <input v-model="form_franchise.author" type="text" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <h1>Trabajo original</h1>
                                <input v-model="form_franchise.original_work" type="text" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <h1>fecha de lanzamiento</h1>
                                <input v-model="form_franchise.first_release" type="text" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <h1>seleccione tags minimo 2</h1>
                                <div>
                                    <input type="checkbox" v-for="(tag, index) in tagsP.tags" :key="index" :id="'tag_' + tag.tag_id" :value="tag.tag_id" v-model="form_franchise.tag_id">
                                    <label class="me-2" v-for="(tag, index) in tagsP.tags" :key="index" :for="'tag_' + tag.tag_id">{{ tag.name_tag }}</label>
                                </div>
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
                    <div class="border_v base_view">
                        <div class="container-fluid">
                            <div class="row ">
                                <div class="col-5 border_r">
                                    <h1>{{ form_franchise.title || form_inicial.title }}</h1>
                                    <div>
                                        {{   form_franchise.description  || form_inicial.description }}
                                    </div>
                                    <div class="row border_blue mt-4">
                                        <div class="col-6 border_r">
                                            {{ form_franchise.author || form_inicial.author }}
                                        </div>
                                        <div class="col-6  border_v">
                                            {{ form_franchise.original_work || form_inicial. original_work }}
                                        </div>
                                        <div class="col-6 border_black">
                                            {{ form_franchise.first_release || form_inicial.first_release }}
                                        </div>
                                        <div class="col-6 border_black">
                                            {{ form_franchise.animation_studio_latest || form_inicial.animation_studio_latest }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7 border_black">
                                    <div  class="d-flex justify-content-center">
                                        <img src="../../../../assets/evil2.jpg" width="465" height="430">
                                    </div>
                                    <div class="d-flex justify-content-center mt-2" v-if="form_franchise.tag_id.length == 0" >
                                        <Button_g class="btn-primary me-2">tag1</Button_g>
                                        <Button_g class="btn-primary me-2">tag3</Button_g>
                                        <Button_g class="btn-primary me-2">tag2</Button_g>
                                    </div>
                                    <div class="d-flex justify-content-center mt-2" v-show="form_franchise.tag_id.length > 0 ">
                                        <ButtonG class="btn-primary me-2" v-for="(tagName, tag_id) in form_franchise.tag_id" :key="tagName"> 
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
    </div>

    <div class="container-fluid border_v" hidden>
        <div class="row">
            <div class="border_r" :class="{'col-5' : side_form, 'separador_none': !side_form}">
                formulario
            </div>

            <div class="separador_base">
                <div class="d-flex justify-content-center">
                    <ButtonG @click="change_side">
                        <i class=" separador_icon bi bi-arrow-left-right"></i>
                    </ButtonG>
                </div>
            </div>

            <div class="border_y" :class="{'col-7' : side_view, 'col-12': !side_view}">
                contenido
            </div>
        </div>
    </div>
</template>
<style>
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