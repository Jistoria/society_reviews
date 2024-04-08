<script setup>
const button_selected = ref(null);
    const coverStore = coversE()
    const tagsP = TagsAd();
    const reviewP = ReviewAd();
    const coverP = coversE();
    const selectedValue = ref(0);
const searchTerm = ref('');    
const buttons_sett = reactive ({
    var_1:{
        nombre:'Tags',
        slug:'tag'
    },
    var_2:{
        nombre:'Autor',
        slug:'autor',
        tipo:{
            nombre_1:'Administrador',
            nombre_2:'Comunidad'
        }
        
    },
    var_3:{
        nombre:'Tipo de contenido',
        slug:'tipo_de_contenido'
    },
    var_4:{
        nombre:'Tiempo',
        slug:'tiempo',
        tipo:{
            nombre_1:'mas antiguos',
            nombre_2:'mas recientes',
        }
    },
    var_5:{
        nombre:'Calificacion',
        slug:'calificacion',
        calificacion:{
            base_1:{
                nombre:'Administrador',
                puntuacion:{
                        puntuacion_1:'E',
                        puntuacion_2:'D',
                        puntuacion_3:'C',
                        puntuacion_4:'B',
                        puntuacion_5:'A',
                        puntuacion_6:'S',
                    }
            },
            base_2:{
                nombre:'Comunidad',
                puntuacion:{
                        puntuacion_1:'E',
                        puntuacion_2:'D',
                        puntuacion_3:'C',
                        puntuacion_4:'B',
                        puntuacion_5:'A',
                        puntuacion_6:'S',
                }
            }
        }

    }

})
onMounted(async () => {
        await tagsP.Tags_pluck();
        await reviewP.Review_content_type();
        await reviewP.filter();
});
const data_send = reactive({
    tags:[],
    autor:[],
    content_type:[],
    time:[],
    rating:[],
    comunidad:[]
})
const comunity_data = reactive({
        comunidad: 0,
        ratingC: 0,
})

const set_computed_data = (data) =>{
    button_selected.value = data;

}

const case_filter = computed(()=>{
    if(button_selected.value == null){
        return null
    }
    if(button_selected.value == buttons_sett.var_1.slug){
        return tagsP.tags.filter(tag => tag.name_tag.toLowerCase().includes(searchTerm.value.toLowerCase()));

    }
    if(button_selected.value == buttons_sett.var_2.slug){
        const filtered = {};
            for(const key in reviewP.authors.authors_admin){
                if (reviewP.authors.authors_admin[key].toLowerCase().includes(searchTerm.value.toLowerCase())) {
                    filtered[key] = reviewP.authors.authors_admin[key];
                }
            }
        return filtered

    }
    if(button_selected.value == buttons_sett.var_3.slug){
        const filtered = {};
        for (const key in reviewP.content_type) {
            if (reviewP.content_type[key].toLowerCase().includes(searchTerm.value.toLowerCase())) {
            filtered[key] = reviewP.content_type[key];
            }
        }
        return filtered;
    }
    if(button_selected.value == buttons_sett.var_4){

    }
    if(button_selected.value == buttons_sett.var_5){

    }
})
const isDataSendNotEmpty = computed(() => {
  for (const key in data_send) {
    if (data_send[key].length > 0) {
      return true;
    }
  }
  return false;
});
const select_filter = (data,name)=>{
    if(button_selected.value == null){
        return null
    }
    if(button_selected.value == buttons_sett.var_1.slug){
        const index = data_send.tags.findIndex((item) => item.tag_id == data.tag_id);
        console.log(index);
        if(index == -1){
            data_send.tags.push(data);
        }else{
            data_send.tags.splice(index, 1);
        }

    }
    if(button_selected.value == buttons_sett.var_2.slug){
            const index = data_send.autor.findIndex((item) => item.autor_id == name);
            console.log(index)
            if(comunity_data.comunidad == 1){
                comunity_data.comunidad = 0;
                data_send.comunidad.pop()
            }
            if (data_send.autor.length < 1) {
                data_send.autor.push({ name_autor:data , autor_id: name });
            } else {
                data_send.autor.splice(index, 1);
                if(index == -1){
                    data_send.autor.push({ name_autor:data , autor_id: name });
                }
            }

    }
    if(button_selected.value == buttons_sett.var_3.slug){
        const index = data_send.content_type.findIndex((item) => item.content_type_id == name);
        if(index == -1){
            data_send.content_type.push({ name_content_type:data , content_type_id: name });
        }else{
            data_send.content_type.splice(index, 1);
        }
    }
    if(button_selected.value == buttons_sett.var_4){

    }
    if(button_selected.value == buttons_sett.var_5){

    }
}
const pick_comunity = (data)=>{
    console.log(data);
    if(data == 'comunidad'){
        comunity_data.comunidad = 1;
        data_send.comunidad.push({ name: 'comunidad'})
        data_send.autor = [];
    }
    if(data == 'administrador'){
        comunity_data.comunidad = 0;
        data_send.comunidad.pop()
    }
}
const delete_selected = (data,key)=>{
    const index = data_send[key].indexOf(data);
  if (index !== -1) {
    data_send[key].splice(index, 1);
  }
}
const rating_base = ref('Administrador')
const select_rating = (data)=>{
    rating_base.value=data;
    if(rating_base.value.nombre == 'Administrador'){
            comunity_data.ratingC = 0
    }
    if(rating_base.value.nombre == 'Comunidad'){
            comunity_data.ratingC = 1
    }
}
const getLetter = (index, cajas) => {
      let keys = Object.keys(cajas);
      let key = keys[index];
      if (index >= 0 && index < 2) {
        const key_e = keys[0];
        const letra = cajas[key_e];
        return letra
      }else if (index >= 2 && index < 4) {
        const key_d = keys[1];
        const letra = cajas[key_d];
    
        return letra
      }else if (index >= 4 && index < 6){
        const key_c = keys[2];
        const letra = cajas[key_c];
        return letra
      }else if(index >= 6 && index < 8){
        const key_b = keys[3];
        const letra = cajas[key_b];
        return letra
      }else if(index >= 8 && index <= 9){
        const key_a = keys[4];
        const letra = cajas[key_a];
        return letra
      }else{
        const key_s = keys[5];
        const letra = cajas[key_s];
        return letra
      }
    
};

watch([rating_base, selectedValue], ([newSubobjeto, newValue], [oldSubobjeto, oldValue]) => {
    if (newSubobjeto) {
      const letra = getLetter(newValue, newSubobjeto.puntuacion);
      const nombre = newSubobjeto.nombre;
      if(nombre == 'Administrador'){
          data_send.rating = [{ name: letra, tipo: nombre, rating_main_id: selectedValue   }]; 
      }
      if(nombre == 'Comunidad'){
          data_send.rating = [{ name: letra, tipo: nombre, rating_main_id: selectedValue  }]; 
  
      }
    }
});
const filteredPaginate = ref([])
const data_send_see = ()=>{
    const filteredData = {};
                for (const key in data_send) {
                    if (key === 'Autor') {
                        console.log(filteredData[key])
                        filteredData[key] = data_send[key].map(item => ({
                            user_id: item.user_id,
                            comunidad: item.comunidad
                        }));
                    } else {
                        filteredData[key] = data_send[key].flatMap(item => {
                            const filteredItems = [];
                            for (const prop in item) {
                                if (prop.endsWith('_id')) {
                                    filteredItems.push(item[prop]);
                                }
                            }
                            return filteredItems;
                        });
                    }
                }
        filteredData.comunidad = comunity_data.comunidad;
        filteredData.ratingC = comunity_data.ratingC;    
        filteredPaginate.value = filteredData;
}
const delete_all = () =>{
        data_send.tags = [];
        data_send.authors = [];
        data_send.content_type = [];
        data_send.rating = [];
        data_send.time = [];
        data_send.rating =[];
        filteredPaginate.value = [];        
}
</script>

<template>
    <div class="border_">
        <div class="container-fluid">
           <!-- Button trigger modal -->
            <div class="row">
                <div class="col-auto">
                    <div v-if="isDataSendNotEmpty" class="filter_present ms-1">
                        <h3>Filtros actuales</h3>
                        <div class="d-inline" v-for="(data_see,key) in data_send">
                            <div class="d-inline" v-for="object in data_see">
                                <button class="btn btn-dark me-2 mb-1 mt-1" @click="delete_selected(object,key)">
                                    {{ object.name_tag }}
                                    {{ object.name_autor }}
                                    {{ object.name_content_type }}
                                    {{ object.name }}
                                    <i class="ms-2 bi bi-x-circle"></i>
                                </button>
                            </div>
                        </div>
                        <ButtonG  class="btn-danger ms-3 mt-0" @click='delete_all() ; coverStore.cover_paginate(1,NonNullable,filteredPaginate)'>
                                Eliminar filtros
                        </ButtonG>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-dark mt-5 mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        filtrar
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Filtrar Datos</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid base_search_filter mt-2 mb-2" >
                                        <form class="d-flex" role="search" @submit.prevent>
                                        <input class="form-control me-2" v-model="searchTerm"  type="search" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-success" type="submit">Search</button>
                                        </form>
                                </div>

                                <div class="d-flex ">
                                    <div v-for="(objeto, key) in buttons_sett" >
                                        <button type="button" class="btn  ms-2" @click="set_computed_data(objeto.slug)" :class="button_selected === objeto.slug ? 'btn-success' : 'btn-dark'">
                                            {{ objeto.nombre }}
                                        </button>
                                    </div>
                                </div>
                                    <div class="d-flex mt-2">
                                            <div class="d-flex">
                                                <div  v-if="button_selected == buttons_sett.var_2.slug" v-for="data in buttons_sett.var_2.tipo">
                                                    <button class="btn btn-success ms-3" @click="pick_comunity(data)" :class="comunity_data.comunidad == 1 ? 'btn-success' : 'btn-dark'">
                                                        {{ data }}
                                                    </button>
                                                </div>
                                                <div v-if="comunity_data.comunidad == 1">
                                                    <h4 class="mt-1 ms-2" v-if="button_selected == buttons_sett.var_2.slug"> Buscaras reseñas hechas por la comunidad</h4>
                                                </div>
                                            </div>
                                            <div v-if="button_selected == buttons_sett.var_4.slug" v-for="data in buttons_sett.var_4.tipo">
                                                <button class="btn btn-success ms-3">
                                                    {{ data }}
                                                </button>
                                            </div>
                                            <div v-if="button_selected == buttons_sett.var_5.slug">
                                                <div class="container-fluid">
                                                    <div class="row" >
                                                        <div class="col-6" v-for="objetos in buttons_sett.var_5.calificacion">
                                                            <button class="btn btn-success" @click="select_rating(objetos)">
                                                                {{ objetos.nombre }}
                                                            </button>
                                                        </div>
                                                        <div class="col-6"  >
                                                            <div v-for="objetos in buttons_sett.var_5.calificacion">
                                                                <div v-if="objetos == rating_base">
                                                                    <input class="form-range input_edit" v-model="selectedValue"   type="range" min="1" max="10" step="1">
                                                                    <p>Calificacion: <label  class="btn-dark btn mb-1">{{ getLetter(selectedValue, objetos.puntuacion) }}</label></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- el de rating -->
                                    </div>
                                    <div class="d-flex">
                                        <div class="" v-for="(filter_data, id) in case_filter" >
                                                    <div v-if="button_selected == buttons_sett.var_1.slug">
                                                        <a  role="button" class="btn btn-info me-2 mt-2 mb-2" @click="select_filter(filter_data)">
                                                            {{ filter_data.name_tag }}
                                                        </a>
                                                    </div>
                                                    <div v-else>
                                                        <a  role="button" class="btn btn-info me-2 mt-2 mb-2"  @click="select_filter(filter_data,id)">
                                                            {{ filter_data }}
                                                        </a>
                                                    </div>
                                        </div>
                                    </div>
                                    <div class="mt-2" v-if="isDataSendNotEmpty">
                                        <h3>Datos seleccionados</h3>
                                        <div class="d-inline" v-for="(data_see,key) in data_send">
                                            <div class="d-inline" v-for="object in data_see">
                                                <button class="btn btn-dark me-2 mt-2 mb-2" @click="delete_selected(object,key)">
                                                    {{ object.name_tag }}
                                                    {{ object.name_autor }}
                                                    {{ object.name_content_type }}
                                                    {{ object.name }}
                                                    <i class="ms-2 bi bi-x-circle"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click='data_send_see() ; coverStore.cover_paginate(1,NonNullable,filteredPaginate)' >Filtrar datos</button>
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
.base_search_filter{
    background: rgb(153, 64, 64);
    padding: 10px;
    border-radius: 5px;
}
.filter_present{
    background: rgb(172, 187, 186);
    padding: 15px;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}
</style>
