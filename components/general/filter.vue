<script setup>
import { ref, reactive } from "vue";

const coverStore = coversE()
const filteredPaginate = ref(null)

const P_tags = 10;
const P_author = 3;
const prueba = 10;
const content_type = 10;
//
const data_tags = ref(null);
//llamada al pinia
const tagsP = TagsAd();
const reviewP = ReviewAd();
const coverP = coversE();

onMounted(async () => {
    await tagsP.Tags_pluck();
    await reviewP.Review_content_type();
    await reviewP.filter();
    data_tags.value = tagsP.tags;
});
const filter_show = ref(null)
const subobjetoSeleccionado = ref(null);
const data_count = reactive({
    tags_count:'',
    author_count:'',
    time_count:'',
    rating_count:'',
})
const data_send = reactive({
    tags:[],
    authors:[],
    content_type:[],
    time: [],
    rating:[],
})
const objetos = reactive({
    dato_1:{
        nombre:'tags'
    },
    datos_2:{
        nombre:'autor',
        subobjeto3_segun:{
            nombre_3:'Administradores',
            nombre_4:'Comunidad'
        }
    },
    dato_3:{
        nombre:'tipo de contenido'
    },
    dato_4:{
        nombre:'fecha',
        subobjeto_segun:{
            nombre_1:'mas recientes',
            nombre_2:'mas antiguos',
        }
    },
    dato_5:{
        nombre:'Calificacion',
        subobjeto2_segun:{
            otro_objeto1:{
                nombre:'creador',
                cajas:{
                    caja_1:'A1',
                    caja_2:'B2',
                    caja_3:'C3',
                    caja_4:'D4',
                    caja_5:'E5',
                }
            },
            otro_objeto2:{
                nombre:'comunidad',
                cajas:{
                    caja_1:'A6',
                    caja_2:'B7',
                    caja_3:'C8',
                    caja_4:'D9',
                    caja_5:'E10',
                }
            }
        }
    }
})
const filter_navegate = reactive({
    tags:{
        nombre:'tags',
    },
    author:{
        nombre:'author',
    },
    fecha:{
        nombre:'fecha',
        tiempo_segun:{
            recientes:'las mas recientes',
            antiguos:'los mas antiguos',
        }
    },
    calificacion:{
        nombre:'calificacion',
        nota_segun:{
            usuarios:{
                segun:'usuarios',
                notas:{
                    A:'A',
                    B:'B',
                    C:'C',
                    D:'D',
                    E:'E',
                }
            },
            creador:{
                segun:'creador',
                notas:{
                    A:'A',
                    B:'B',
                    C:'C',
                    D:'D',
                    E:'E',
                }
            },
        }
    }

})
const hasPropSegun = (objeto) => {
    let buscar_propiedad_segun = Object.keys(objeto).some(key => key.endsWith('_segun'));
    return buscar_propiedad_segun
};
const target_filter = async(data)=>{
    if(filter_show.value == data){
        filter_show.value = null;
        return filter_show.value;
    }
    filter_show.value = data;
    return filter_show.value;
}
const selectSubobjeto = (subobjeto) => {
    // console.log(subobjeto);
    if(subobjetoSeleccionado.value == subobjeto){
            subobjetoSeleccionado.value = null;
           return subobjetoSeleccionado.value;
    //     console.log('son iguales')
    }
     subobjetoSeleccionado.value = subobjeto;
};
const data_send_see = async() =>{
    const data_idO = {
         "tags_id": data_send.tags,
         "author_id": data_send.authors,
         "content_type_id": data_send.content_type,
         "time_id_filter": data_send.time,
         "rating_id_filter": data_send.rating,
    };

    const filteredData = {};
    for (const key in data_send) {
    filteredData[key] = data_send[key].map(item => {
        const filteredItem = {};
        for (const prop in item) {
        if (prop.endsWith('_id')) {
            filteredItem[prop] = item[prop];
        }
        }
        return filteredItem;
    });
    }
    filteredPaginate.value = filteredData;
    console.log(filteredData);
}
const show_filter = ()=>{
    if(filter_show.value == null){
        return false
    }
    return true
}
//prueba
const searchTerm = ref('');
//datos computados
const filteredSubobjetos = computed(() => {
  if (subobjetoSeleccionado.value) {
    return Object.values(subobjetoSeleccionado.value.cajas).filter(caja => caja.toLowerCase().includes(searchTerm.value.toLowerCase()));
  }
  return [];
});
const filtered_tags = computed(()=>{
    return tagsP.tags.filter(tag => tag.name_tag.toLowerCase().includes(searchTerm.value.toLowerCase()));

})
const filtered_content_type = computed(()=>{
    const filtered = {};
    for (const key in reviewP.content_type) {
        if (reviewP.content_type[key].toLowerCase().includes(searchTerm.value.toLowerCase())) {
        filtered[key] = reviewP.content_type[key];
        }
    }
    return filtered;
})


//
const restructureIds = () => {
    
    let totalCount = checkedTags.value.length + checkedContentTypes.value.length + checkedDate.value.length + checkedAuthors.value.length;
    idCounter = totalCount > 0 ? totalCount + 1 : 1;

    checkedTags.value.forEach((tag, index) => {
        tag.id = index + 1;
    });
    checkedContentTypes.value.forEach((contentType, index) => {
        contentType.id = index + 1 + checkedTags.value.length;
    });
    checkedDate.value.forEach((date, index) => {
        date.id = index + 1 + checkedTags.value.length + checkedContentTypes.value.length;
    });
    checkedAuthors.value.forEach((author, index) => {
        author.id = index + 1 + checkedTags.value.length + checkedContentTypes.value.length + checkedDate.value.length;
    });

};
//para tags globales
let idCounter = 1;
// Define una función reactiva para obtener el próximo identificador
const getNextId = () => {
  return idCounter++;
};

// Define un array reactiva para almacenar los tags seleccionados
const checkedTags = ref([]);

// Función para verificar si un tag está seleccionado
const isCheckedTag = (tag) => {
    // console.log(tag.name_tag)
    //console.log(checkedTags.value.some((item) => item.name_tag == tag.name_tag))
    return checkedTags.value.some((item) =>  item.tag_id == tag.tag_id);
};

// Función para alternar la selección de un tag
const toggleCheckedTag = (tag) => {
  const index = checkedTags.value.findIndex((item) => item.tag_id == tag.tag_id);
  if (index == -1) {
    checkedTags.value.push({ ...tag, id: getNextId() });
  } else {
    checkedTags.value.splice(index, 1);
    restructureIds();

  }
  // Actualiza los tags en data_send según los tags seleccionados
  data_send.tags = checkedTags.value;
};

//para tipo de contenido
const checkedContentTypes = ref([]);

// Función para verificar si un tipo de contenido está seleccionado
const isCheckedContentType = (contentType) => {
  return checkedContentTypes.value.some((item) => item.content_type_id == contentType.content_type_id);
};

// Función para alternar la selección de un tipo de contenido
const toggleCheckedContentType = (contentType) => {
    const index = checkedContentTypes.value.findIndex((item) => item.content_type_id == contentType.content_type_id);
    if (index == -1) {
        checkedContentTypes.value.push({ ...contentType, id: getNextId() });
    } else {
        checkedContentTypes.value.splice(index, 1);
        restructureIds();

    }
  // Actualiza los tipos de contenido en data_send según los tipos de contenido seleccionados
  data_send.content_type = checkedContentTypes.value;
};
//para fechas
const checkedDate = ref([]);
const isCheckedDate = (name) =>{
    return checkedDate.value.some((item)=> item.name == name.name)

};

const toggleCheckedDate = (data)=>{
    const index = checkedDate.value.findIndex((item) => item.name == data.name);
    console.log(index);
    if (index == -1) {
        console.log('estoy en true');
        checkedDate.value.push({...data , id: getNextId()});
        console.log(checkedDate.value);
    } else {
        console.log('estoy en false')
        checkedDate.value.splice(index, 1);
        console.log(checkedDate.value);
        restructureIds();
    }
    data_send.time = checkedDate.value;
  // Actualiza los tipos de contenido en data_send según los tipos de contenido seleccionados

}
//para autores
const checkedAuthors = ref([]);
const toggleCheckedAuthor = (author) => {
    const index = checkedAuthors.value.findIndex((item) => item.name === author.name);
    if (index === -1) {
        if (checkedAuthors.value.length < 1) {
            checkedAuthors.value.push({ ...author, id: getNextId() });
            restructureIds()
        }

    } else {
        checkedAuthors.value.splice(index, 1);
        restructureIds();

    }
    data_send.authors =checkedAuthors.value;
};

const isCheckedAuthor = (author) => {
    return checkedAuthors.value.some((item) => item.name === author.name);
};
//para el range
const selectedValue = ref(0); // Valor seleccionado inicialmente
const selectedLetter = ref('');
const autors_var = ref(null);
const getLetter = (index, cajas) => {
  let keys = Object.keys(cajas);
  let key = keys[index];
  let letra = cajas[key];

  if (index >= 0 && index < 2) {
    const key_a = keys[0];
    const letra = cajas[key_a];
    return letra
  }else if (index >= 2 && index < 4) {
    const key_b = keys[1];
    const letra = cajas[key_b];
    return letra
  }else if (index >= 4 && index < 6){
    const key_c = keys[2];
    const letra = cajas[key_c];
    return letra
  }else if(index >= 6 && index < 8){
    const key_d = keys[3];
    const letra = cajas[key_d];
    return letra
  }else{
    const key_e = keys[4];
    const letra = cajas[key_e];
    return letra
}

  //lo que tendria que hacer es que dependiendo del paso que envia hacer el v-if con la calificacion

};
watch([subobjetoSeleccionado, selectedValue], ([newSubobjeto, newValue], [oldSubobjeto, oldValue]) => {
  if (newSubobjeto) {
    selectedLetter.value = getLetter(newValue, newSubobjeto.cajas);
    const letra = getLetter(newValue, newSubobjeto.cajas);
    const nombre = newSubobjeto.nombre;
    data_send.rating = [{ name: letra, tipo: nombre, rating_main: selectedValue  }]; // Objeto con la letra y el nombre

  }
});
const data_autors = (data)=>{
    autors_var.value = data;
    console.log(autors_var.value);
} 
const autor_see = computed(()=>{
    if(autors_var.value == 'Administradores'){
        const filtered = {};
        for(const key in reviewP.authors.authors_admin){
            if (reviewP.authors.authors_admin[key].toLowerCase().includes(searchTerm.value.toLowerCase())) {
                filtered[key] = reviewP.authors.authors_admin[key];
            }
        }
        return filtered
    }
    if(autors_var.value == 'Comunidad'){
        const filtered = {};
        for(const key in reviewP.authors.authors_community){
            if(reviewP.authors.authors_community[key].toLowerCase().includes(searchTerm.value.toLowerCase())){
                filtered[key] = reviewP.authors.authors_community[key];
            }
        }
        return  filtered;

    }
    if(autors_var.value ==  null){
        return false;
    }
})
//borrar
const delete_data = (groupName, index)=>{
    console.log(groupName);
    console.log(index);
    data_send[groupName].splice(index, 1);
    restructureIds()

}
//expansible
const contentWidth = ref('100%'); // Establece el ancho inicial al 100%
let totalWidth = 0; // Inicializa el ancho total

// Observa los cambios en data_send y ajusta la anchura del contenido en consecuencia
watch(data_send, () => {
  totalWidth = calculateTotalWidth();
  contentWidth.value = totalWidth;
}, { deep: true });

// Función para calcular el ancho total del contenido en píxeles
const calculateTotalWidth = () => {
  let width = 0;
  for (const groupName in data_send) {
    width += data_send[groupName].length * 150; // Aumenta en 20 píxeles cada vez
  }
  return width;
};

</script>
<template>
    <div>
        <div >
            <div class="container-fluid">
                <div class="mt-1 mb-1">
                    <!-- la lista de objetos -->
                    <div v-for="(objeto, key) in objetos" :key="key" class=" d-inline-block mb-1 me-2 rounded p-2">
                        <button class="btn btn-dark" @click="target_filter(objeto.nombre)">
                            {{ objeto.nombre }}
                        </button>
                    </div>
                    <!-- base de todo los botones -->
                    <div class="base_container_filter" v-if="show_filter()">
                        <div>
                                <!-- buscador -->
                                <div class="container-fluid" v-if="!(filter_show == 'Calificacion')">
                                    <form class="d-flex" role="search" @submit.prevent>
                                    <input class="form-control me-2" v-model="searchTerm"  type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-success" type="submit">Search</button>
                                    </form>
                                </div>
                                <div>
                                    <!-- tags -->
                                    <div>
                                        <div class="d-inline ms-3" v-if="filter_show == 'tags'"  v-for="(tag, index) in filtered_tags" :key="index" >
                                            <ButtonG class="button_filter mt-2 mb-3"  @click="toggleCheckedTag(tag)">
                                                    {{ tag.name_tag }}
                                                    <i v-if="isCheckedTag(tag)"     class="bi bi-check-circle-fill"></i>
                                                    <i  v-else   class="bi bi-circle"></i>
                                            </ButtonG>
                                        </div>
                                    </div>
                                    <!-- autores -->
                                    <div>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-2 ms-2 me-5 mt-2 mb-2"  v-for="data in objetos.datos_2.subobjeto3_segun" v-if="filter_show == 'autor'">
                                                    <div>
                                                        <ButtonG class="btn-dark " @click="data_autors(data)">
                                                            {{ data }}
                                                        </ButtonG>
                                                    </div> 
                                                </div>
                                                <div class="col-12">
                                                    <div v-for="(name,user_id) in autor_see" v-if="filter_show == 'autor'" class="d-inline ms-3">
                                                        <ButtonG class="button_filter mt-2 mb-2" @click="toggleCheckedAuthor({name,user_id})">
                                                            {{ name }}
                                                            <i v-if="isCheckedAuthor({name})" class="bi bi-check-circle-fill"></i>
                                                            <i v-else class="bi bi-circle"></i>
                                                        </ButtonG>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- tipo de contenido -->
                                    <div>   
                                        <div class="d-inline ms-3" v-if="filter_show == 'tipo de contenido'" v-for="(name, content_type_id) in filtered_content_type" >
                                            <ButtonG class="button_filter mt-2 mb-3"   @click="toggleCheckedContentType({ content_type_id, name })" >
                                                    {{ name }} 
                                                    <i v-if="isCheckedContentType({ content_type_id, name })" class="bi bi-check-circle-fill"></i>
                                                    <i v-else class="bi bi-circle"></i>
                                            </ButtonG>
                                        </div>
                                    </div>
                                    <!-- data en subojetos -->
                                    <div>
                                        <!-- fecha -->
                                        <div>
                                            <div v-for="(objeto, index) in objetos" :key="index">
                                                <div v-if="hasPropSegun(objeto)" class="me-2 ms-2 mt-0 ">
                                                    <div v-if="objeto.subobjeto_segun && filter_show=='fecha'">
                                                        <div v-for="(name,index,number) in objeto.subobjeto_segun" :key="number" class="d-inline ms-3 mb-2 ">
                                                            <ButtonG class="button_filter mt-2 mb-2 " @click="toggleCheckedDate({name})">
                                                                {{ name }}
                                                                <i v-if="isCheckedDate({name})" class="bi bi-check-circle-fill"></i>
                                                                <i v-else class="bi bi-circle"></i>
                                                            </ButtonG>
                                                        </div>
                                                    </div>
                                                    <div v-if="objeto.subobjeto2_segun && filter_show == 'Calificacion'">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-2 me-2 mt-1 mb-3" v-for="(subobjeto, subkey) in objeto.subobjeto2_segun" :key="subkey">
                                                                    <ButtonG class="btn-dark" @click="selectSubobjeto(subobjeto)" :class="subobjeto === subobjetoSeleccionado ? 'border_black' : ''">
                                                                        {{ subobjeto.nombre }}
                                                                    </ButtonG>
                                                                </div>
                                                                <div class="col-12 ">
                                                                    <div v-for="subobjeto in objeto.subobjeto2_segun">
                                                                        <div v-if="subobjeto == subobjetoSeleccionado">
                                                                            <input class="form-range input_edit" v-model="selectedValue" :id="'data_'+  subobjeto.nombre"  type="range" min="0" max="9" step="1">
                                                                            <p>Calificacion: <label :for="'data_'+ subobjeto.nombre" class="btn-dark btn mb-1">{{ getLetter(selectedValue, subobjeto.cajas) }}</label></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- lo que se muestra de todos los datos seleccionados -->
                                    <div class="container-fluid" v-if="show_filter()">
                                        <div class="row">
                                            <div class="col-10">


                                                    <div class="base_send ">
                                                        <div :style="{ width: contentWidth + 'px' }">
                                                            <div v-for="(group, groupName) in data_send" :key="groupName" class="d-inline">
                                                                <div  v-for="(item, index) in group" :key="index"   class="d-inline-block base_button_first">
                                                                        <div class="d-flex justify-content-center">
                                                                            <ButtonG class="btn-dark ms-1 mt-2 mb-2 "  @click="delete_data(groupName, index)">
                                                                                {{ item.name }} {{ item.name_tag }}
                                                                                <i class="bi bi-x-circle"></i>
                                                                            </ButtonG>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                            </div>
                                            <div class="col-2">
                                                <ButtonG class="btn-dark ms-0 mt-2" @click='data_send_see() ; coverStore.cover_paginate(1,NonNullable,filteredPaginate)'>
                                                        filtrar
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
</template>
<style>
.base_container_filter{
    padding: 25px;
    border-radius: 5px;
    background: rgb(103, 105, 105);
    width: 37%;
    position: absolute;
    z-index: 1000000;

}
.button_filter{
    background: rgb(206, 169, 169) ;
    border-radius: 50px;
    margin-left: -6px;
}   
.input_edit{
    border-radius: 50% !important;
}
.input_edit:checked {
  background-color: green;
}
.button_filter:hover{
    background: rgb(169, 107, 107) ;

}
.input_filter{
    margin-left: 5px;
    margin-top: 8px;
}
/* expansion */
.base_send{
    background: lightblue;
    width: 100%;
    overflow-x: auto;
    border-radius: 15px;
}
/* .base_button{
    width: 120px;
    height: 40px;
} */
.base_button_first{
    width: 150px;
    border: 0px solid red;

}
.expansion{
    width: 900px;
}

</style>