<script setup>
import Swal from 'sweetalert2';
import { AlertaSesion } from '~/composables/AlertaSesion';
const { showErrorAlert, showLoadingAnimation, showSuccessAlertSkinny, showConfirmationAlert,showErrorNormalAlert} = AlertaSesion();
const form = reactive({
    name_tag:'',
    description:'',
});
const searchTerm = ref('');
const filteredTags = computed(() => {
    return tagStore.tags.filter(tag => tag.name_tag.toLowerCase().includes(searchTerm.value.toLowerCase()));
});
const btnGuardar = ref(null);
const btnEditar = ref(null);
const btnCancelar = ref(null);
const defaultButton = ref(true);
const editsButton = ref(false);
const state = reactive({
    editsButton: false,
    defaultButton: true,
    editsButton2: true,
    defaultButton2: true,
});
const tagStore = TagsAd();

function comprobarCampos() {
    if (form.name_tag.trim() !== '' && form.description.trim() !== '') {
        state.defaultButton2 = false; // Habilitar el botón de guardar
        state.editsButton2 = false; // Habilitar el botón de editar
    } else {
        state.defaultButton2 = true; // Deshabilitar el botón de guardar
        state.editsButton2 = true; // Deshabilitar el botón de editar
    }
}
const crudcitoTag = async () =>{
        try {
        showLoadingAnimation('Procesando');
        const tagsu = await tagStore.Tags_post(form);
        console.log(tagsu)
        if (tagsu.success === true) {
                showSuccessAlertSkinny(tagsu.message);
                await tagStore.Tags_get();
        }else{
            await showErrorAlert('Error en la subida', tagsu.message);
        } 
    } catch (error) {
        await showErrorAlert('Error', ['Hubo un problema durante la subida.']);
    }
}
const deleteTag = async (id_tag) =>{
    const conf = await showConfirmationAlert('¿Quieres eliminar el tag?','El tag eliminado no podra recuperarse');
    if(conf== true){
        try {
            showLoadingAnimation('Procesando');
            const tagsu = await tagStore.Tags_delete(id_tag);
            console.log(tagsu);
            if (tagsu.success === true) {
                showSuccessAlertSkinny(tagsu.message);
                await tagStore.Tags_get();
            } else {
                await showErrorNormalAlert('Error en la eliminacion', tagsu.message);
            } 
        } catch (error) {
            console.log(error);
            await showErrorNormalAlert('Error', [error.message]); // Capturas el mensaje de error y lo muestras en la alerta
        }
    }else{
        return
    }
}
let id=null;
const editTagO = async (tags) => {
    limpiarCampos()
    form.name_tag = tags.name_tag
    form.description= tags.description
    id=tags.tag_id
    console.log(id)
    state.editsButton = true;
    state.defaultButton = false;
}

const editTagC = async () => {
    state.editsButton = false;
    state.defaultButton = true;
    limpiarCampos()
}
const limpiarCampos = async () => {
    form.name_tag = '',
    form.description= ''
    if(id){
        id=''
    }
}
const descripcionV = async (description) => {
    Swal.fire({
    title: "Descripcion:",
    text: description,
    icon: "info"
    });
}
const putTag = async (id) => {
    if(id!==null){
            console.log(id)
        try {
            showLoadingAnimation('Procesando');
            const tagsu = await tagStore.Tags_put(form,id);
            console.log(tagsu)
            if (tagsu.success === true) {
                    showSuccessAlertSkinny(tagsu.message);
                    await tagStore.Tags_get();
            }else{
                await showErrorAlert('Error en la subida', tagsu.message);
            } 
        } catch (error) {
            await showErrorAlert('Error', ['Hubo un problema durante la subida.']);
        }
    }else{
        console.log('no')
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
                                <TextInput type="text" class="form-control" id="titulo" placeholder="Ingrese el título" v-model="form.name_tag" @input="comprobarCampos" ></TextInput>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" placeholder="Ingrese la descripción" v-model="form.description" @input="comprobarCampos"></textarea>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button ref="btnCancelar" class="btn btn-primary mt-3 ml-auto" @click.prevent="editTagC" :disabled="false" v-if="state.editsButton">Cancelar</button>
                                <button ref="btnEditar" class="btn btn-primary mt-3 ml-auto"  @click.prevent="putTag(id)" :disabled="state.editsButton2" v-if="state.editsButton">Editar</button>
                                <button ref="btnGuardar" class="btn btn-primary mt-3 ml-auto" :disabled="state.defaultButton2" v-if="!state.editsButton" type="submit">Guardar</button>
                            </div>
                        </form>
                        
                        </div>
                        <div class="col-md-6" style="max-height: 400px; overflow-y: auto;">
                            <div class="search-container">
                                <input type="text" v-model="searchTerm" class="search-input" placeholder="Busca un tag creado por su nombre">
                            </div>
                                <div v-for="(tag, index) in filteredTags" :key="index" class="tag-item d-flex justify-content-between align-items-center ">
                                    <div class="tag-info">
                                        <span class="tag-id">ID: {{ tag.tag_id }}</span>
                                    </div>
                                    <div class="tag-info">
                                        <span class="tag-title">{{ tag.name_tag }}</span>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-info me-1"  @click="descripcionV(tag.description)">
                                                <i class="bi bi-card-text" ></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning me-1" @click="editTagO(tag)">
                                                <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger me-1" @click="deleteTag(index)">
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
    .search-container {
        margin-bottom: 10px;
      }
      
      .search-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
      }
      
</style>