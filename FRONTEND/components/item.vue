<template>
  <div class="card bg-base-100 shadow-xl border-xl ">
    <figure>
      <img ref="imagen" :src="image" :alt="descripcion" @click="openModal(true)" @error="imageLoadError" />
    </figure>
    <div class="card-body">
      <h2 class="card-title" style="word-wrap: break-word;">{{ nombre_item }}</h2>
      <p style="word-wrap: break-word;">{{descripcion}}</p>
      <div class="card-actions justify-end flex gap-2 grid grid-cols-2 ">
        <button class="btn btn-accent" @click="showModal">Codigo</button>
        <dialog ref="myModal" class="modal">
          <div class="modal-box">
            <div class="modal-action">
              <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="openModal(false)">x</button>
                <VueBarcode :value="`${serial_number}`" format="EAN13" tag="svg" :options="{ height: '50', }" />
              </form>
            </div>
          </div>
        </dialog>
        <Observacion />
      </div>
    </div>
    <CardImagenFull :idModal="itemId" :imagen="imagen?.src" :isModalOpen="isModalOpen" @close="openModal" />
  </div>
</template>

<script setup lang="ts">

const isModalOpen = ref(false);
const imagen: Ref<HTMLImageElement | null> = ref(null);
function openModal(valor: boolean) {
  isModalOpen.value = valor;
}
const myModal = ref(null);

const showModal = () => {
  if (myModal.value) {
    myModal.value.showModal();
  }
};

const props = defineProps<{
  nombre_item: string,
  image: string,
  descripcion: string,
  serial_number: string,
  itemId: string
}>();

const agregarObservacion = () => {
  console.log('Observacion agregada');
};

function imageLoadError(event: Event) {
  if (imagen.value) {
    imagen.value.src = "https://www.shutterstock.com/image-vector/default-image-icon-vector-missing-600nw-2079504220.jpg";
  }
}
</script>

<style scoped>
.preview {
  object-fit: cover;
  border-radius: 2ch;
  width: 100%;
}
</style>