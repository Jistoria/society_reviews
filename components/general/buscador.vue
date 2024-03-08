<template>
  <div class="search-bar">
    <input type="text" v-model="searchQuery" placeholder="Buscar..." />
    <span class="search-icon">
      <i class="bi bi-search"></i>
    </span>
    <span class="clear-icon" @click="clearSearchQuery" v-if="searchQuery !== ''">
      <i class="bi bi-x-lg"></i>
    </span>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';

const searchQuery = ref('');

const clearSearchQuery = () => {
  searchQuery.value = '';
};

watch(searchQuery, (newValue) => {
  // Aquí puedes realizar acciones adicionales cada vez que searchQuery cambie
  console.log('Nuevo valor de searchQuery:', newValue);
  // También puedes actualizar el estado global aquí, si es necesario
  // franchiseStore.search.update(newValue);
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
