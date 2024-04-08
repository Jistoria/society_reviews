<template>
  <div class="search-bar">
    <input type="text" v-model="searchQuery" @input="onSearchInput" placeholder="Buscar..." />
    <span class="search-icon">
      <i class="bi bi-search"></i>
    </span>
    <span class="clear-icon" @click="clearSearchQuery" v-if="searchQuery !== ''">
      <i class="bi bi-x-lg"></i>
    </span>
  </div>
</template>

<script setup>
import { ref, watch, defineProps } from 'vue';
const franquiciaStore= FranchiseAd();
const reviewStore = ReviewAd();
const coverStore = coversE();
const props = defineProps({
  rawr: {
    type: String,
    required: true
  },
  onSearch: {
    type: Function,
    required: true
  },
});

const searchQuery = ref('');

const clearSearchQuery = () => {
  searchQuery.value = '';
  switch(props.rawr) {
    case 'franquicia':
      franquiciaStore.Franchise_get();
      break;
    case 'review':
      reviewStore.Review_get();
    break;
    case 'cover':
      coverStore.get_data();
    break;
    default:
      console.log('Identificador no reconocido');
  }
};
let timerId = null; // Variable para almacenar el identificador del temporizador
const debounceDelay = 500; // Tiempo de espera antes de ejecutar la búsqueda después de la última entrada del usuario (en milisegundos)
const onSearchInput = () => {
  if (searchQuery.value.length >= 4) {
    // Cancela la búsqueda previa si aún no se ha realizado
    clearTimeout(timerId);

    // Establece un temporizador para retrasar la búsqueda
    timerId = setTimeout(() => {
      props.onSearch(1, searchQuery.value);
    }, debounceDelay);
  }
};

watch(searchQuery, (newValue) => {
  console.log('buscador:', newValue);
  console.log('identificador:', props.rawr);
  if (newValue === '') {
    clearSearchQuery();
  }
});


</script>

<style scoped>
.search-bar {
  margin-bottom: 20px;
  position: relative;
  display: inline-block;
  width: 50%; /* Ancho fijo en la mitad del contenedor */
}

.search-bar input {
  padding: 10px;
  padding-right: 35px; /* Ajustar el padding derecho para dejar espacio para los iconos */
  width: 100%; /* Ancho completo del input */
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  outline: none;
}

.search-icon,
.clear-icon {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
}

.search-icon {
  right: 10px; /* Alineado a la izquierda */
  cursor: default; /* Quitar el cursor pointer */
}

.clear-icon {
  right: 40px; /* Alineado a la derecha */
  opacity: 0.5;
  cursor: pointer; /* Establecer el cursor pointer */
}

.clear-icon:hover {
  opacity: 1;
}
</style>
