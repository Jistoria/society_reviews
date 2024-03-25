<script setup>
const franchiseP = FranchiseAd();
const reviewP = ReviewAd();
const loginP = LoginStore();
const showTitles = ref(false);
const side_form = ref(true);
const side_view = ref(true);


const form_review = reactive({
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
const send_review = async() =>{
    console.log('si vale el submit')
    await reviewP.Review_post(form_review);
}
onMounted(async () =>{ 
console.log('si monte');
await franchiseP.Franchise_get();
form_review.user_id = loginP.user.id;
})
const pre_data = () =>{
    form_review.franchise_id = '15',
    form_review.content_type_id = '2',
    form_review.user_id = '2',
    form_review.title_alternative = 'Tri-gun Maximun',
    form_review.description_alternative = 'Una persona que solo quiere quen paz en el universo',
    form_review.data = 'la historia va de Vash Stampede que es un el ser mas buscado de un planeta desertico',
    form_review.rating_main = '7',
    form_review.spoiler_content = 'vash es hermanos de knives desde muy temprana edad sucediendo un evento que les hizo ver como es la humanidad siendo el lado mas humano vash y el lado mas cruel knives',
    form_review.release_year = '1970-08-30',
    form_review.release_year_end='2018-08-30',
    form_review.quantity_episode ='24',
    form_review.duration_time = '15:06'

};
//dato computados
const franchise_term = ref('');
const franchise_show = ref([]);
const filtered_franchise = computed(()=>{
    return franchiseP.franchise.filter(franchise => franchise.title.toLowerCase().includes(franchise_term.value.toLowerCase())).slice(0, 5);

})
const franchise_selected = (data) =>{
    form_review.franchise_id = data.franchise_id;
    // console.log('franquisia seleccionada '+ data);
    // console.log(form_review.franchise_id);
    console.log(data.title);
    franchise_term.value = data.title;
    franchise_show.value = data; 
    console.log('la nueva ide de form_review.franchise_id es '+ form_review.franchise_id)
};
const hideTitles = () => {
  showTitles.value = false;
  if(franchise_term.value == ''){
    franchise_show.value = ''; 
  }
};
const enviar_id = ref(null);
const enviar_titulo = ref(null);
const franchise_change = ref(null);
const rating_main = reactive([
    'A',
    'B',
    'C',
    'D',
    'E',
])
const handleVariable2 = (titulo,id) => {
  console.log('Variable 2 recibida:' + titulo + ' ' + id) ;
  enviar_id.value = id;
  enviar_titulo.value = titulo;
  franchise_change.value = titulo;
  form_review.franchise_id = id;
};
const getLetter = (index) => {
  if (index >= 0 && index < 2) {
    const letra = rating_main[4];

    return letra
  }else if (index >= 2 && index < 4) {

    const letra = rating_main[3];
    return letra
  }else if (index >= 4 && index < 6){

    const letra =  rating_main[2];
    return letra
  }else if(index >= 6 && index < 8){
    const letra = rating_main[1];
    return letra
  }else{
    const letra = rating_main[0];

    return letra
  }

};


</script>
<template>
<div>
    <ButtonG class="btn-primary" @click="pre_data"> pre cargar datos </ButtonG>
</div>
<!-- formulario -->
<div class="container-fluid">
    <div class="row">
        <div class="col-7">
            <div>
                <div class="d-flex justify-content-end" >
                    <ButtonG class="btn-success">
                        <i class="bi bi-arrow-right-circle"></i>
                    </ButtonG>
                </div>
            </div>
            <div>
                <form @submit.prevent="send_review"   class="form_review">

                    <div class="review_input">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">Seleccione una franquisia</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="enviar_titulo == null" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="data_form mt-2 mb-4">
                                            <p class="data_franchise  fs-5">
                                                {{ enviar_titulo }}
                                            </p>
                                        </div>
                                        <div class=" d-flex justify-content-end flex-grow-1 ">
                                            <div class="align-self-center me-4 mb-3">
                                                <ModalReview :enviar_titulo="enviar_titulo" :enviar_id="enviar_id"  @enviarVariable2="handleVariable2" ></ModalReview>
                                            </div>
                                        </div>
                                    </div>
                    </div>
                    <div class="form">
                                    <!-- tipo de contenido debe ser un select multiple -->
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">tipo de contenido</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review.content_type_id == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="number" v-model="form_review.content_type_id">
                    </div>
                    <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">titulo alternativo</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review.title_alternative == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="text" v-model="form_review.title_alternative">
                    </div>
                    <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">Descripcion alternativa</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review.description_alternative == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <textarea type="text" v-model="form_review.description_alternative" class="form-control edit_form_1"></textarea>
                    </div>
                    <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">Data</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review.data == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <textarea type="text" v-model="form_review.data" class="form-control edit_form_1"></textarea>
                    </div>
                    <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">Puntuacion final</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review.rating_main == null" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input class="form-range input_edit edit_form me-3" v-model="form_review.rating_main" id="data_"  type="range" min="0" max="9" step="1">
                                    <p class="ms-4 fs-4">Calificacion: <label class="btn-dark btn ">{{ getLetter(form_review.rating_main) }} = {{ form_review.rating_main }}</label></p>
                    </div>
                    <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">contenido que es Spoiler</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review.spoiler_content == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <textarea type="text" v-model="form_review.spoiler_content" class="form-control edit_form_1"></textarea>
                    </div>
                    <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">fecha de lanzamiento</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review.release_year == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input type="date" class="form-control edit_form" v-model="form_review.release_year" name="fecha">
                                </div>
                                <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">Fecha de finalizacion</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review.release_year_end == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input type="date" class="form-control edit_form" v-model="form_review.release_year_end">
                                </div>
                                <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">cantidad de episodios</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review.quantity_episode == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input type="number" min="1" class="form-control edit_form" v-model="form_review.quantity_episode">
                                </div>
                                <div class="form ">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">duracion total</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review.duration_time == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input type="time" class="form-control edit_form " v-model="form_review.duration_time">
                                </div>
                                <div class="d-flex p-3 mb-4 justify-content-end">
                                    <ButtonG class="btn-primary" type="submit">Actualiazar Datos</ButtonG>
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


.edit_form{
    width: 76%;
    border-radius: 15px;
    margin-left: 15px;

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
