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
const prueba_fun = () =>{
    console.log('si cargan las cosas')
}
</script>
<template>
<h1>creador de reseñas</h1>
<div class="border_y">
    <ButtonG class="btn-primary" @click="pre_data"> pre cargar datos </ButtonG>
</div>
<!-- formulario -->
<div class="container-fluid border_black">
    <div class="row border_r">
        <div class="border_r" :class="{'col-5' : side_form, 'separador_none': !side_form}">
            <form @submit.prevent="send_review">
                <!-- el buscador de franquisias -->
                <div class="form-floating mb-3">
                    <div>

                        <div  class="d-flex justify-content-between ">
                            <h1>
                                {{ loginP.user.name }}
                                <a class="ms-2">{{ loginP.user.id }}</a>
                            </h1>
                            <div>
                                <div >
                                    <i style="font-size: 2rem;" :style="{ color: loginP.user.color }"  class="bi bi-person-badge-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <h1>Seleccione la franquisia relacionada</h1>
                    <div>
                        <input type="text" v-model="franchise_term" @click="showTitles = true"  @mouseleave="hideTitles">
                        <ul v-if="showTitles" @mouseenter="showTitles = true" @mouseleave="hideTitles" class="border_y">
                            <li class="border_r mt-2" v-for="franchise in filtered_franchise" @click="franchise_selected(franchise)" >
                                <a> {{ franchise.title }} -- {{ franchise.franchise_id }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <h1>tipo de contenido</h1>
                    <!-- esto tiene que ser un select unitario o un input que desactive el resto -->
                    <input type="number" v-model="form_review.content_type_id">
                </div>
                <div class="form-floating mb-3">
                    <h1>titulo alternativo</h1>
                    <input type="text" v-model="form_review.title_alternative">
                </div>
                <div class="form-floating mb-3">
                    <h1>descripcion alternativa</h1>
                    <textarea v-model="form_review.description_alternative" class="form-control"></textarea>
                </div>
                <div class="form-floating mb-3">
                    <h1>data</h1>
                    <textarea v-model="form_review.data" class="form-control" ></textarea>
                </div>
                <div class="form-floating mb-3">
                    <h1>puntuacion final</h1>
                    <input type="text" v-model="form_review.rating_main">
                    es de la S a la E
                </div>
                <div class="form-floating mb-3">
                    <h1>contenido que es Spoiler</h1>
                    <textarea v-model="form_review.spoiler_content" class="form-control" > </textarea>
                </div>
                <div class="form-floating mb-3">
                    <h1>fecha de lanzamiento</h1>
                    <input type="text" class="form-control" v-model="form_review.release_year">
                </div>
                <div  class="form-floating mb-3">
                    <h1>Fecha de finalizacion</h1>
                    <input type="text" class="form-control" v-model="form_review.release_year_end">
                </div>
                <div class="form-floating mb-3">
                    <h1>cantidad de episodios</h1>
                    <input type="number" class="form-control" v-model="form_review.quantity_episode">
                </div>
                <div class="form-floating mb-3">
                    <h1>duracion total</h1>
                    <input type="time"  v-model="form_review.duration_time">
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
            <div class="border_v">
                <h1>aqui deberia salir los datos de la franqusia seleccionada</h1>
                {{ franchise_show }}
            </div>
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
