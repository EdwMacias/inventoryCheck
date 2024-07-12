<template>
  <VeeForm :validationSchema="formularioSchema" @submit="onSubmit" v-slot="{ meta, errors }" class="">
    <div class="m-2">
      <div class="grid :grid-cols-2 xl:grid-cols-3 gap-4">
        <div class="card border shadow-lg p-4 ">
          <h2 class="card-title">1. Datos del Equipo y Fabricante</h2>
          <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="label">Nombre equipo</label>
              <VeeField name="name" v-model="formulario.name" :class="`input w-full ${errors.name ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="name" class="text-error" />
            </div>
            <div>
              <label class="label">Fabricante</label>
              <VeeField name="fabricante" v-model="formulario.fabricante" :class="`input w-full ${errors.fabricante ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="fabricante" class="text-error" />
            </div>
            <div>
              <label class="label">Modelo</label>
              <VeeField name="modelo" v-model="formulario.modelo" :class="`input w-full ${errors.modelo ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="modelo" class="text-error" />
            </div>
            <div>
              <label class="label">Marca</label>
              <VeeField name="marca" v-model="formulario.marca" :class="`input w-full ${errors.marca ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="marca" class="text-error" />
            </div>
            <div>
              <label class="label">Serial / (serie - lote)</label>
              <VeeField name="serial_number" v-model="formulario.serial_number" :class="`input w-full ${errors.serial_number ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="serial_number" class="text-error" />
            </div>
            <div class="form-control ">
                <label class="label">Activo Fijo</label>
                <VeeField name="activo_fijo" v-model="formulario.activo_fijo" :class="`input w-full ${errors.activo_fijo ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="activo_fijo" class="text-error" />
            </div>
            <div class="form-control ">
                <label class="label">Ubicación</label>
                <VeeField name="ubicacion" v-model="formulario.ubicacion" :class="`input w-full ${errors.ubicacion ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="ubicacion" class="text-error" />
            </div>
            <div class="form-control ">
                <label class="label">FICHA TECNICA(Ubicación)</label>
                <VeeField name="ficha_tecnica" v-model="formulario.ficha_tecnica" :class="`input w-full ${errors.ficha_tecnica ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="ficha_tecnica" class="text-error" />
            </div>
            <div class="form-control ">
                <label class="label">MANUAL DE USO(ubicación)</label>
                <VeeField name="manual_uso" v-model="formulario.manual_uso" :class="`input w-full ${errors.manual_uso ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="manual_uso" class="text-error" />
            </div>
            <div class="form-control ">
                <label class="label">Garantia</label>
                <VeeField name="garantia" v-model="formulario.garantia" :class="`input w-full ${errors.garantia ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="garantia" class="text-error" />
            </div>
            <div class="form-control ">
                <label class="label">Instr. de Operación</label>
                <VeeField name="instruccion_operacion" v-model="formulario.instruccion_operacion" :class="`input w-full ${errors.instruccion_operacion ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="instruccion_operacion" class="text-error" />
            </div>
            <div class="form-control ">
                <label class="label">Periodicidad de Calibración</label>
                <VeeField name="periodicidad_calibracion" v-model="formulario.periodicidad_calibracion" :class="`input w-full ${errors.periodicidad_calibracion ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="periodicidad_calibracion" class="text-error" />
            </div>
            <div class="form-control ">
                <label class="label">Periodicidad de Verificación</label>
                <VeeField name="periodicidad_verificacion" v-model="formulario.periodicidad_verificacion" :class="`input w-full ${errors.periodicidad_verificacion ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="periodicidad_verificacion" class="text-error" />
            </div>
            <div class="form-control ">
                <label class="label">Proveedor de venta</label>
                <VeeField name="proveedor_venta" v-model="formulario.proveedor_venta" :class="`input w-full ${errors.proveedor ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="proveedor" class="text-error" />
            </div>
            <div class="form-control ">
                <label class="label">contacto proveedor</label>
                <VeeField name="contacto" v-model="formulario.contacto_proveedor_venta" :class="`input w-full ${errors.contacto_proveedor_venta ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="contacto" class="text-error" />
            </div>
            <div class="form-control ">
                <label class="label">Email de proveedor</label>
                <VeeField name="email_proveedor" v-model="formulario.email_proveedor" :class="`input w-full ${errors.email_proveedor ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="email_proveedor" class="text-error" />
            </div>
          </div>
        </div>
        <!-- Fotografía del equipo y accesorios -->
        <div class="card border shadow-lg p-4">
            <h2 class="card-title">2. Fotografía del Equipo y Accesorios</h2>
            <div> <!-- Imagen del item -->
              <label class="label">
                <span class="block text-md font-medium leading-6 ">Imagen del item</span>
              </label>
              <input type="file" ref="inputFile" class="file-input file-input-bordered w-full" name="resource" @change="handleFileChange" />
              <div class="card card-compact w-full">
                <div class="card-body">
                  <figure class="mt-2">
                    <img ref="itemPhoto" @click="openModal(true)" src="https://www.shutterstock.com/image-vector/default-image-icon-vector-missing-600nw-2079504220.jpg" alt="Imagen del articulo" width="360" />
                  </figure>
                  <CardImagenFull idModal="modal-imagen" :isModalOpen="isModalOpen" :imagen="itemPhoto?.src" @close="openModal"></CardImagenFull>
                </div>
              </div>
            </div>
        </div>
        <!-- Características metrológicas del equipo -->
        <div class="card border shadow-lg p-4">
          <h2 class="card-title">3. Características Metrológicas del Equipo</h2>
          <div class="form-control mb-2">
            <div>
              <label class="label">Resolución</label>
              <VeeField name="resolucion" v-model="formulario.resolucion" :class="`input w-full ${errors.resolucion ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="resolucion" class="text-error" />
            </div>
            <div>
              <label class="label">Clase de exactitud</label>
              <VeeField name="clase_exactitud" v-model="formulario.clase_exactitud" :class="`input w-full ${errors.clase_exactitud ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="clase_exactitud" class="text-error" />
            </div>
            <div>
              <label class="label">Rango(s) de medición</label>
              <VeeField name="rango_medicion" v-model="formulario.rango_medicion" :class="`input w-full ${errors.rango_medicion ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="rango_medicion" class="text-error" />
            </div>
            <div>
              <label class="label">Intervalo(s) de medición</label>
              <VeeField name="intervalo_medicion" v-model="formulario.intervalo_medicion" :class="`input w-full ${errors.intervalo_medicion ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="intervalo_medicion" class="text-error" />
            </div>
            <div>
              <label class="label">Error máximo permitido</label>
              <VeeField name="error_maximo" v-model="formulario.error_maximo" :class="`input w-full ${errors.error_maximo ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="error_maximo" class="text-error" />
            </div>
          </div>
        </div>
        <!-- Datos de adquisición del equipo -->
        <div class="card border shadow-lg p-4">
          <h2 class="card-title">4. Datos de Adquisición del Equipo</h2>
          <div class="form-control mb-2">
            <div>
              <label class="label">Fecha de adquisición</label>
              <VeeField name="fecha_adquisicion" type="date" v-model="formulario.fecha_adquisicion" :class="`input w-full ${errors.fecha_adquisicion ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="fecha_adquisicion" class="text-error" />
            </div>
            <div>
              <label class="label">Valor de adquisición</label>
              <VeeField name="valor_adquisicion" v-model="formulario.valor_adquisicion" :class="`input w-full ${errors.valor_adquisicion ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="valor_adquisicion" class="text-error" />
            </div>
            <div>
              <label class="label">telefono de contacto</label>
              <VeeField name="persona_contacto" v-model="formulario.persona_contacto" :class="`input w-full ${errors.persona_contacto ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="persona_contacto" class="text-error" />
            </div>
            <div>
              <label class="label">email de contacto</label>
              <VeeField name="email_contacto" v-model="formulario.email_contacto" :class="`input w-full ${errors.email_contacto ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="email_contacto" class="text-error" />
            </div>
          </div>
        </div>
        <!-- Datos de calibración del equipo -->
        <div class="card border shadow-lg p-4">
          <h2 class="card-title">5. Datos de Calibración del Equipo</h2>
          <div class="form-control mb-2">
            <div>
              <label class="label">Fecha de calibración actual</label>
              <VeeField name="fecha_calibracion_actual" type="date" v-model="formulario.fecha_calibracion_actual" :class="`input w-full ${errors.fecha_calibracion_actual ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="fecha_calibracion_actual" class="text-error" />
            </div>
            <div>
              <label class="label">Fecha próxima a calibrar</label>
              <VeeField name="fecha_proxima_calibracion" type="date" v-model="formulario.fecha_proxima_calibracion" :class="`input w-full ${errors.fecha_proxima_calibracion ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="fecha_proxima_calibracion" class="text-error" />
            </div>
            <div>
              <label class="label">Max. incertidumbre/calibración</label>
              <VeeField name="maxima_incertidumbre" v-model="formulario.maxima_incertidumbre" :class="`input w-full ${errors.maxima_incertidumbre ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="maxima_incertidumbre" class="text-error" />
            </div>
            <div>
              <label class="label">Proveedor de calibración</label>
              <VeeField name="proveedor_calibracion" v-model="formulario.proveedor_calibracion" :class="`input w-full ${errors.proveedor_calibracion ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="proveedor_calibracion" class="text-error" />
            </div>
            <div>
              <label class="label">telefono de contacto de calibración</label>
              <VeeField name="persona_contacto_calibracion" v-model="formulario.persona_contacto_calibracion" :class="`input w-full ${errors.persona_contacto_calibracion ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="persona_contacto_calibracion" class="text-error" />
            </div>
            <div></div>
              <label class="label">email de contacto de calibración</label>
              <VeeField name="email_contacto_calibracion" v-model="formulario.email_contacto_calibracion" :class="`input w-full ${errors.email_contacto_calibracion ? 'input-error' : 'input-bordered'}`" />
              <VeeErrorMessage name="email_contacto_calibracion" class="text-error" />
            </div>
          </div>
          <div class="card border shadow-lg p-4">
            <h2 class="card-title">6. Control de Equipos</h2>
            <div class="form-control mb-2">
              <div>
                <label class="label">Frecuencia de verificación</label>
                <VeeField name="frecuencia_verificacion" v-model="formulario.frecuencia_verificacion" :class="`input w-full ${errors.frecuencia_verificacion ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="frecuencia_verificacion" class="text-error" />
              </div>
              <div>
                <label class="label">Procedimiento de verificación</label>
                <VeeField name="procedimiento_verificacion" v-model="formulario.procedimiento_verificacion" :class="`input w-full ${errors.procedimiento_verificacion ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="procedimiento_verificacion" class="text-error" />
              </div>
              <div>
                <label class="label">Frecuencia de calibración</label>
                <VeeField name="frecuencia_calibracion" v-model="formulario.frecuencia_calibracion" :class="`input w-full ${errors.frecuencia_calibracion ? 'input-error' : 'input-bordered'}`" />
                <VeeErrorMessage name="frecuencia_calibracion" class="text-error" />
              </div>
            </div>
          </div>
        </div>
        <!-- Control de equipos -->
      </div>
  </VeeForm>
</template>

<script lang="ts" setup>
import { ref } from 'vue';
import * as yup from 'yup';
import type { ItemEntity } from '~/Domain/Models/Entities/item';
const { setImagen } = useImagen();

const emits = defineEmits(["submit"]);
const itemPhoto = ref<HTMLImageElement | null>(null);
const inputFile = ref();
const isModalOpen = ref(false);


const formulario: Ref<ItemEntity> = ref({
  item_id: '',
  name: '',
  description: '',
  equipment_type: 0,
  fabricante: '',
  modelo: '',
  marca: '',
  serial_number: '',
  activo_fijo: '',
  ubicacion: '',
  ficha_tecnica: '',
  proveedor_venta: '',
  email_proveedor: '',
  contacto_proveedor_venta: '',
  email: '',
  manual_uso: '',
  garantia: '',
  instruccion_operacion: '',
  periodicidad_calibracion: '',
  periodicidad_verificacion: '',
  contacto: '',
  email_contacto: '',
  resolucion: '',
  clase_exactitud: '',
  rango_medicion: '',
  intervalo_medicion: '',
  error_maximo: '',
  fecha_calibracion_actual: '',
  fecha_proxima_calibracion: '',
  maxima_incertidumbre: '',
  proveedor_calibracion: '',
  persona_contacto_calibracion: '',
  email_contacto_calibracion: '',
  frecuencia_verificacion: '',
  frecuencia_calibracion: '',
  fecha_adquisicion: '',
  valor_adquisicion: '',
  persona_contacto: '',
  telefono_email: ''
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

function openModal(valor: boolean) {
  isModalOpen.value = valor;
}


const formularioSchema = yup.object({
  name: yup.string().required('*Campo requerido'),
  fabricante: yup.string().required('*Campo requerido'),
  modelo: yup.string().required('*Campo requerido'),
  marca: yup.string().required('*Campo requerido'),
  serial_number: yup.string().required('*Campo requerido'),
  activo_fijo: yup.string().required('*Campo requerido'),
  ubicacion: yup.string().required('*Campo requerido'),
  ficha_tecnica: yup.string().required('*Campo requerido'),
  garantia: yup.string().required('*Campo requerido'),
  instruccion_operacion: yup.string().required('*Campo requerido'),
  periodicidad_calibracion: yup.string().required('*Campo requerido'),
  periodicidad_verificacion: yup.string().required('*Campo requerido'),
  proveedor_venta: yup.string().required('*Campo requerido'),
  email_proveedor: yup.string().required('*Campo requerido'),
  contacto_proveedor_venta: yup.string().required('*Campo requerido'),
  email_contacto: yup.string().required('*Campo requerido'),
  email: yup.string().required('*Campo requerido'),
  manual_uso: yup.string().required('*Campo requerido'),
  resolucion: yup.string().required('*Campo requerido'),
  clase_exactitud: yup.string().required('*Campo requerido'),
  rango_medicion: yup.string().required('*Campo requerido'),
  intervalo_medicion: yup.string().required('*Campo requerido'),
  error_maximo: yup.string().required('*Campo requerido'),
  fecha_calibracion_actual: yup.date().required('*Campo requerido'),
  fecha_proxima_calibracion: yup.date().required('*Campo requerido'),
  maxima_incertidumbre: yup.string().required('*Campo requerido'),
  proveedor_calibracion: yup.string().required('*Campo requerido'),
  frecuencia_verificacion: yup.string().required('*Campo requerido'),
  frecuencia_calibracion: yup.string().required('*Campo requerido'),
  persona_contacto_calibracion: yup.string().required('*Campo requerido'),
  email_contacto_calibracion: yup.string().required('*Campo requerido'),
  fecha_adquisicion: yup.date().required('*Campo requerido'),
  valor_adquisicion: yup.string().required('*Campo requerido'),
  persona_contacto: yup.string().required('*Campo requerido'),
  telefono_email: yup.string().required('*Campo requerido')
});

const onSubmit = (values: any) => {
  emits("submit", values); // Emitir datos del formulario
};
</script>