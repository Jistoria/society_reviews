<script setup>
const franchiseP = FranchiseAd();
const reviewP = ReviewAd();
const loginP = LoginStore();
const route = useRouter();
const showTitles = ref(false);
const id = route.currentRoute.value.query.id_review;
const side_form = ref(true);
const side_view = ref(true);
const franchise_term = ref('');
const franchise_show = ref([]);

const form_review_put = reactive({
    franchise_id: '',
    content_type_id:'',
    user_id:'',
    title_alternative:'',
    description_alternative:'',
    data:'',
    rating_main:'',
    spoiler_content:'',
    release_year:'',
    release_year_end:'',
    quantity_episode:'',
    duration_time:''  

});
const change_side = () =>{
    side_form.value = !side_form.value;
    side_view.value = !side_view.value;
};
const filteredFranchises = computed(()=>{
    return franchiseP.franchise.filter(franchise => franchise.title.toLowerCase().includes(franchise_term.value.toLowerCase())).slice(0, 5);

})
onMounted(async ()=>{
    await reviewP.Review_get_edit(id);
    await franchiseP.Franchise_get();
    form_review_put.franchise_id = reviewP.review_edit.franchise_id;
    console.log(form_review_put.franchise_id);
    const franchise_find = franchiseP.franchise.find(franchise => franchise.franchise_id ==  form_review_put.franchise_id);
    franchise_term.value = franchise_find.title;
    form_review_put.content_type_id = reviewP.review_edit.content_type_id;
    form_review_put.user_id = reviewP.review_edit.user_id;
    form_review_put.title_alternative = reviewP.review_edit.title_alternative;
    form_review_put.description_alternative = reviewP.review_edit.description_alternative;
    form_review_put.data = reviewP.review_edit.data;
    form_review_put.rating_main = reviewP.review_edit.rating_main;
    form_review_put.spoiler_content = reviewP.review_edit.spoiler_content;
    form_review_put.release_year = reviewP.review_edit.release_year;
    form_review_put.release_year_end = reviewP.review_edit.release_year_end;
    form_review_put.quantity_episode = reviewP.review_edit.quantity_episode;
    form_review_put.duration_time = reviewP.review_edit.duration_time;

})

const hideTitles = () => {
  showTitles.value = false;
  if(franchise_term.value == ''){
    franchise_show.value = ''; 
  }
};
const franchise_selected = (data) =>{
    form_review_put.franchise_id = data.franchise_id;
    // console.log('franquisia seleccionada '+ data);
    // console.log(form_review.franchise_id);
    console.log(data.title);
    franchise_term.value = data.title;
    franchise_show.value = data; 
    console.log('la nueva ide de form_review.franchise_id es '+ form_review_put.franchise_id)
};
const send_update_data = async ()=>{
    console.log(form_review_put,id);
    await reviewP.Review_put(form_review_put,id);
}

</script>
<template>
        <div class="container-fluid border_black">
            <div class="row">
                <div  class="border_r" :class="{'col-5' : side_form, 'separador_none': !side_form}">
                    <form @submit.prevent="send_update_data" >
                        <div  class="d-flex justify-content-between ">
                                <h1>
                        
                                    <a class="ms-2"> </a>
                                </h1>
                                <div>
                                    <div >
                                        <i style="font-size: 2rem;" :style="{ color: loginP.user.color  }"  class="bi bi-person-badge-fill"></i>
                                    </div>
                                </div>
                        </div>
                        <div class="form-floating mb-3">
                            <h1>seleccione una franquisia</h1>
                                <div>
                                    <input type="text" v-model="franchise_term" @click="showTitles = true"  @mouseleave="hideTitles">
                                    <ul v-if="showTitles"  @mouseenter="showTitles = true" @mouseleave="hideTitles" class="border_y">
                                        <li class="border_r mt-2"  v-for="(franchise, index) in filteredFranchises" :key="franchise.franchise_id" @click="franchise_selected(franchise)" >
                                            <a> {{ franchise.title }} -- {{ franchise.franchise_id }}</a>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                        <div class="form-floating mb-3">
                            <h1>tipo de contenido</h1>
                            <input type="number" v-model="form_review_put.content_type_id">
                        </div>
                        <div class="form-floating mb-3">
                            <h1>titulo alternativo</h1>
                            <input type="text" v-model="form_review_put.title_alternative">
                        </div>
                        <div class="form-floating mb-3">
                            <h1>descripcion alternativa</h1>
                            <textarea type="text" v-model="form_review_put.description_alternative" class="form-control"></textarea>
                        </div>
                        <div class="form-floating mb-3">
                            <h1>data</h1>
                            <textarea type="text" v-model="form_review_put.data"></textarea>
                        </div>
                        <div class="form-floating mb-3">
                            <h1>puntuacion final</h1>
                            <input type="text" v-model="form_review_put.rating_main">
                        </div>
                        <div class="form-floating mb-3">
                            <h1>contenido que es Spoiler</h1>
                            <textarea type="text" v-model="form_review_put.spoiler_content"></textarea>
                        </div>
                        <div  class="form-floating mb-3">
                            <h1>fecha de lanzamiento</h1>
                            <input type="text" class="form-control" v-model="form_review_put.release_year">
                        </div>
                        <div class="form-floating mb-3">
                            <h1>Fecha de finalizacion</h1>
                            <input type="text" class="form-control" v-model="form_review_put.release_year_end">
                        </div>
                        <div class="form-floating mb-3">
                            <h1>cantidad de episodios</h1>
                            <input type="number" class="form-control" v-model="form_review_put.quantity_episode">
                        </div>
                        <div class="form-floating mb-3">
                            <h1>duracion total</h1>
                            <input type="time" v-model="form_review_put.duration_time">
                        </div>
                        <ButtonG class="btn-primary" type="submit">enviar formulario</ButtonG>
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