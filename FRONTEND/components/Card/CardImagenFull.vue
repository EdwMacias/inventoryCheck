<template>
  <input type="checkbox" :checked="isModalOpen" :id="idModal" class="modal-toggle" />
  <div class="modal" :id="identificador">
    <div class="modal-box w-11/12 max-w-7xl p-0 h-full">
      <figure class="h-full w-full">
        <NuxtImg :src="imagen" class="w-full h-full object-cover rounded-lg" alt="Imagen del artículo" />
      </figure>
      <button class="btn btn-neutral btn-circle absolute right-0 top-0 mx-5 mt-5 transition-transform duration-300 hover:scale-105 select-none" @click="closeModal"
        style="z-index: 200;" aria-label="Cerrar modal">
        ✕
      </button>
    </div>
    <!-- Backdrop -->
    <label class="modal-backdrop cursor-pointer " @click="closeModal">
      Cerrar
    </label>
  </div>
</template>

<script setup lang="ts">
import { v4 as uuid } from 'uuid';
import { ref, watch, onMounted, onBeforeUnmount, nextTick } from 'vue';

// Props and emits
const emit = defineEmits(['close']);
const props = defineProps<{
  isModalOpen: boolean;
  idModal: string;
  imagen?: string;
  title?: string;
}>();

// Reactive state
const identificador = ref(uuid());
const modalOpen = ref(props.isModalOpen);

// Watcher to sync modal open state
watch(() => props.isModalOpen, (newValue) => {
  modalOpen.value = newValue;
});

// Function to close the modal
function closeModal() {
  emit('close', false);
}

// Close modal on 'Escape' key press
function handleEscape(event: KeyboardEvent) {
  if (event.key === 'Escape') {
    closeModal();
  }
}

// Lifecycle hooks to add/remove 'Escape' key listener
onMounted(() => {
  window.addEventListener('keydown', handleEscape);
});

onBeforeUnmount(() => {
  window.removeEventListener('keydown', handleEscape);
});
</script>

<style scoped></style>
