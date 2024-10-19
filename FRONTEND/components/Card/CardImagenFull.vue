<template>
  <input type="checkbox" :checked="isModalOpen" :id="idModal" class="modal-toggle" />
  <div class="modal bg-base-200" :id="identificador" >
    <div class="modal-box w-11/12 max-w-7xl bg-base-200" role="dialog">
      <!-- Close Button -->
      <button class="btn btn-neutral btn-circle absolute right-0 top-0 mx-5 mt-5" @click="closeModal" style="z-index: 200;" aria-label="Cerrar modal">
        ✕
      </button>

      <!-- Modal Content -->
      <div class="card">
        <h3 class="card-title">{{ title || 'Imagen' }}</h3>
        <figure>
          <NuxtImg :src="imagen" class="rounded-lg" alt="Imagen del artículo" />
        </figure>
        <!-- <div class="card-body"> -->
        <!-- </div> -->
      </div>
    </div>
    <!-- Backdrop -->
    <label class="modal-backdrop cursor-pointer" @click="closeModal">Cerrar</label>
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
