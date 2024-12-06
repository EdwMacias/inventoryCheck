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
            <button  @click="generarPDF" class="btn btn-neutral btn-md rounded-full">
              <i class="bi bi-filetype-pdf"></i>
            </button>
          </div>
      </div>
      <h2 class="card-title select-none">{{ data.name }}</h2>
      <div class="grid lg:grid-cols-2 md:grid-cols-1 gap-2">
        <section class="card-body">
          <figure class="">
            <img :src="data.imagen" :alt="data.name" class=" " />
          </figure>

        </section>
        <section>
          <!-- <div class="card-body"> -->
          <ul class="list-disc">
            <li><label class="input input-bordered flex items-center gap-2 ">
                Fabricante
                <input disabled type="text" class="grow w-full" v-model="data.fabricante" placeholder="Daisy" />
              </label>
            </li>
            <li><label class="input input-bordered flex items-center gap-2 mt-2">
                Modelo
                <input disabled type="text" class="grow " v-model="data.modelo" placeholder="Daisy" />
              </label>
            </li>
            <li><label class="input input-bordered flex items-center gap-2 mt-2">
                Marca
                <input disabled type="text" class="grow " v-model="data.marca" placeholder="Daisy" />
              </label>
            </li>
            <li><label class="input input-bordered flex items-center gap-2 mt-2">
                Serial
                <input disabled type="text" class="grow " v-model="data.serie_lote" placeholder="Daisy" />
              </label>
            </li>
            <li><label class="input input-bordered flex items-center gap-2 mt-2">
                Activo Fijo
                <input disabled type="text" class="grow " v-model="data.activo_fijo" placeholder="Daisy" />
              </label>
            </li>
            <li><label class="input input-bordered flex items-center gap-2 mt-2">
                Ubicacion
                <input disabled type="text" class="grow " v-model="data.ubicacion" placeholder="Daisy" />
              </label>
            </li>
          </ul>
          <!-- </div> -->
        </section>
      </div>

      <section class="mt-5">
        <h2 class="select-none">Especificaciones técnicas</h2>
        <label class="input input-bordered flex items-center gap-2">
          Clase de exactitud
          <input type="text" class="grow" v-model="data.clase_exactitud" placeholder="Daisy" disabled />
        </label>
        <label class="input input-bordered flex items-center gap-2 mt-2">
          Resolucion
          <input type="text" class="grow" v-model="data.resolucion" placeholder="Daisy" disabled />
        </label>

        <label class="input input-bordered flex items-center gap-2 mt-2 ">
          Rango de medición
          <input type="text" class="grow" v-model="data.rango_medicion" placeholder="Daisy" disabled />
        </label>

        <label class="input input-bordered flex items-center gap-2 mt-2">
          Intervalo de medición
          <input type="text" class="grow" v-model="data.intervalo_medicion" placeholder="Daisy" disabled />
        </label>
        <label class="input input-bordered flex items-center gap-2 mt-2">
          Error maximo permitido
          <input type="text" class="grow" v-model="data.error_maximo_permitido" placeholder="Daisy" disabled />
        </label>
      </section>
      <section class="mt-5">
        <h2 class="select-none">Condiciones</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-4 md:gap-4 lg:gap-4 ">
          <div>
            <label class="label">
              <span class="block text-sm">Condición Eléctrica </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_electrica" class="checkbox checkbox-sm"
                :checked="data.cond_electrica == 1" disabled />
              <label for="cond_electrica" class="ml-2">{{ data.cond_electrica == 1 ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm ">Condición Mecánica</span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_mecanica" :checked="data.cond_mecanica == 1" class="checkbox checkbox-sm"
                disabled />
              <label for="cond_mecanica" class="ml-2">
                {{ data.cond_mecanica == 1 ? 'Aplicado' :
                  'No Aplicado' }}
              </label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm">Condición de Seguridad </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_seguridad" disabled :checked="data.cond_seguridad == 1"
                class="checkbox checkbox-sm" />
              <label for="cond_seguridad" class="ml-2"> {{ data.cond_seguridad == 1 ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm">Condiciones Ambientales </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_ambientales" disabled :checked="data.cond_ambientales == 1"
                class="checkbox checkbox-sm" />
              <label for="cond_ambientales" class="ml-2"> {{ data.cond_ambientales == 1 ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm">Condiciones de Transporte </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_transporte" disabled :checked="data.cond_transporte == 1"
                class="checkbox checkbox-sm" />
              <label for="cond_transporte" class="ml-2"> {{ data.cond_transporte == 1 ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm">Otras Condiciones </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_otras" disabled :checked="data.cond_otras == 1"
                class="checkbox checkbox-sm" />
              <label for="cond_otras" class="ml-2"> {{ data.cond_otras == 1 ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
        </div>
      </section>

      <section class="mt-5">
        <h2 class="select-none">Proovedores</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 mt-2">
          <div>
            <h3 class="">Proovedor del equipo</h3>
            <ul class="list-disc mx-5">
              <li class="mt-2">
                <label class="input input-bordered flex items-center gap-2">
                  Nombre
                  <input disabled v-model="data.proveedor" type="text" class="grow" placeholder="Daisy" />
                </label>
              </li>
              <li class="mt-2">
                <label class="input input-bordered flex items-center gap-2">
                  Contacto
                  <input disabled v-model="data.contacto_proveedor" type="text" class="grow" placeholder="Daisy" />
                </label>
              </li>
              <li class="mt-2">
                <label class="input input-bordered flex items-center gap-2">
                  Telefono
                  <input disabled v-model="data.telefono_proveedor" type="text" class="grow" placeholder="Daisy" />
                </label>
              </li>
              <li class="mt-2">
                <label class="input input-bordered flex items-center gap-2">
                  Correo
                  <input disabled v-model="data.email_proveedor" type="text" class="grow" placeholder="Daisy" />
                </label>
              </li>
            </ul>
          </div>

          <div>
            <h3 class="">Proovedor de Calibración</h3>
            <ul class="list-disc mx-5">
              <li class="mt-2">
                <label class="input input-bordered flex items-center gap-2">
                  Nombre
                  <input disabled v-model="data.proveedor_calibracion" type="text" class="grow" placeholder="Daisy" />
                </label>
              </li>
              <li class="mt-2">
                <label class="input input-bordered flex items-center gap-2">
                  Contacto
                  <input disabled v-model="data.contacto_calibracion" type="text" class="grow" placeholder="Daisy" />
                </label>
              </li>
              <li class="mt-2">
                <label class="input input-bordered flex items-center gap-2">
                  Telefono
                  <input disabled v-model="data.telefono_calibracion" type="text" class="grow" placeholder="Daisy" />
                </label>
              </li>
              <li class="mt-2">
                <label class="input input-bordered flex items-center gap-2">
                  Correo
                  <input disabled v-model="data.email_calibracion" type="text" class="grow" placeholder="Daisy" />
                </label>
              </li>
            </ul>
          </div>
        </div>
      </section>

      <section class="mt-2">
        <h2>Componentes</h2>

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
              <tr v-for="(componente, index) in data.componentes" class="hover cursor-pointer">
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

      <section class="mt-2">
        <h2>Calibración y Verificación</h2>
        <ul>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Periocidad de Calibracion
              <input disabled v-model="data.periodicidad_calibracion" type="text" class="grow" placeholder="Daisy" />
            </label>
          </li>
          <li>

            <label class="input input-bordered flex items-center gap-2 mt-2">
              Periodicidad de Verificación
              <input disabled v-model="data.periodicidad_verificacion" type="text" class="grow" placeholder="Daisy" />
            </label>
          </li>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Periodicidad de Verificación
              <input disabled v-model="data.fecha_calibracion_actual" type="text" class="grow" placeholder="Daisy" />
            </label>
          </li>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Próxima Calibración
              <input disabled v-model="data.fecha_proxima_calibracion" type="text" class="grow" placeholder="Daisy" />
            </label>
          </li>
          <li>
            <label class="input input-bordered flex items-center gap-2 mt-2">
              Máxima Incertidumbre de Calibración
              <input disabled v-model="data.maxima_incertidumbre_calibracion" type="text" class="grow"
                placeholder="Daisy" />
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
const data = await EquipoService.details(route.params.id as string);
console.log(data);

const convertirImagenBase64 = async (url) => {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.crossOrigin = "Anonymous"; // Permitir imágenes externas
    img.src = url;
    img.onload = () => {
      const canvas = document.createElement("canvas");
      canvas.width = img.width;
      canvas.height = img.height;
      const ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0);
      const dataURL = canvas.toDataURL("image/png");
      resolve(dataURL);
    };
    img.onerror = (error) => reject(error);
  });
};

const generarPDF = async () => {
  const pdf = new jsPDF();
  // Convertir imagen a Base64
  try {
    const imgData = await convertirImagenBase64(data.imagen);

    // Agregar imagen al PDF
    pdf.addImage(imgData, "PNG", 10, 20, 50, 50);
  } catch (error) {
    console.error("Error al convertir la imagen:", error);
  }
  // Título
  pdf.setFontSize(16);
  pdf.text("Detalles del Equipo", 70, 30);

  // Información General
  pdf.setFontSize(12);
  pdf.text(`Fabricante: ${data.fabricante}`, 70, 40);
  pdf.text(`Modelo: ${data.modelo}`, 70, 50);
  pdf.text(`Marca: ${data.marca}`, 70, 60);
  pdf.text(`Serial: ${data.serie_lote}`, 70, 70);
  pdf.text(`Activo Fijo: ${data.activo_fijo}`, 70, 80);
  pdf.text(`Ubicación: ${data.ubicacion}`, 70, 90);

  // Especificaciones Técnicas
  pdf.text("Especificaciones Técnicas:", 10, 110);
  pdf.text(`Clase de Exactitud: ${data.clase_exactitud}`, 10, 120);
  pdf.text(`Resolución: ${data.resolucion}`, 10, 130);
  pdf.text(`Rango de Medición: ${data.rango_medicion}`, 10, 140);
  pdf.text(`Intervalo de Medición: ${data.intervalo_medicion}`, 10, 150);
  pdf.text(`Error Máximo Permitido: ${data.error_maximo_permitido}`, 10, 160);

  // Condiciones
  pdf.text("Condiciones:", 10, 180);
  pdf.text(`Condición Eléctrica: ${data.cond_electrica === 1 ? "Aplicado" : "No Aplicado"}`, 10, 190);
  pdf.text(`Condición Mecánica: ${data.cond_mecanica === 1 ? "Aplicado" : "No Aplicado"}`, 10, 200);

  // Proveedores
  pdf.text("Proveedores:", 10, 220);
  pdf.text(`Proveedor del Equipo: ${data.proveedor}`, 10, 230);
  pdf.text(`Contacto: ${data.contacto_proveedor}`, 10, 240);
  pdf.text(`Teléfono: ${data.telefono_proveedor}`, 10, 250);

  // Guardar PDF
  pdf.save("detalles-equipo.pdf");
};

</script>

<style></style>