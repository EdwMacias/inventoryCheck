<template>

    <table class="table">
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Item</th>
          <th>Serial</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in items" :key="index">
          <td>
            <img :src="imagenValida[index] ? item.resource : imagenFallback" alt="Item Image" class="w-16 h-16 object-cover" @error="setDefaultImage(index)">
          </td>
          <td>{{ item.name }}</td>
          <td>{{ item.serie_lote }}</td>
          <td>
            <button @click="clickButtonDelete(item.item_id)" class="btn btn-error">Borrar</button>
          </td>
        </tr>
      </tbody>
    </table>
</template>

<script setup lang="ts">
import type { ItemResponse } from '~/Domain/Models/Api/Response/item.response';

const isModalOpen = ref(false);
// const imagen: Ref<HTMLImageElement | null> = ref(null);
const imagenFallback = '/images/defaultimage.webp'; // Imagen por defecto

const emits = defineEmits<{
  (event: "clickDeleteButton", payload: string): void
}>();

function openModal(valor: boolean) {
  isModalOpen.value = valor;
}

const props = defineProps<{
  data:  ItemResponse[], // unidad
  showDeleteButton?: boolean,         // btnDelete
}>();
const items: ItemResponse[] = Object.values(props.data);

const imagenValida = ref<boolean[]>(Array(props.data.length).fill(true));

function setDefaultImage(index: number) {
  imagenValida.value[index] = false; // Cambiar solo para el item correspondiente
}

// function setDefaultImage(event: Event | string) {
//   if (typeof event == "string") {
//     console.log(event);
//     return;
//   }
//   imagenValida.value = false;
// }

const pushRoute = (itemId: string, id: number, category: string) => {
  const router = useRouter();

  localStorage.setItem('item-select', JSON.stringify({
    itemId: itemId,
    identificador: id,
  }))
  if (category == '1') {
    return router.push(`/inventario/items/observaciones/equipo/${itemId}/`)
  } else {
    return router.push(`/inventario/items/observaciones/oficina/${itemId}/`)
  }
}

function clickButtonDelete(itemId: string) {
  return emits("clickDeleteButton", itemId);
}


</script>

<style>

</style>