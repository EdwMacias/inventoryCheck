<template>
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-2">
      <div class="mb-2">
        <label class="label">Responsable *</label>
        <VeeField name="responsable" v-model="formularioHistorial.responsable" placeholder="SOLTEC"
          :class="`input w-full ${errors.responsable ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="responsable" class="text-error" />
      </div>
      <div class="mb-2">
        <label class="label">Descripción Actividad *</label>

        <VeeField name="actividad" v-model="formularioHistorial.actividad" placeholder="V.I-MTTO PREVENTIVO"
          :class="`input w-full ${errors.actividad ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="actividad" class="text-error" />
      </div>
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
        </div>
      </div>
    </div>


    <div class="mt-10">
      <label class="label">
        <span class="block text-md">Fotos Observación *</span>
      </label>
      <ImageUploader @files-selected="handleFilesSelected" />
    </div>

    <ButtonOptions @cancel="navigate" />

  </VeeForm>
</template>

<script lang="ts" setup>
import { EquipoObservacionCreateDTO } from '~/Domain/DTOs/Observaciones/Equipos/EquipoObservacionCreateDTO';
const { $swal } = useNuxtApp()
import SignaturePad, { type PointGroup } from 'signature_pad';
const signature: Ref<SignaturePad | undefined> = ref();

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
  actividad : yup.string().required('Campo requerido *'),
});


const handleFilesSelected = (files: File[]) => {
  formularioHistorial.value.resource = files;
};

const navigate = () => {
  const route = useRoute();
  const router = useRouter();
  router.push(`/inventario/observaciones/equipo/${route.params.id}`);
}

function dataURLToBlob(dataURL: string) {
  const byteString = atob(dataURL.split(',')[1]);
  const mimeString = dataURL.split(',')[0].split(':')[1].split(';')[0];

  const ab = new ArrayBuffer(byteString.length);
  const ia = new Uint8Array(ab);
  for (let i = 0; i < byteString.length; i++) {
    ia[i] = byteString.charCodeAt(i);
  }

  return new Blob([ab], { type: mimeString });
}

function isCanvasEmpty(canvas: HTMLCanvasElement) {
  const context = canvas.getContext('2d', { willReadFrequently: true });

  if (!context) {
    return true;
  }

  const pixelBuffer = new Uint32Array(
    context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
  );

  // Si todos los píxeles tienen el valor 0, significa que el canvas está vacío
  return !pixelBuffer.some(color => color !== 0);
}

const onSubmit = (values: any): void => {
  const canvas = document.querySelector("canvas");

  if (canvas && isCanvasEmpty(canvas)) {
    $swal.fire({
      icon: "info",
      title: "No se detecta firma",
      text: "Por favor firme en el recuadro",
      showCancelButton: false,
    })
    return;
  }

  if (formularioHistorial.value.resource.length <= 0) {
    $swal.fire({
      icon: "info",
      title: "Imagenes No Cargadas",
      text: "Se requiere mínimo una foto para registrar la observación.",
      showCancelButton: false,
    })
    return;
  };


  if (signature.value?.toDataURL()) {
    const blob = dataURLToBlob(signature.value?.toDataURL());
    const file = new File([blob], "firma.png", { type: blob.type });
    formularioHistorial.value.firmaResponsable = file;
  }

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
    signature.value = signaturePad;
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