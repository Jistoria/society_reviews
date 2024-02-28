<script setup>
import { AlertaSesion } from '~/composables/AlertaSesion';
const { showErrorAlert, showLoadingAnimation, showSuccessAlertSkinny} = AlertaSesion();
const form = reactive({
    title:'',
    descripcion:''
});

const btnGuardar = ref(null);
const tagStore = TagsAd();

function comprobarCampos() {
    if (form.title.trim() !== '' && form.descripcion.trim() !== '') {
        btnGuardar.value.disabled = false;
    } else {
        btnGuardar.value.disabled = true;
    }
}
const crudcitoTag = async () =>{
        console.log(tagsall)
        try {
        showLoadingAnimation('Procesando');
        const tagsu = await tagStore.Tags_post(form);
        if (tagsu === true) {
                showSuccessAlertSkinny('Tag creado');
        } 
    } catch (error) {
        console.error('Error durante la subida:', error);
        await showErrorAlert('Error', ['Hubo un problema durante la subida.']);
    }
}
onMounted(async () => {
    await tagStore.Tags_get();
});
</script>
<template>
        
        <h1>Tags desune</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Tags Crud</h2>
                    <form @submit.prevent="crudcitoTag">
                        <div class="form-group">
                                <label for="titulo">Titulo:</label>
                                <TextInput type="text" class="form-control" id="titulo" placeholder="Ingrese el título" v-model="form.title" @input="comprobarCampos" ></TextInput>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" placeholder="Ingrese la descripción" v-model="form.descripcion" @input="comprobarCampos"></textarea>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button ref="btnGuardar" class="btn btn-primary mt-3 ml-auto" :disabled="true" type="submit">Guardar</button>
                            </div>
                        </form>
                        
                        </div>
                        <div class="col-md-6" style="max-height: 300px; overflow-y: auto;">
                                <h2>Tags Creados</h2>
                                <div v-for="(tag, index) in tagStore.tags" :key="index" class="tag-item d-flex justify-content-between align-items-center ">
                                    <div class="tag-info">
                                        <span class="tag-id">ID: {{ index }}</span>
                                    </div>
                                    <div class="tag-info">
                                        <span class="tag-title">{{ tag }}</span>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-info me-1">
                                                <i class="bi bi-card-text"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning me-1">
                                                <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger me-1">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                        </div>
                </div>
        </div>
        <NuxtLink to="/place/admin/tags/tagsPOST">
            voy a tags
        </NuxtLink>
    </template>
<style>
.tag-item {
        margin-bottom: 10px; /* Espaciado inferior entre los elementos */
        padding: 10px; /* Espaciado interno de los elementos */
        border: 1px solid #ccc; /* Borde alrededor de los elementos */
        border-radius: 5px; /* Bordes redondeados */
        background-color: #f9f9f9; /* Color de fondo */
    }
    
    .tag-info {
        margin-bottom: 5px; /* Espaciado inferior dentro de tag-info */
    }
    
    .tag-id {
        color: blue; /* Color del texto del ID */
        font-weight: bold; /* Texto en negrita */
    }
    
    .tag-title {
        color: green; /* Color del texto del título */
    }
    
    .btn-primary {
        margin-left: 10px; /* Espaciado a la izquierda del botón */
    }
</style>