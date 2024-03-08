<template>
  <div ref="paginationContainer" class="pagination-container text-center mt-3 mb-3">
    <div v-if="totalPages > 1" class="pagination-container text-center mt-3 mb-3">
      <button v-for="button in paginationButtons" :key="button.text" :disabled="button.disabled || button.text === '...'" @click="goToPage(button.page)" :class="{ 'active': button.active, 'disabled': button.disabled }" class="btn btn-outline-primary">
        <span v-if="button.text === '◄'" class="bi bi-chevron-left"></span>
        <span v-else-if="button.text === '...'">{{ button.text }}</span>
        <span v-else-if="button.text === '►'" class="bi bi-chevron-right"></span>
        <span v-else>{{ button.text }}</span>
      </button>
    </div>
  </div>
</template>

<script setup>
import { defineProps, ref, watch, onMounted, onUnmounted } from 'vue';

const props = defineProps({
  currentPage: Number,
  totalPages: Number,
  onPageChange: Function
});

const paginationButtons = ref([]);
const paginationContainer = ref(null);

const goToPage = (page) => {
  props.onPageChange(page);
};

onMounted(() => {
  // Calcular el número de botones visibles cuando se monta el componente
  calculateMaxVisibleButtons();

  // Recalcular el número de botones visibles cuando cambia el tamaño de la ventana
  window.addEventListener('resize', calculateMaxVisibleButtons);
});

onUnmounted(() => {
  // Eliminar el event listener cuando el componente se desmonta para evitar fugas de memoria
  window.removeEventListener('resize', calculateMaxVisibleButtons);
});

function calculateMaxVisibleButtons() {
  if (!paginationContainer.value) return;

  // Obtener el ancho del contenedor de paginación
  const containerWidth = paginationContainer.value.offsetWidth;
  const buttonWidth = 120; // ancho del botón en px
  const maxVisibleButtons = Math.floor(containerWidth / buttonWidth);

  // Actualizar el número máximo de botones visibles
  generatePaginationButtons(maxVisibleButtons);
}

function generatePaginationButtons(maxVisibleButtons) {
  const buttons = [];
  console.log(maxVisibleButtons)
  if (props.totalPages <= 1) {
    paginationButtons.value = [];
    return;
  }

  let startPage = Math.max(1, props.currentPage - Math.floor(maxVisibleButtons / 2));
  let endPage = Math.min(props.totalPages, startPage + maxVisibleButtons - 1);

  // Ajustamos el rango de páginas para asegurarnos de que haya exactamente maxVisibleButtons botones visibles
  if (endPage - startPage < maxVisibleButtons - 1) {
    startPage = Math.max(1, endPage - maxVisibleButtons + 1);
  }

  // Botón para retroceder una página
  if (props.currentPage >= 1) {
    buttons.push({
      text: '◄',
      page: Math.max(1, props.currentPage - 1),
      disabled: props.currentPage <= 1
    });
  }

  // Botón para ir a la primera página (si no está ya en la primera)
  if (startPage > 1) {
    buttons.push({
      text: '1',
      page: 1
    });
    if (startPage > 2) {
      buttons.push({
        text: '...',
        page: startPage - 1
      });
    }
  }

  // Generar los botones de las páginas visibles
  for (let i = startPage; i <= endPage; i++) {
    buttons.push({
      text: i.toString(),
      active: i === props.currentPage,
      page: i
    });
  }

  // Botón para ir a la última página (si no está ya en la última)
  if (endPage < props.totalPages) {
    if (endPage < props.totalPages - 1) {
      buttons.push({
        text: '...',
        page: endPage + 1
      });
    }
    buttons.push({
      text: props.totalPages.toString(),
      page: props.totalPages
    });
  }

  // Botón para avanzar una página (si no está ya en la última)
  if (props.currentPage <= props.totalPages) {
    buttons.push({
      text: '►',
      page: Math.min(props.totalPages, props.currentPage + 1),
      disabled: props.currentPage >= props.totalPages
    });
  }

  paginationButtons.value = buttons;
}

// Reacciona a cambios en los props currentPage y totalPages
watch(() => [props.currentPage, props.totalPages], () => {
  calculateMaxVisibleButtons();
});
</script>

<style scoped>
.pagination-container {
  margin-top: 20px;
}

button {
  margin-right: 5px;
}

button.active {
  font-weight: bold;
}

button.disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>



