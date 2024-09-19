<template>
  <!-- {{ formularioHistorial }} -->
  <VeeForm :validationSchema="formularioHistorialSchema" @submit="onSubmit" v-slot="{ meta, errors }">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-2">
      <div class="">
        <label class="label">Fecha de Ejecución *</label>
        <VeeField name="fecha" v-model="formularioHistorial.fecha" type="date"
          :class="`input w-full ${errors.fecha ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="fecha" class="text-error" />
      </div>
      <div class="">
        <label class="label">Fecha Próxima Actividad *</label>
        <VeeField name="proximaActividad" v-model="formularioHistorial.proximaActividad" type="date"
          :class="`input w-full ${errors.proxAct ? 'input-error' : 'input-bordered'}`" />
        <!-- <p class="text-error"></p> -->
        <VeeErrorMessage name="proximaActividad" class="text-error" />
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-2">
      <div>
        <label class="label">Asunto *</label>
        <VeeField name="asunto" v-model="formularioHistorial.asunto" placeholder="MTTO"
          :class="`input w-full ${errors.descripcion ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="asunto" class="text-error" />
      </div>
      <div>
        <label class="label">Estado *</label>
        <VeeField name="estado" v-model="formularioHistorial.estado" as="select"
          :class="`select w-full ${errors.estado ? 'select-error' : 'select-bordered'}`">
          <option value="0">Selecciona una opción</option>
          <option value="c">Correcto</option>
          <option value="s">Suspendido</option>
          <option value="nc">Incorrecto</option>
        </VeeField>
        <VeeErrorMessage name="estado" class="text-error" />
      </div>
    </div>

    <div class="mb-2">
      <label class="label">Responsable *</label>
      <VeeField name="responsable" v-model="formularioHistorial.responsable" placeholder="SOLTEC"
        :class="`input w-full ${errors.responsable ? 'input-error' : 'input-bordered'}`" />
      <VeeErrorMessage name="responsable" class="text-error" />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 mb-2">
      <div class="mb-2 w-full h-40">
        <label class="label">
          <span class="block text-md">Firma Responsable *</span>
        </label>

        <div class="container-canva">
          <canvas class="border-dashed border-2 border-indigo-600">
            No tienes un buen navegador.
          </canvas>
          <!-- <button @click="save">Save</button> -->
          <!-- <button @click="undo">Undo</button> -->
        </div>
      </div>
    </div>


    <!-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mt-10"> -->

    <div class="mt-10">
      <label class="label">
        <span class="block text-md">Fotos Observación *</span>
      </label>
      <ImageUploader @files-selected="handleFilesSelected" />
    </div>

    <div class="flex gap-2 grid grid-cols-2 mt-2">
      <ButtonOptions :to="''" />
    </div>
    <!-- </div> -->
    <!-- <div class="mt-10 flex items-center justify-end gap-x-6">
      <button type="submit" class="btn btn-primary">Agregar</button>
      <NuxtLink :to="`/inventario/items/observaciones/equipo/${route.params.id}`" class="btn btn-neutral">Cancelar
      </NuxtLink>
    </div> -->

  </VeeForm>
</template>

<script lang="ts" setup>
import { EquipoObservacionCreateDTO } from '~/Domain/DTOs/Observaciones/Equipos/EquipoObservacionCreateDTO';
const { $swal } = useNuxtApp()
// import VueSignaturePad from 'vue-signature-pad';
import SignaturePad, { type PointGroup } from 'signature_pad';



const emit = defineEmits<{
  (event: 'callback', payload: EquipoObservacionCreateDTO): void
}>()


const formularioHistorialSchema = yup.object({
  asunto: yup.string().required('Campo requerido *'),
  estado: yup.string()
    .required('*Campo requerido')
    .oneOf(['0', 'c', 's', 'nc'], 'Debe ser uno de los valores permitidos')
    .test('no-zero', 'Debe seleccionar una opción valida *', (value) => value !== '0'),
  fecha: yup.string()
    .required('Campo requerido *')
    .matches(
      /^\d{4}-\d{2}-\d{2}$/,
      'Debe ser una fecha en formato YYYY-MM-DD'
    ),
  proximaActividad: yup.string().required('Campo requerido *').matches(
    /^\d{4}-\d{2}-\d{2}$/,
    'Debe ser una fecha en formato YYYY-MM-DD'
  ).test('is-after', 'La próxima actividad debe ser después de la fecha', function (value) {
    const { fecha } = this.parent; // Obtén el valor de 'fecha'
    if (!value || !fecha) return true; // Si cualquiera de las fechas no está definida, no validamos la comparación
    return new Date(value) >= new Date(fecha); // Compara las fechas
  }),
  responsable: yup.string().required('Campo requerido *'),
});

const route = useRoute();

const handleFilesSelected = (files: File[]) => {
  formularioHistorial.value.resource = files;
};

const onSubmit = (values: any): void => {
  // console.log(values);
  if (formularioHistorial.value.resource.length <= 0) {
    $swal.fire({
      icon: "info",
      title: "Imagenes No Cargadas",
      text: "Se requiere mínimo una foto para registrar la observación.",
      showCancelButton: false,
    })
    return;
  };

  if (!formularioHistorial.value.firmaResponsable) {
    $swal.fire({
      icon: "info",
      title: "Firma responsable es necesaria",
      text: "Se requiere firma del responsable para registrar la observación.",
      showCancelButton: false,
    })
    return;
  }

  return emit("callback", formularioHistorial.value)
};


const formularioHistorial: Ref<EquipoObservacionCreateDTO> = ref(new EquipoObservacionCreateDTO(null));

onMounted(() => {
  const canvas = document.querySelector("canvas");
  if (canvas) {
    const signaturePad = new SignaturePad(canvas);
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientHeight;

    window.addEventListener('resize', () => {
      canvas.width = canvas.clientWidth;
      canvas.height = canvas.clientHeight;
      signaturePad.clear(); // Opcional, para limpiar el canvas si es necesario
    });
  }

})

</script>

<style lang="css" scoped>
.container-canva {
  position: relative;
  /* Necesario para que el canvas pueda ocupar el 100% del contenedor */
  width: 100%;
  /* Ocupa el 100% del ancho del contenedor */
  height: 100%;
  /* Ocupa el 100% de la altura del contenedor, o puedes definir una altura específica */
}

canvas {
  position: absolute;
  /* Permite que el canvas se ajuste a su contenedor */
  top: 0;
  left: 0;
  width: 100%;
  /* Ocupa el 100% del ancho del contenedor */
  height: 100%;
  /* Ocupa el 100% de la altura del contenedor */
}
</style>