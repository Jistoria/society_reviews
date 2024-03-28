<script setup>
const { showErrorAlert, showLoadingAnimation, showSuccessAlertSkinny, showConfirmationAlert,showErrorNormalAlert} = AlertaSesion();
const router = useRouter();
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
const new_franchise = ref([]);
const name_content_type = ref('');
const array_content_type = ref(null);
const rating_main = reactive([
    'A',
    'B',
    'C',
    'D',
    'E',
])
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

const send_update_data = async ()=>{
    console.log(form_review_put,id);
    const cof = await showConfirmationAlert('Vas a actualizar la siguiente reseña, estas seguro?', ' '+ enviar_titulo.value);
    if(cof == true ){
        const review = await reviewP.Review_put(form_review_put,id);
        if(review.success = true){
            showSuccessAlertSkinny(review.message);
            await router.push({ path: '/place/dashboard' });

        }
    } 
}

//
const enviar_id = ref(null);
const enviar_titulo = ref(null);
const franchise_change = ref(null);
const data_Pinia = async ()=>{
    await reviewP.Review_get_edit(id);
    await reviewP.Review_content_type();
    const franchiseData = await franchiseP.Franchiste_get_edit(reviewP.review_edit.franchise_id)
        .then(franchiseData => {
            // Aquí puedes establecer el valor de enviar_titulo
            enviar_titulo.value = franchiseData.title; 
            enviar_id.value = franchiseData.franchise_id;
            form_review_put.franchise_id = franchiseData.franchise_id;
            form_review_put.rating_main = reviewP.review_edit.rating_main 
            getLetter(reviewP.review_edit.rating_main);
            //seteo de los datos
            if(form_review_put.content_type_id == ''){
                const  datos = reviewP.content_type;
                const numero =reviewP.review_edit.content_type_id;
                const buscarValor = (datos, numero) => {
                    for (const [key, value] of Object.entries(datos)) {
                        if (parseInt(key) === numero) {
                            return { content_type_id: parseInt(key), name: value };
                        }
                    }
                    return null; 
                };
                const valorEncontrado = buscarValor(datos, numero);
                form_review_put.content_type_id = valorEncontrado.content_type_id;
                name_content_type.value = valorEncontrado.name;
                console.log(valorEncontrado);

            }
            // form_review_put.content_type_id = reviewP.review_edit.content_type_id;
            form_review_put.title_alternative = reviewP.review_edit.title_alternative;
            form_review_put.description_alternative = reviewP.review_edit.description_alternative;
            form_review_put.data = reviewP.review_edit.data;
            form_review_put.spoiler_content = reviewP.review_edit.spoiler_content;
            form_review_put.release_year = reviewP.review_edit.release_year;
            form_review_put.release_year_end = reviewP.review_edit.release_year_end;
            form_review_put.quantity_episode = reviewP.review_edit.quantity_episode;
            form_review_put.duration_time = reviewP.review_edit.duration_time;
            array_content_type.value = reviewP.content_type;
            form_review_put.user_id = loginP.user.id;
            
        })
        .catch(error => {
            console.error('Error al obtener los datos de la franquicia:', error);
    });
}
data_Pinia();
const handleVariable2 = (titulo,id) => {
  console.log('Variable 2 recibida:' + titulo + ' ' + id) ;
  enviar_id.value = id;
  enviar_titulo.value = titulo;
  franchise_change.value = titulo
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

const filtered_content_type = computed(()=>{
    const filtered = {};
    for (const key in array_content_type.value) {
        if (array_content_type.value[key].toLowerCase().includes(name_content_type.value.toLowerCase())) {
        filtered[key] = reviewP.content_type[key];
        }
    }
    return filtered;
})

const select_franchise = (data,id)=>{
    form_review_put.content_type_id = id;
    name_content_type.value = data;

}



</script>
<template>

        <div class="container-fluid mb-3">
            <div class="row ">
                <div class="col-7">
                    <div class="base_check mt-4 ">
                        <div class="d-flex justify-content-end" >
                            <ButtonG class="btn-success">
                                <i class="bi bi-arrow-right-circle"></i>
                            </ButtonG>
                        </div>
                        <div>
                            <form @submit.prevent="send_update_data" class="form_review">
                                <!-- posiblemente hacerlo componente reusable -->

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
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">tipo de contenido</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review_put.content_type_id == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <div >
                                        <input  class="form-control edit_form" type="text" v-model="name_content_type">
                                        <div class="edit_form_filter border_v ">
                                            <div v-for="(content_type,number) in filtered_content_type"  class="d-inline-block">
                                                    <a class="btn btn-dark me-2 mt-2 ms-3 mb-2"   @click="select_franchise(content_type,number)" role="button">{{content_type}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">titulo alternativo</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review_put.title_alternative == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input  class="form-control edit_form" type="text" v-model="form_review_put.title_alternative">
                                </div>
                                <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">Descripcion alternativa</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review_put.description_alternative == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <textarea type="text" v-model="form_review_put.description_alternative" class="form-control edit_form_1"></textarea>
                                </div>
                                <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">Data</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review_put.data == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <textarea type="text" v-model="form_review_put.data" class="form-control edit_form_1"></textarea>
                                </div>
                                <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">Puntuacion final</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review_put.rating_main == null" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input class="form-range input_edit edit_form me-3" v-model="form_review_put.rating_main" id="data_"  type="range" min="0" max="9" step="1">
                                    <p class="ms-4 fs-4">Calificacion: <label class="btn-dark btn ">{{ getLetter(form_review_put.rating_main) }} = {{ form_review_put.rating_main }}</label></p>
                                </div>
                                <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">contenido que es Spoiler</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review_put.spoiler_content == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <textarea type="text" v-model="form_review_put.spoiler_content" class="form-control edit_form_1"></textarea>
                                </div>
                                <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">fecha de lanzamiento</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review_put.release_year == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input type="date" class="form-control edit_form" v-model="form_review_put.release_year" name="fecha">
                                </div>
                                <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">Fecha de finalizacion</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review_put.release_year_end == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input type="date" class="form-control edit_form" v-model="form_review_put.release_year_end">
                                </div>
                                <div class="form">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">cantidad de episodios</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review_put.quantity_episode == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input type="number" min="1" class="form-control edit_form" v-model="form_review_put.quantity_episode">
                                </div>
                                <div class="form ">
                                    <div class="d-flex ">
                                        <h2 class="ms-3 pt-2">duracion total</h2>
                                        <div class="align-self-center ms-2">
                                            <i v-if="form_review_put.duration_time == ''" class="bi bi-x-circle-fill"       style="font-size: 2rem; color: red;"></i>
                                            <i v-else class="bi bi-check-circle-fill"   style="font-size: 2rem; color: green;"></i>
                                        </div>
                                    </div>
                                    <input type="time" class="form-control edit_form " v-model="form_review_put.duration_time">
                                </div>
                                <div class="d-flex p-3 justify-content-end">
                                    <ButtonG class="btn-primary"  type="submit">Actualiazar Datos</ButtonG>
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