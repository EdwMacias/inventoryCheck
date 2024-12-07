<template>
  <div id="pdf-content">
    <div class="breadcrumbs text-lg  ">
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
          Equipo
        </li>
      </ul>
    </div>


    <div class="bg-base-100 rounded-md px-5 p-1 ">
      <div class="card-actions justify-end">
        <div class="tooltip" data-tip="Descargar PDF">
          <button @click="generarPDF" class="btn btn-neutral btn-md rounded-full">
            <i class="bi bi-filetype-pdf"></i>
          </button>
        </div>
      </div>
      <div class="card lg:card-side" v-if="!data">
        <figure>
          <div class="w-96 h-56 skeleton rounded-md"></div>
        </figure>
        <div class="card-body select-none">
          <h2 class="card-title skeleton h-6 rounded w-1/3"></h2>
          <label class="input input-bordered flex items-center gap-2 mt-2">
            <span class="w-24 h-4 skeleton rounded"></span>
            <p class="grow h-6 skeleton rounded"></p>
          </label>
          <label class="input input-bordered flex items-center gap-2 mt-2">
            <span class="w-24 h-4 skeleton rounded"></span>
            <p class="grow h-6 skeleton rounded"></p>
          </label>
          <label class="input input-bordered flex items-center gap-2 mt-2">
            <span class="w-24 h-4 skeleton rounded"></span>
            <p class="grow h-6 skeleton rounded"></p>
          </label>
          <label class="input input-bordered flex items-center gap-2 mt-2">
            <span class="w-24 h-4 skeleton rounded"></span>
            <p class="grow h-6 skeleton rounded"></p>
          </label>
          <label class="input input-bordered flex items-center gap-2 mt-2">
            <span class="w-24 h-4 skeleton rounded"></span>
            <p class="grow h-6 skeleton rounded"></p>
          </label>
          <label class="input input-bordered flex items-center gap-2 mt-2">
            <span class="w-24 h-4 skeleton rounded"></span>
            <p class="grow h-6 skeleton rounded"></p>
          </label>
        </div>
      </div>

      <div class="card lg:card-side" v-else>
        <figure class="">
          <img :src="data?.imagen" :alt="data?.name" class="w-96" />
        </figure>
        <div class="card-body select-none">
          <h2 class="card-title select-none">{{ data?.name }}</h2>
          <label class="input input-bordered flex items-center gap-2 ">
            Fabricante
            <p class="grow">{{ data?.fabricante }}</p>
          </label>
          <label class="input input-bordered flex items-center gap-2 mt-2">
            Modelo
            <p class="grow">{{ data?.modelo }}</p>
          </label>
          <label class="input input-bordered flex items-center gap-2 mt-2">
            Marca
            <p class="grow">{{ data?.marca }}</p>
          </label>
          <label class="input input-bordered flex items-center gap-2 mt-2">
            Serial
            <p class="grow">{{ data?.serie_lote }}</p>
          </label>
          <label class="input input-bordered flex items-center gap-2 mt-2 select-none">
            Activo Fijo
            <p class="grow">{{ data?.activo_fijo }}</p>
          </label>
          <label class="input input-bordered flex items-center gap-2 mt-2 select-none">
            Ubicacion
            <p class="grow"> {{ data?.ubicacion }}</p>
          </label>
        </div>
      </div>

      <h2 class="select-none">Especificaciones técnicas</h2>

      <section class="mt-5 select-none" v-if="!data">
        <label class="input input-bordered flex items-center gap-2">
          <span class="w-32 h-4 skeleton rounded"></span>
          <p class="grow h-6 skeleton rounded"></p>
        </label>
        <label class="input input-bordered flex items-center gap-2 mt-2">
          <span class="w-32 h-4 skeleton rounded"></span>
          <p class="grow h-6 skeleton rounded"></p>
        </label>
        <label class="input input-bordered flex items-center gap-2 mt-2">
          <span class="w-32 h-4 skeleton rounded"></span>
          <p class="grow h-6 skeleton rounded"></p>
        </label>
        <label class="input input-bordered flex items-center gap-2 mt-2">
          <span class="w-32 h-4 skeleton rounded"></span>
          <p class="grow h-6 skeleton rounded"></p>
        </label>
        <label class="input input-bordered flex items-center gap-2 mt-2">
          <span class="w-32 h-4 skeleton rounded"></span>
          <p class="grow h-6 skeleton rounded"></p>
        </label>
      </section>

      <section class="mt-5 select-none" v-else>
        <label class="input input-bordered flex items-center gap-2">
          Clase de exactitud
          <p class="grow">{{ data?.clase_exactitud }}</p>
        </label>
        <label class="input input-bordered flex items-center gap-2 mt-2">
          Resolucion
          <p class="grow">{{ data?.resolucion }}</p>
        </label>

        <label class="input input-bordered flex items-center gap-2 mt-2 ">
          Rango de medición
          <p class="grow">{{ data?.rango_medicion }}</p>
        </label>

        <label class="input input-bordered flex items-center gap-2 mt-2">
          Intervalo de medición
          <p class="grow">{{ data?.intervalo_medicion }}</p>
        </label>
        <label class="input input-bordered flex items-center gap-2 mt-2">
          Error maximo permitido
          <p class="grow">{{ data?.error_maximo_permitido }}</p>
        </label>
      </section>
      <h2 class="select-none mt-4">Condiciones</h2>

      <section class="mt-5 select-none" v-if="!data">
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-4 md:gap-4 lg:gap-4 ">
          <div class="select-none">
            <label class="label">
              <span class="block h-4 w-32 skeleton rounded"></span>
            </label>
            <div class="flex items-center">
              <div class="w-4 h-4 skeleton rounded-full"></div>
              <span class="ml-2 h-4 w-20 skeleton rounded"></span>
            </div>
          </div>
          <div class="select-none">
            <label class="label">
              <span class="block h-4 w-32 skeleton rounded"></span>
            </label>
            <div class="flex items-center">
              <div class="w-4 h-4 skeleton rounded-full"></div>
              <span class="ml-2 h-4 w-20 skeleton rounded"></span>
            </div>
          </div>
          <div class="select-none">
            <label class="label">
              <span class="block h-4 w-32 skeleton rounded"></span>
            </label>
            <div class="flex items-center">
              <div class="w-4 h-4 skeleton rounded-full"></div>
              <span class="ml-2 h-4 w-20 skeleton rounded"></span>
            </div>
          </div>
          <div class="select-none">
            <label class="label">
              <span class="block h-4 w-32 skeleton rounded"></span>
            </label>
            <div class="flex items-center">
              <div class="w-4 h-4 skeleton rounded-full"></div>
              <span class="ml-2 h-4 w-20 skeleton rounded"></span>
            </div>
          </div>
          <div class="select-none">
            <label class="label">
              <span class="block h-4 w-32 skeleton rounded"></span>
            </label>
            <div class="flex items-center">
              <div class="w-4 h-4 skeleton rounded-full"></div>
              <span class="ml-2 h-4 w-20 skeleton rounded"></span>
            </div>
          </div>
          <div class="select-none">
            <label class="label">
              <span class="block h-4 w-32 skeleton rounded"></span>
            </label>
            <div class="flex items-center">
              <div class="w-4 h-4 skeleton rounded-full"></div>
              <span class="ml-2 h-4 w-20 skeleton rounded"></span>
            </div>
          </div>
        </div>
      </section>

      <section class="mt-5 select-none" v-else>
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-4 md:gap-4 lg:gap-4 ">
          <div>
            <label class="label">
              <span class="block text-sm">Condición Eléctrica </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_electrica" class="checkbox checkbox-sm"
                :checked="data?.cond_electrica == 1" disabled />
              <label for="cond_electrica" class="ml-2">{{ data?.cond_electrica == 1 ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm ">Condición Mecánica</span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_mecanica" :checked="data?.cond_mecanica == 1" class="checkbox checkbox-sm"
                disabled />
              <label for="cond_mecanica" class="ml-2">
                {{ data?.cond_mecanica == 1 ? 'Aplicado' :
                  'No Aplicado' }}
              </label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm">Condición de Seguridad </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_seguridad" :checked="data?.cond_seguridad == 1"
                class="checkbox checkbox-sm" disabled />
              <label for="cond_seguridad" class="ml-2"> {{ data?.cond_seguridad == 1 ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm">Condiciones Ambientales </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_ambientales" :checked="data?.cond_ambientales == 1"
                class="checkbox checkbox-sm" disabled />
              <label for="cond_ambientales" class="ml-2"> {{ data?.cond_ambientales == 1 ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm">Condiciones de Transporte </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_transporte" :checked="data?.cond_transporte == 1"
                class="checkbox checkbox-sm" disabled />
              <label for="cond_transporte" class="ml-2"> {{ data?.cond_transporte == 1 ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm">Otras Condiciones </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_otras" disabled :checked="data?.cond_otras == 1"
                class="checkbox checkbox-sm" />
              <label for="cond_otras" class="ml-2"> {{ data?.cond_otras == 1 ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
        </div>
      </section>

      <h2 class="select-none mt-5">Proovedores</h2>
      <section class="mt-5 select-none" v-if="!data">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mt-2">
          <div>
            <h3 class="">Proovedor del equipo</h3>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-24 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-24 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-24 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-24 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>

          </div>

          <div>
            <h3 class="">Proovedor de Calibración</h3>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-24 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-24 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-24 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-24 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>
          </div>
        </div>
      </section>

      <section class="mt-5 select-none" v-else>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mt-2">
          <div>
            <h3 class="">Proovedor del equipo</h3>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Nombre
              <p class="grow">{{ data?.proveedor }}</p>
            </label>
            <label class="input input-bordered flex items-center gap-2  mt-2">
              Contacto
              <p class="grow">{{ data?.contacto_proveedor }}</p>
            </label>
            <label class="input input-bordered flex items-center gap-2  mt-2">
              Telefono
              <p class="grow">{{ data?.telefono_proveedor }}</p>
            </label>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Correo
              <p class="grow">{{ data?.email_proveedor }}</p>
            </label>

          </div>

          <div>
            <h3 class="">Proovedor de Calibración</h3>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Nombre
              <p class="grow">{{ data?.proveedor_calibracion }}</p>
            </label>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Contacto
              <p class="grow">{{ data?.contacto_calibracion }}</p>
            </label>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Telefono
              <p class="grow">{{ data?.telefono_calibracion }}</p>
            </label>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Correo
              <p class="grow">{{ data?.email_calibracion }}</p>
            </label>
          </div>
        </div>
      </section>

      <h2 class="mt-5">Componentes</h2>

      <section class="mt-5 select-none" v-if="!data">
        <div class="overflow-x-auto ">
          <table class="table table-zebra">
            <!-- head -->
            <thead>
              <tr>
                <th></th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Serial</th>
                <th>Cuidados</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Unidad</th>
                <th>Tipo</th>
              </tr>
            </thead>
            <tbody>
              <!-- Esqueleto de filas -->
              <tr v-for="index in 5" :key="index">
                <th>
                  <div class="w-4 h-4 skeleton rounded"></div>
                </th>
                <td>
                  <div class="w-24 h-4 skeleton rounded"></div>
                </td>
                <td>
                  <div class="w-16 h-4 skeleton rounded"></div>
                </td>
                <td>
                  <div class="w-20 h-4 skeleton rounded"></div>
                </td>
                <td>
                  <div class="w-32 h-4 skeleton rounded"></div>
                </td>
                <td>
                  <div class="w-20 h-4 skeleton rounded"></div>
                </td>
                <td>
                  <div class="w-24 h-4 skeleton rounded"></div>
                </td>
                <td>
                  <div class="w-16 h-4 skeleton rounded"></div>
                </td>
                <td>
                  <div class="w-16 h-4 skeleton rounded"></div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <section class="mt-5 select-none" v-else>
        <div class="overflow-x-auto">
          <table class="table table-zebra">
            <!-- head -->
            <thead>
              <tr>
                <th></th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Serial</th>
                <th>Cuidados</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Unidad</th>
                <th>Tipo</th>
              </tr>
            </thead>
            <tbody>
              <!-- row 1 -->
              <tr v-for="(componente, index) in data?.componentes" class="hover cursor-pointer">
                <th>{{ index + 1 }}</th>
                <td>{{ componente.nombre }}</td>
                <td>{{ componente.cantidad }}</td>
                <td>{{ componente.serial }}</td>
                <td>{{ componente.cuidados }}</td>
                <td>{{ componente.modelo }}</td>
                <td>{{ componente.marca }}</td>
                <td>{{ componente.unidad }}</td>
                <td>{{ componente.tipo }}</td>
              </tr>

            </tbody>
          </table>
        </div>

      </section>

      <h2 class="select-none mt-5">Calibración y Verificación</h2>
      <section class="mt-5 select-none " v-if="!data">
        <ul>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-40 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>
          </li>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-40 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>
          </li>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-40 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>
          </li>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-40 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>
          </li>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              <span class="w-40 h-4 skeleton rounded"></span>
              <p class="grow h-6 skeleton rounded"></p>
            </label>
          </li>
        </ul>
      </section>
      <section class="mt-5 select-none" v-else>
        <ul>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Periocidad de Calibracion
              <p class="grow">{{ data?.periodicidad_calibracion }}</p>
            </label>
          </li>
          <li>

            <label class="input input-bordered flex items-center gap-2 mt-2">
              Periodicidad de Verificación
              <p class="grow">{{ data?.periodicidad_verificacion }}</p>
            </label>
          </li>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Periodicidad de Verificación
              <p class="grow">{{ data?.fecha_calibracion_actual }}</p>
            </label>
          </li>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Próxima Calibración
              <p class="grow">{{ data?.fecha_proxima_calibracion }}</p>
            </label>
          </li>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Máxima Incertidumbre de Calibración
              <p class="grow">{{ data?.maxima_incertidumbre_calibracion }}</p>
            </label>
          </li>
        </ul>
      </section>
    </div>

  </div>
</template>

<script lang="ts" setup>
import { jsPDF } from "jspdf";
import { EquipoService } from '~/Domain/Client/Services/Items/equipo.service';
import { INDEX_PAGE_INVENTARIO } from '~/Infrastructure/Paths/Paths';
const route = useRoute();

const { data, error } = await useAsyncData(() =>
  EquipoService.details(route.params.id as string), {
  server: false
});

const convertirImagenBase64 = async (url: string) => {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.crossOrigin = "Anonymous"; // Permitir imágenes externas
    img.src = url;
    img.onload = () => {
      const canvas = document.createElement("canvas");
      canvas.width = img.width;
      canvas.height = img.height;
      const ctx = canvas.getContext("2d");
      ctx?.drawImage(img, 0, 0);
      const dataURL = canvas.toDataURL("image/png");
      resolve(dataURL);
    };
    img.onerror = (error) => reject(error);
  });
};

const generarPDF = async () => {
  const pdf = new jsPDF();
  // Convertir imagen a Base64
  let datos = data.value;
  if (!datos) return;
  try {
    const imgData = await convertirImagenBase64(datos.imagen);

    // Agregar imagen al PDF
    // pdf.addImage(imgData, "PNG", 10, 20, 50, 50);
  } catch (error) {
    console.error("Error al convertir la imagen:", error);
  }
  // Título
  pdf.setFontSize(16);
  pdf.text("Detalles del Equipo", 70, 30);

  // Información General
  pdf.setFontSize(12);
  pdf.text(`Fabricante: ${datos.fabricante}`, 70, 40);
  pdf.text(`Modelo: ${datos.modelo}`, 70, 50);
  pdf.text(`Marca: ${datos.marca}`, 70, 60);
  pdf.text(`Serial: ${datos.serie_lote}`, 70, 70);
  pdf.text(`Activo Fijo: ${datos.activo_fijo}`, 70, 80);
  pdf.text(`Ubicación: ${datos.ubicacion}`, 70, 90);

  // Especificaciones Técnicas
  pdf.text("Especificaciones Técnicas:", 10, 110);
  pdf.text(`Clase de Exactitud: ${datos.clase_exactitud}`, 10, 120);
  pdf.text(`Resolución: ${datos.resolucion}`, 10, 130);
  pdf.text(`Rango de Medición: ${datos.rango_medicion}`, 10, 140);
  pdf.text(`Intervalo de Medición: ${datos.intervalo_medicion}`, 10, 150);
  pdf.text(`Error Máximo Permitido: ${datos.error_maximo_permitido}`, 10, 160);

  // Condiciones
  pdf.text("Condiciones:", 10, 180);
  pdf.text(`Condición Eléctrica: ${datos.cond_electrica === 1 ? "Aplicado" : "No Aplicado"}`, 10, 190);
  pdf.text(`Condición Mecánica: ${datos.cond_mecanica === 1 ? "Aplicado" : "No Aplicado"}`, 10, 200);

  // Proveedores
  pdf.text("Proveedores:", 10, 220);
  pdf.text(`Proveedor del Equipo: ${datos.proveedor}`, 10, 230);
  pdf.text(`Contacto: ${datos.contacto_proveedor}`, 10, 240);
  pdf.text(`Teléfono: ${datos.telefono_proveedor}`, 10, 250);

  // Guardar PDF
  pdf.save("detalles-equipo.pdf");
};

</script>

<style></style>