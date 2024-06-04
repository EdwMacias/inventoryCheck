<template>
  <div>
    <input type="checkbox" :checked="modalOpen" @click="toggleModal" id="my_modal_7" class="modal-toggle" />
    <div class="modal" @click="preventDoubleClick">
      <div class="modal-box w-11/12 max-w-5xl">
        <div class="">
          <label for="my_modal_7" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
            @click="closeModalBackdrop">✕</label>
        </div>
        <img :src="imagen" alt="Imagen del artículo" />
      </div>
      <label class="modal-backdrop" for="my_modal_7" @click="closeModalBackdrop">Cerrar</label>
    </div>
  </div>
</template>

<script setup lang="ts">

const emit = defineEmits(["close"]);

const props = defineProps<{
  isModalOpen: boolean
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
