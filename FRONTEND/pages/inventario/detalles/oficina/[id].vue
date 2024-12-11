<template>
  <div class="breadcrumbs text-lg">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink :to="INDEX_PAGE_INVENTARIO">Inventario</NuxtLink>
      </li>
      <li>
        Detalles
      </li>
      <li>
        Oficina
      </li>
    </ul>
  </div>

  <div class="bg-base-100 rounded-md px-5 p-1">
    <div class="card-actions justify-end">
      <div class="tooltip" data-tip="Descargar PDF">
        <button @click="exportToPDF" class="btn btn-neutral btn-md rounded-full">
          <i class="bi bi-filetype-pdf"></i>
        </button>
      </div>
    </div>

    <div class="card lg:card-side bg-base-100">
      <figure>
        <div class="w-96 skeleton h-56  rounded-md" v-if="!data"></div>
        <img v-else class="w-96 rounded-md" :src="data?.imagen" alt="Movie" />
      </figure>
      <div class="card-body">
        <h2 class="card-title skeleton h-6 rounded w-1/2" v-if="!data"></h2>
        <h2 v-else class="card-title">{{ data.nombre }}</h2>
        <label class="input input-bordered flex items-center gap-2">
          Serial
          <p class="grow h-6 skeleton rounded" v-if="!data?.serial"></p>
          <p class="grow select-text" v-else>{{ data.serial }}</p>
        </label>
        <label class="input input-bordered flex items-center gap-2 mt-2">
          Valor
          <p class="grow h-6 skeleton rounded" v-if="!data?.valor"></p>
          <p class="grow select-text" v-else>{{ data.valor }}</p>
        </label>
        <label class="input input-bordered flex items-center gap-2 mt-2">
          Cantidad
          <p class="grow h-6 skeleton rounded" v-if="!data"></p>
          <p class="grow select-text" v-else>{{ data.cantidad + ' ' + data.unidad.codigo }}</p>
        </label>
      </div>
    </div>
  </div>

</template>

<script lang="ts" setup>
import { itemService } from '~/Domain/Client/Services/Items/item.service';
import type { OficinaDTO } from '~/Domain/DTOs/Items/Oficina/OficinaDTO';
import { INDEX_PAGE_INVENTARIO } from '~/Infrastructure/Paths/Paths';
import jsPDF from 'jspdf';
import 'jspdf-autotable';

const route = useRoute();
const data: Ref<OficinaDTO | undefined> = ref(undefined);
const router = useRouter();


onMounted(async () => {
  try {
    const result = await itemService.details(route.params.id as string);

    if (!result) {
      throw new Error("Datos no disponibles");
    }

    data.value = result;

  } catch (error) {
    return router.push(INDEX_PAGE_INVENTARIO); // Redirigir en caso de error
  }
});

const exportToPDF = async () => {
  const doc = new jsPDF();

  // Add title
  doc.setFontSize(16);
  doc.text(`Información básica`, 20, 20);

  let imageAdded = false;

  // Try to add the image
  if (data.value?.imagen) {
    try {
      const img = await loadImage(data.value.imagen);
      doc.addImage(img, 'JPEG', 20, 40, 60, 60); // Image on the left
      imageAdded = true;
    } catch (error) {
      console.warn('No se pudo cargar la imagen:', error);
      doc.addImage('~/images/defaultimage.webp', 'JPEG', 20, 40, 60, 60);
    }
  }

  // Add the table
  const startX = imageAdded ? 90 : 20; // Adjust position based on image
  const startY = 40;

  const tableData = [
    ['Nombre', data.value?.nombre || 'No disponible'],
    ['Serial', data.value?.serial || 'No disponible'],
    ['Valor', data.value?.valor ? `$${data.value.valor}` : 'No disponible'],
    ['Cantidad', `${data.value?.cantidad || '0'} ${data.value?.unidad?.codigo || ''}`]
  ];

  doc.autoTable({
    startX,
    startY,
    head: [['Campo', 'Valor']],
    body: tableData,
    theme: 'grid',
    styles: {
      fontSize: 10, // Adjust font size
    },
    columnStyles: {
      0: { cellWidth: 40 }, // First column width
      1: { cellWidth: 60 }, // Second column width
    },
  });

  // Save PDF
  doc.save('detalles_item.pdf');
};

// Utility function to load an image
const loadImage = (url: string): Promise<string> => {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.crossOrigin = 'anonymous'; // Handle CORS issues
    img.src = url;
    img.onload = () => {
      const canvas = document.createElement('canvas');
      canvas.width = img.width;
      canvas.height = img.height;
      const ctx = canvas.getContext('2d');
      if (ctx) {
        ctx.drawImage(img, 0, 0);
        resolve(canvas.toDataURL('image/jpeg'));
      } else {
        reject(new Error('Error al procesar la imagen.'));
      }
    };
    img.onerror = () => reject(new Error('No se pudo cargar la imagen.'));
  });
};
</script>


