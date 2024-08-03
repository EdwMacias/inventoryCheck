<template>
  <div>
    <input type="checkbox" :checked="modalOpen" @click="toggleModal" :id="idModal" class="modal-toggle" />
    <div class="modal">
      <div class="modal-box flex flex-col items-center overscroll-none ">
        <div class="modal-action">
          <label :for="idModal" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="closeModalBackdrop">✕</label>
        </div>
        <img :src="imagen" alt="Imagen del artículo" class=""/>
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
.modal-box {
  /* Ajusta el tamaño de la caja de la modal según sea necesario */
  max-height: 80vh; /* Altura máxima */
  max-width: 80vw; /* Anchura máxima */
  /* Agrega más estilos según sea necesario */
}
/* Agrega tus estilos personalizados aquí si es necesario */
</style>
