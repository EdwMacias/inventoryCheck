<template>
  <div>
    <input type="checkbox" :checked="modalOpen" @click="toggleModal" :id="idModal" class="modal-toggle" />
    <div class="modal">
      <div class="modal-box">
        <div class="">
          <label :for="idModal" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
            @click="closeModalBackdrop">✕</label>
        </div>
        <img :src="imagen" alt="Imagen del artículo" class="w-full h-auto"
          style="max-height: 80vh; object-fit: contain;" />
      </div>
      <label class="modal-backdrop" :for="idModal" @click="closeModalBackdrop">Cerrar</label>
    </div>
  </div>

</template>

<script setup lang="ts">


const emit = defineEmits(["close"]);

const props = defineProps<{
  isModalOpen: boolean
  idModal : string
  imagen: string | undefined
}>();

const modalOpen = ref(false);

watch(() => props.isModalOpen, (newValue) => {
  toggleModal();
});

function toggleModal() {
  modalOpen.value = !modalOpen.value;
}

function closeModalBackdrop() {
  modalOpen.value = false
  return emit("close", false)
}

function preventDoubleClick(event: MouseEvent) {
  if (event.detail > 1) {
    event.preventDefault();
  }
}
</script>

<style scoped>
/* Agrega tus estilos personalizados aquí si es necesario */
</style>
