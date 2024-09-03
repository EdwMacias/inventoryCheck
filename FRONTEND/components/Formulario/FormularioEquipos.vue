<template>

  <VeeForm :validationSchema="formularioEquipoSchema" @submit="onSubmit" v-slot="{ meta, errors }">    
    <div class="grid sm:grid-cols-1 md:grid-cols-2  gap-4 mt-2">
      <div class="card border shadow-lg p-4 ">
        <h2 class="card-title">1. Datos del Equipo y Fabricante</h2>
        <div class="grid grid-cols-1 gap-2">
          <div>
            <label class="label">Nombre equipo</label>
            <VeeField name="name" v-model="formulario.name" placeholder="Frenometro" :class="`input input-sm w-full ${errors.name ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="name" class="text-error" />
          </div>
          <div>
            <label class="label">Fabricante</label>
            <VeeField name="fabricante" v-model="formulario.fabricante" placeholder="Caterpillar" :class="`input input-sm w-full ${errors.fabricante ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="fabricante" class="text-error" />
          </div>
          <div>
            <label class="label">Modelo</label>
            <VeeField name="modelo" v-model="formulario.modelo" placeholder="2013" :class="`input input-sm w-full ${errors.modelo ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="modelo" class="text-error" />
          </div>
          <div>
            <label class="label">Marca</label>
            <VeeField name="marca" v-model="formulario.marca" placeholder="Caterpillar" :class="`input input-sm w-full ${errors.marca ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="marca" class="text-error" />
          </div>
          <div>
            <label class="label">Serial / (serie - lote)</label>
            <VeeField name="serie_lote" v-model="formulario.serie_lote" placeholder="ABC123" :class="`input input-sm w-full ${errors.serie_lote ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="serie_lote" class="text-error" />
          </div>
          <div class="form-control ">
            <label class="label">Activo Fijo</label>
            <VeeField name="activo_fijo" v-model="formulario.activo_fijo" placeholder="Maquinaria y equipo" :class="`input input-sm w-full ${errors.activo_fijo ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="activo_fijo" class="text-error" />
          </div>
          <div class="form-control ">
            <label class="label">Ubicación</label>
            <VeeField name="ubicacion" v-model="formulario.ubicacion" placeholder="Linea 1" :class="`input input-sm w-full ${errors.ubicacion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="ubicacion" class="text-error" />
          </div>
          <div class="form-control ">
            <label class="label">FICHA TECNICA(Ubicación)</label>
            <VeeField name="ficha_tecnica" v-model="formulario.ficha_tecnica" placeholder="Equipo" :class="`input input-sm w-full ${errors.ficha_tecnica ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="ficha_tecnica" class="text-error" />
          </div>
          <div class="form-control ">
            <label class="label">MANUAL DE USO(ubicación)</label>
            <VeeField name="manual" v-model="formulario.manual" placeholder="N.A." :class="`input input-sm w-full ${errors.manual ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="manual" class="text-error" />
          </div>
          <div class="form-control ">
            <label class="label">Garantia</label>
            <VeeField name="garantia" v-model="formulario.garantia" placeholder="12 meses" :class="`input input-sm w-full ${errors.garantia ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="garantia" class="text-error" />
          </div>
          <div class="form-control ">
            <label class="label">Instr. de Operación</label>
            <VeeField name="instruc_operacion" v-model="formulario.instruc_operacion" placeholder="Según el fabricante" :class="`input input-sm w-full ${errors.instruc_operacion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="instruc_operacion" class="text-error" />
          </div>
          <div class="form-control ">
            <label class="label">Periodicidad de Calibración</label>
            <VeeField name="periodicidad_calibracion" v-model="formulario.periodicidad_calibracion" placeholder="ver manual de operaciones" :class="`input input-sm w-full ${errors.periodicidad_calibracion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="periodicidad_calibracion" class="text-error" />
          </div>
          <div class="form-control ">
            <label class="label">Periodicidad de Verificación</label>
            <VeeField name="periodicidad_verificacion" v-model="formulario.periodicidad_verificacion" placeholder="Ver manual de operaciones" :class="`input input-sm w-full ${errors.periodicidad_verificacion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="periodicidad_verificacion" class="text-error" />
          </div>
          <div class="form-control ">
            <label class="label">Nombre Proveedor de venta</label>
            <VeeField name="proveedor" v-model="formulario.proveedor" placeholder="Proveedor" :class="`input input-sm w-full ${errors.proveedor ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="proveedor" class="text-error" />
          </div>
          <div class="form-control ">
            <label class="label">contacto proveedor</label>
            <VeeField name="contacto_proveedor" v-model="formulario.contacto_proveedor" placeholder="+573101234567" :class="`input input-sm w-full ${errors.contacto_proveedor ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="contacto_proveedor" class="text-error" />
          </div>
          <div class="form-control ">
            <label class="label">Email de proveedor</label>
            <VeeField name="email_proveedor" v-model="formulario.email_proveedor" placeholder="test@prueba.com"
              :class="`input input-sm w-full ${errors.email_proveedor ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="email_proveedor" class="text-error" />
          </div>
        </div>
      </div>
      <div class="card border shadow-lg p-4">
        <h2 class="card-title">2. Fotografía del Equipo y Accesorios</h2>
        <div> <!-- Imagen del item -->
          <label class="label">
            <span class="block text-md font-medium leading-6 ">Imagen del item</span>
          </label>
          <input type="file" ref="inputFile" class="file-input file-input-sm file-input-bordered w-full" name="resource"
            @change="handleFileChange" />
          <div class="card card-compact w-full">
            <div class="card-body">
              <figure class="mt-2">
                <img ref="itemPhoto" @click="openModal(true)"
                  src="https://www.shutterstock.com/image-vector/default-image-icon-vector-missing-600nw-2079504220.jpg"
                  alt="Imagen del articulo" class="object-scale-down h-72 w-96 " />
              </figure>
              <CardImagenFull idModal="modal-imagen" :isModalOpen="isModalOpen" :imagen="itemPhoto?.src"
                @close="openModal"></CardImagenFull>
            </div>
          </div>
        </div>
      </div>
      <div class="card border shadow-lg p-4">
        <h2 class="card-title">3. Características Metrológicas del Equipo</h2>
        <div class="form-control mb-2">
          <div>
            <label class="label">Resolución</label>
            <VeeField name="resolucion" v-model="formulario.resolucion" placeholder="ABC123"
              :class="`input input-sm w-full ${errors.resolucion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="resolucion" class="text-error" />
          </div>
          <div>
            <label class="label">Clase de exactitud</label>
            <VeeField name="clase_exactitud" v-model="formulario.clase_exactitud" placeholder="Aplicación"
              :class="`input input-sm w-full ${errors.clase_exactitud ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="clase_exactitud" class="text-error" />
          </div>
          <div>
            <label class="label">Rango(s) de medición</label>
            <VeeField name="rango_medicion" v-model="formulario.rango_medicion" placeholder="Aplicación"
              :class="`input input-sm w-full ${errors.rango_medicion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="rango_medicion" class="text-error" />
          </div>
          <div>
            <label class="label">Intervalo(s) de medición</label>
            <VeeField name="intervalo_medicion" v-model="formulario.intervalo_medicion" placeholder="Aplicación"
              :class="`input input-sm w-full ${errors.intervalo_medicion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="intervalo_medicion" class="text-error" />
          </div>
          <div>
            <label class="label">Error máximo permitido</label>
            <VeeField name="error_maximo_permitido" v-model="formulario.error_maximo_permitido" placeholder="Aplicación"
              :class="`input input-sm w-full ${errors.error_maximo_permitido ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="error_maximo_permitido" class="text-error" />
          </div>
        </div>
      </div>
      <!-- Datos de adquisición del equipo -->
      <div class="card border shadow-lg p-4">
        <h2 class="card-title">4. Datos de Adquisición del Equipo</h2>
        <div class="form-control mb-2">
          <div>
            <label class="label">Fecha de Compra</label>
            <VeeField name="fecha_adquisicion" type="date" v-model="formulario.fecha_adquisicion" placeholder="01/01/2023"
              :class="`input input-sm w-full ${errors.fecha_adquisicion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="fecha_adquisicion" class="text-error" />
          </div>
          <div>
            <label class="label">Valor de compra</label>
            <VeeField name="valor_adquisicion" v-model="formulario.valor_adquisicion" placeholder="0"
              :class="`input input-sm w-full ${errors.valor_adquisicion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="valor_adquisicion" class="text-error" />
            <p class="text-sm text-gray-500 mt-2">*Vista previa del valor: {{ formattedValorAdquisicion}}</p>

          </div>
          <div>
            <label class="label">telefono de contacto</label>
            <VeeField name="telefono_proveedor" v-model="formulario.telefono_proveedor" placeholder="+573101234567"
              :class="`input input-sm w-full ${errors.telefono_proveedor ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="telefono_proveedor" class="text-error" />
          </div>
          <div>
            <label class="label">email de contacto</label>
            <input name="email_proveedor" v-model="formulario.email_proveedor" class="input input-sm w-full" disabled />
          </div>
        </div>
      </div>
      <div class="card border shadow-lg p-4">
        <h2 class="card-title">5. Datos de Calibración del Equipo</h2>
        <div class="form-control mb-2">
          <div>
            <label class="label">Fecha de calibración actual</label>
            <VeeField name="fecha_calibracion_actual" type="date" v-model="formulario.fecha_calibracion_actual"
              :class="`input input-sm w-full ${errors.fecha_calibracion_actual ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="fecha_calibracion_actual" class="text-error" />
          </div>
          <div>
            <label class="label">Fecha próxima a calibrar</label>
            <VeeField name="fecha_proxima_calibracion" type="date" v-model="formulario.fecha_proxima_calibracion"
              :class="`input input-sm w-full ${errors.fecha_proxima_calibracion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="fecha_proxima_calibracion" class="text-error" />
          </div>
          <div>
            <label class="label">Max. incertidumbre/calibración</label>
            <VeeField name="maxima_incertidumbre_calibracion" v-model="formulario.maxima_incertidumbre_calibracion" placeholder="0.1"
              :class="`input input-sm w-full ${errors.maxima_incertidumbre_calibracion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="maxima_incertidumbre_calibracion" class="text-error" />
          </div>
          <div>
            <label class="label">Proveedor de calibración</label>
            <VeeField name="proveedor_calibracion" v-model="formulario.proveedor_calibracion" placeholder="Empresa de Calibración"
              :class="`input input-sm w-full ${errors.proveedor_calibracion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="proveedor_calibracion" class="text-error" />
          </div>
          <div>
            <label class="label">telefono de contacto de calibración</label>
            <VeeField name="contacto_calibracion" v-model="formulario.contacto_calibracion" placeholder=" +573101234567"
              :class="`input input-sm w-full ${errors.contacto_calibracion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="contacto_calibracion" class="text-error" />
          </div>
          <div></div>
          <label class="label">email de contacto de calibración</label>
          <VeeField name="email_calibracion" v-model="formulario.email_calibracion" placeholder=" example@gmail.com"
            :class="`input input-sm w-full ${errors.email_calibracion ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="email_calibracion" class="text-error" />
        </div>
      </div>
      <div class="card border shadow-lg p-4">
        <h2 class="card-title">6. Control de Equipos</h2>
        <div class="form-control mb-2">
          <div>
            <label class="label">Frecuencia de verificación</label>
            <VeeField name="frecuencia_verificacion" v-model="formulario.frecuencia_verificacion" placeholder="tiempo en meses"
              :class="`input input-sm w-full ${errors.frecuencia_verificacion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="frecuencia_verificacion" class="text-error" />
          </div>
          <div>
            <label class="label">Procedimiento de verificación</label>
            <VeeField name="procedimiento_verificacion" v-model="formulario.procedimiento_verificacion" placeholder="MANTENIMIENTO"
              :class="`input input-sm w-full ${errors.procedimiento_verificacion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="procedimiento_verificacion" class="text-error" />
          </div>
          <div>
            <label class="label">Frecuencia de calibración</label>
            <VeeField name="frecuencia_calibracion" v-model="formulario.frecuencia_calibracion" placeholder="Tiempo en meses"
              :class="`input input-sm w-full ${errors.frecuencia_calibracion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="frecuencia_calibracion" class="text-error" />
          </div>
        </div>
      </div>
      <div class="card border shadow-lg p-4">
        <h2 class="card-title">7. Condiciones de uso</h2>
        <div class="form-control mb-2">
          <div>
            <label class="label">
              <span class="block text-sm">Condición Eléctrica <b>(por defecto: NO APLICA)</b></span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_electrica" v-model="formulario.cond_electrica" class="checkbox checkbox-sm" />
              <label for="cond_electrica" class="ml-2">Aplicado</label>
            </div>
          </div>
          <div>
            <label class="label">
              <span class="block text-sm ">Condición Mecánica <b>(por defecto: NO APLICA)</b></span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_mecanica" v-model="formulario.cond_mecanica" class="checkbox checkbox-sm" />
              <label for="cond_mecanica" class="ml-2">Aplicado</label>
            </div>
          </div>
          <div>
            <label class="label">
              <span class="block text-sm">Condición de Seguridad <b>(por defecto: NO APLICA)</b></span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_seguridad" v-model="formulario.cond_seguridad" class="checkbox checkbox-sm" />
              <label for="cond_seguridad" class="ml-2">Aplicado</label>
            </div>
          </div>
          <div>
            <label class="label">
              <span class="block text-sm">Condiciones Ambientales <b>(por defecto: NO APLICA)</b></span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_ambientales" v-model="formulario.cond_ambientales" class="checkbox checkbox-sm" />
              <label for="cond_ambientales" class="ml-2">Aplicado</label>
            </div>
          </div>
          <div>
            <label class="label">
              <span class="block text-sm">Condiciones de Transporte <b>(por defecto: NO APLICA)</b></span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_transporte" v-model="formulario.cond_transporte" class="checkbox checkbox-sm" />
              <label for="cond_transporte" class="ml-2">Aplicado</label>
            </div>
          </div>
          <div>
            <label class="label">
              <span class="block text-sm">Otras Condiciones <b>(por defecto: NO APLICA)</b></span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_otras" v-model="formulario.cond_otras" class="checkbox checkbox-sm" />
              <label for="cond_otras" class="ml-2">Aplicado</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex gap-2 grid grid-cols-2 mt-2">
     <ButtonOptions :to="props.link" @save="handleSave" @cancel="handleCancel" />
    </div>

  </VeeForm>
</template>


<script lang="ts" setup>
import type { EquipoEntity } from '~/Domain/Models/Entities/equipo';
import { useRouter} from 'vue-router';

const props = defineProps({
  link: {
    type: String,
    default: '/inventario/items'
  }
})

const handleSave = () => {
  emits("callback", formulario.value);
}
const handleCancel = () => {
  router.push(props.link);
}

import swal from 'sweetalert2';
const router = useRouter();
const emits = defineEmits(["callback"]);
const inputFile = ref();
const { setImagen } = useImagen();
const itemPhoto = ref<HTMLImageElement | null>(null);
const isModalOpen = ref(false);
const barcodeValue = ref<string | null>(null);

function openModal(valor: boolean) {
  isModalOpen.value = valor;
}

const formatCurrency = (value: number): string => {
  if (!value || isNaN(value)) {
    return '$0';
  }
  return value.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
}

const formattedValorAdquisicion = computed(() => {
  return formatCurrency(parseFloat(formulario.value.valor_adquisicion.toString().replace(/,/g, '')));
});


yup.setLocale({
  mixed: {
    default: "*llenar campo"
  },
  number: {
    moreThan: "Seleccione una opcion valida"
  },
});

const formulario: Ref<EquipoEntity> = ref({
  name: '',
  fabricante: '',
  modelo: '',
  resource: null,
  marca: '',
  serie_lote: '',
  activo_fijo: '',
  ubicacion: '',
  ficha_tecnica: '',
  manual: '',
  garantia: '',
  instruc_operacion: '',
  periodicidad_calibracion: '',
  periodicidad_verificacion: '',
  proveedor: '',
  contacto_proveedor: '',
  telefono_proveedor: '',
  email_proveedor: '',
  resolucion: '',
  clase_exactitud: '',
  rango_medicion: '',
  intervalo_medicion: '',
  error_maximo_permitido: '',
  fecha_adquisicion: '',
  valor_adquisicion: 0,
  numero_factura: '',
  frecuencia_verificacion: '',
  procedimiento_verificacion: '',
  frecuencia_calibracion: '',
  fecha_calibracion_actual: '',
  fecha_proxima_calibracion: '',
  maxima_incertidumbre_calibracion: '',
  proveedor_calibracion: '',
  contacto_calibracion: '',
  email_calibracion: '',
  telefono_calibracion: '',
  cond_electrica: false,
  cond_mecanica: false,
  cond_seguridad: false,
  cond_ambientales: false,
  cond_transporte: false,
  cond_otras: false
});

const formularioEquipoSchema = yup.object({
  name: yup.string().required('*Campo requerido'),
  fabricante: yup.string().required('*Campo requerido'),
  modelo: yup.string().required('*Campo requerido'),
  marca: yup.string().required('*Campo requerido'),
  serie_lote: yup.string().required('*Campo requerido'),
  activo_fijo: yup.string().required('*Campo requerido'),
  ubicacion: yup.string().required('*Campo requerido'),
  ficha_tecnica: yup.string().required('*Campo requerido'),
  manual: yup.string().required('*Campo requerido'),
  garantia: yup.string().required('*Campo requerido'),
  instruc_operacion: yup.string().required('*Campo requerido'),
  periodicidad_calibracion: yup.string().required('*Campo requerido'),
  periodicidad_verificacion: yup.string().required('*Campo requerido'),
  proveedor: yup.string().required('*Campo requerido'),
  contacto_proveedor: yup.string().required('*Campo requerido'),
  telefono_proveedor: yup.string().required('*Campo requerido'),
  email_proveedor: yup.string().required('*Campo requerido').email(),
  resolucion: yup.string().nullable(),
  clase_exactitud: yup.string().nullable(),
  rango_medicion: yup.string().nullable(),
  intervalo_medicion: yup.string().nullable(),
  error_maximo_permitido: yup.string().nullable(),
  fecha_adquisicion: yup.date().required('*Campo requerido'),
  valor_adquisicion: yup.number().nullable(),
  numero_factura: yup.string().nullable(),
  frecuencia_verificacion: yup.string().required('*Campo requerido'),
  procedimiento_verificacion: yup.string().required('*Campo requerido'),
  frecuencia_calibracion: yup.string().required('*Campo requerido'),
  fecha_calibracion_actual: yup.date().nullable(),
  fecha_proxima_calibracion: yup.date().nullable(),
  maxima_incertidumbre_calibracion: yup.string().nullable(),
  proveedor_calibracion: yup.string().nullable(),
  contacto_calibracion: yup.string().nullable(),
  email_calibracion: yup.string().nullable().email(),
  telefono_calibracion: yup.string().nullable(),
  // resource: yup.mixed().required('*Campo requerido')
});

const handleFileChange = (event: Event) => {
  const file = (event.target as HTMLInputElement).files?.[0];
  if (file != undefined) {
    formulario.value.resource = file;
    if (itemPhoto.value != undefined) {
      setImagen(file, itemPhoto);
    }
  }
};


const onSubmit = (values: any) => {
  const equipoEntity = values;
  if (formulario.value.resource == null) {
    swal.fire({
      icon: 'error',
      title: "Falta recurso imagen",
      text: "Hubo un error por favor incluya la imagen.",
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      reverseButtons: true
    });
    return router.push('/inventario/items');
  }

  equipoEntity.resource = formulario.value.resource;
  
  const equipoFormulario = { ...equipoEntity, ...formulario.value };
  emits("callback", equipoFormulario);
}

watch(() => formulario.value.serie_lote, (newSerialNumber) => {
  if (!newSerialNumber) {
    barcodeValue.value = null;
    return;
  }
  barcodeValue.value = newSerialNumber;
  return;
});
barcodeValue.value = formulario.value.serie_lote;


</script>