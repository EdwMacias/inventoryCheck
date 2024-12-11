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
          Equipo
        </li>
        <li>
          Detalles
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
import autoTable from "jspdf-autotable";
import { EquipoService } from '~/Domain/Client/Services/Items/equipo.service';
import type { EquipoDTO } from "~/Domain/DTOs/Items/Equipo/EquipoDTO";
import { INDEX_PAGE_INVENTARIO } from '~/Infrastructure/Paths/Paths';
const route = useRoute();
const router = useRouter();
const data: Ref<EquipoDTO | undefined> = ref();
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
  const pdf = new jsPDF("p", "mm", "letter"); // Formato carta, orientación vertical
  let datos = data.value;
  if (!datos) return;
  try {
    const imgData = await convertirImagenBase64(datos.imagen);
    console.log(imgData);
  } catch (error) {
    console.error("Error al convertir la imagen:", error);
  }
  const styleTable = {
    font: "helvetica", // Cambia la fuente a Helvetica
    fontSize: 10,
    lineColor: [0, 0, 0], // Color de línea negro
    lineWidth: 0.1, 
    };
  
  const tablas = {
    general: [
      ["Fabricante", datos?.fabricante || "-"],
      ["Modelo", datos?.modelo || "-"],
      ["Marca", datos?.marca || "-"],
      ["Serial", datos?.serie_lote || "-"],
      ["Activo Fijo", datos?.activo_fijo || "-"],
      ["Ubicación", datos?.ubicacion || "-"],
      ["Periodicidad Calibración", datos?.periodicidad_calibracion || "-"],
      ["Periodicidad de Verificación", datos?.periodicidad_verificacion || "-"],
      ["Instrucciones de Operación", datos?.instruc_operacion || "-"],
      ["Ficha Técnica", datos?.ficha_tecnica || "-"],
      ["Manual", datos?.manual || "-"],
      ["Proveedor del Equipo", datos?.proveedor || "-"],
      ["Contacto Proveedor", datos?.contacto_proveedor || "-"],
      ["Teléfono Proveedor", datos?.telefono_proveedor || "-"],
      ["Correo Proveedor", datos?.email_proveedor || "-"],
      ["Garantía", datos?.garantia || "-"],

    ],
    metrologia: [
      ["Clase de Exactitud", datos?.clase_exactitud || "-"],
      ["Resolución", datos?.resolucion || "-"],
      ["Rango de Medición", datos?.rango_medicion || "-"],
      ["Intervalo de Medición", datos?.intervalo_medicion || "-"],
      ["Error Máximo Permitido", datos?.error_maximo_permitido || "-"],
    ],
    condiciones: [
      ["Condición Eléctrica", datos?.cond_electrica === 1 ? "Aplicado" : "No Aplicado"],
      ["Condición Mecánica", datos?.cond_mecanica === 1 ? "Aplicado" : "No Aplicado"],
      ["Condición de Seguridad", datos?.cond_seguridad === 1 ? "Aplicado" : "No Aplicado"],
      ["Condiciones Ambientales", datos?.cond_ambientales === 1 ? "Aplicado" : "No Aplicado"],
      ["Condiciones de Transporte", datos?.cond_transporte === 1 ? "Aplicado" : "No Aplicado"],
      ["Otras Condiciones", datos?.cond_otras === 1 ? "Aplicado" : "No Aplicado"],
    ],
    proveedores: [

    ],
    calibracion: [
      ["Proveedor de Calibración", datos?.proveedor_calibracion || "-"],
      ["Contacto Calibración", datos?.contacto_calibracion || "-"],
      ["Correo Calibración", datos?.email_calibracion || "-"],
      ["Fecha de Calibración Actual", datos?.fecha_calibracion_actual || "-"],
      ["Fecha Próxima Calibración", datos?.fecha_proxima_calibracion || "-"],
      ["Máxima Incertidumbre de Calibración", datos?.maxima_incertidumbre_calibracion || "-"],
      ["Frecuencia de Verificación", datos?.frecuencia_verificacion || "-"],
    ],
    adquisicion: [
      ["Fecha de Adquisición", datos?.fecha_adquisicion || "-"],
      ["Número de Factura", datos?.numero_factura || "-"],
      ["Valor de Adquisición", datos?.valor_adquisicion || "-"],
    ],
    documentacion: [
      ["Procedimiento de Verificación", datos?.procedimiento_verificacion || "-"],
    ],
  };
  // Título
  
  pdf.setFontSize(25);
  pdf.text(datos?.name, 10, 12);

  // Información General (Tabla)
  // autoTable(pdf, {
  //   startY: 15,
  //   head: [["Foto", ""]],
  //   body: ["Condición Eléctrica", datos.cond_electrica === 1 ? "Aplicado" : "No Aplicado"],,
  //   theme: "striped",
  //   styles: { fontSize: 10 },
  //   columnStyles: {
  //     0: { cellWidth: 40 }, // Ajusta el ancho de la columna para los campos
  //     1: { cellWidth: 40 },
  //   },
  // });
  autoTable(pdf, {
    startY: 15,
    margin: { left: 8 },
    head: [["Datos del equipo y fabricante", ""]],
    body: tablas.general,
    styles: styleTable,
    columnStyles: {
      0: { cellWidth: 50 }, // Ajusta el ancho de la columna para los campos
      1: { cellWidth: 50 },
    },
  });
  

  // Características metrológicas del equipo
  autoTable(pdf, {
    startY: 102,
    head: [["Características metrológicas del equipo", ""]],
    body: tablas.metrologia,
    theme: "striped",
    styles: styleTable,
    columnStyles: {
      0: { cellWidth: 45 }, // Ajusta el ancho de la columna para los campos
      1: { cellWidth: 40 },
    },
    margin: { left: 115 },
  });
  // Condiciones (Tabla)
  autoTable(pdf, {
    startY: 160,
    head: [["Condición", "Estado"]],
    body: [
      ["Condición Eléctrica", datos.cond_electrica === 1 ? "Aplicado" : "No Aplicado"],
      ["Condición Mecánica", datos.cond_mecanica === 1 ? "Aplicado" : "No Aplicado"],
      ["Condición de Seguridad", datos.cond_seguridad === 1 ? "Aplicado" : "No Aplicado"],
      ["Condiciones Ambientales", datos.cond_ambientales === 1 ? "Aplicado" : "No Aplicado"],
      ["Condiciones de Transporte", datos.cond_transporte === 1 ? "Aplicado" : "No Aplicado"],
      ["Otras Condiciones", datos.cond_otras === 1 ? "Aplicado" : "No Aplicado"],
    ],
    theme: "striped",
    columnStyles: {
      0: { cellWidth: 50 }, // Ajusta el ancho de la columna para los campos
      1: { cellWidth: 50 },
    },
    margin: { left: 8 },
    styles: styleTable,
  });

  // Proveedores (Tabla)
  autoTable(pdf, {
    startY: pdf.lastAutoTable.finalY -53,
    head: [["Campo", "Valor"]],
    body: [
      ["Proveedor del Equipo", datos.proveedor || "-"],
      ["Contacto", datos.contacto_proveedor || "-"],
      ["Teléfono", datos.telefono_proveedor || "-"],
      ["Correo", datos.email_proveedor || "-"],
    ],
    theme: "striped",
    styles: styleTable,
    margin: { left: 8 },
    columnStyles: {
      0: { cellWidth: 45 }, // Ajusta el ancho de la columna para los campos
      1: { cellWidth: 40 },
    },
    margin: { left: 115 },
  });

  // Componentes (Tabla)
  if (datos.componentes && datos.componentes.length > 0) {
    autoTable(pdf, {
      startY: pdf.lastAutoTable.finalY + 10,
      head: [["#", "Nombre", "Cantidad", "Serial", "Cuidados", "Modelo", "Marca", "Unidad", "Tipo"]],
      body: datos.componentes.map((comp: any, index: number) => [
        index + 1,
        comp.nombre || "-",
        comp.cantidad || "-",
        comp.serial || "-",
        comp.cuidados || "-",
        comp.modelo || "-",
        comp.marca || "-",
        comp.unidad || "-",
        comp.tipo || "-",
      ]),
      theme: "striped",
      styles: styleTable,
    });
  };
  pdf.save("detalles-equipo.pdf");

};
onMounted(async () => {
  try {
    const result = await EquipoService.details(route.params.id as string);
    if (!result) {
      throw new Error("Datos no disponibles");
    }
    data.value = result;
  } catch (error) {
    return router.push(INDEX_PAGE_INVENTARIO); // Redirigir en caso de error
  }
});
</script>