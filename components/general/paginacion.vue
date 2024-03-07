<template>
    <div class="pagination-container text-center mt-3 mb-3">
      <button v-for="button in paginationButtons" :key="button.text" :disabled="button.disabled" @click="goToPage(button.page)" :class="{ 'active': button.active, 'disabled': button.disabled }" class="btn btn-outline-primary">
        <span v-if="button.text === '◄'" class="bi bi-chevron-left"></span>
        <span v-else-if="button.text === '►'" class="bi bi-chevron-right"></span>
        <span v-else>{{ button.text }}</span>
      </button>
    </div>
  </template>
  
  <script setup>

// Define los props currentPage y totalPages
const props = defineProps({
  currentPage: Number,
  totalPages: Number,
  onPageChange: Function
});

const paginationButtons = ref([]);

const goToPage = (page) => {
  props.onPageChange(page);
};

generatePaginationButtons();

function generatePaginationButtons() {
  const buttons = [];

  // Valida los valores de currentPage y totalPages
  if (props.currentPage < 1 || props.currentPage > props.totalPages) {
    console.warn('Corrige los valores de currentPage y totalPages');
    paginationButtons.value = [];
    return;
  }

  buttons.push({
    text: '◄',
    disabled: props.currentPage === 1,
    page: props.currentPage - 1
  });

  for (let i = 1; i <= props.totalPages; i++) {
    buttons.push({
      text: i.toString(),
      active: i === props.currentPage,
      page: i
    });
  }

  buttons.push({
    text: '►',
    disabled: props.currentPage === props.totalPages,
    page: props.currentPage + 1
  });

  paginationButtons.value = buttons;
}

// Reacciona a cambios en los props currentPage y totalPages
watch(() => [props.currentPage, props.totalPages], ([currentPage, totalPages]) => {
  generatePaginationButtons(currentPage, totalPages);
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