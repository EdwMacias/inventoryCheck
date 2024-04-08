<template>
  <div class="toast toast-top toast-end" style="z-index: 10000;">
    <div v-for="(alerta, index) in alertas" :key="index" :id="'alert-' + index" role="alert" ref="botonesCerrarAlertas"
      class="alert shadow-lg bg-white animate__animated animate__backInRight">
      <div class="stroke-current shrink-0 h-6 w-6">
        <i :class="alerta.tipo"></i>
      </div>
      <div>
        <h3 class="font-bold">{{ alerta.cabecera }}</h3>
        <div class="text-xs">{{ alerta.mensaje }}</div>
      </div>
      <button><i class="bi bi-x-circle" @click="eventHide(index)"></i></button>
    </div>
  </div>
</template>

<script lang="ts" setup>

import { useMyAlertaStoreStore } from '~/stores/AlertaStore';

interface alerta { tipo: string, cabecera: string, mensaje: string }

const iconosAlerta: Record<string, string> = {
  info: 'bi bi-info-circle',
  warning: 'bi bi-exclamation-triangle',
  danger: 'bi bi-x-circle-fill',
  success: 'bi bi-check-circle-fill'
}

const alertas: Ref<alerta[]> = ref([])
const botonesCerrarAlertas = ref([]);

const crearNotificacion = async (alerta: alerta) => {
  alerta.tipo = iconosAlerta[alerta.tipo];
  await alertas.value.push(alerta);
}

const cerrarNotificacion = async (alertaDocument: HTMLElement) => {
  alertaDocument.classList.remove("animate__backInRight");
  const animationDuration = parseFloat(window.getComputedStyle(alertaDocument).getPropertyValue('animation-duration')) * 1000;
  alertaDocument.classList.add("animate__fadeOut");
  setTimeout(() => {
    alertaDocument.remove();
  }, animationDuration);
};

const eventHide = (index: number) => {
  const id = 'alert-' + index
  const alertDiv = document.getElementById(id);
  if (alertDiv) {
    cerrarNotificacion(alertDiv);
  }
}

onMounted(() => {
  const alertaStore = useMyAlertaStoreStore();
  alertaStore.emitNotificacion = crearNotificacion;

  watch(alertas.value, (newValue, oldValue) => {
    const nuevoIndice = newValue.length - 1;
    setTimeout(() => {
      let id_alerta: string = '';
      if (botonesCerrarAlertas.value[nuevoIndice]) {
        const { id }: any = botonesCerrarAlertas.value[nuevoIndice];
        id_alerta = id;
      }
      const alertaDocument = document.getElementById(id_alerta);
      if (alertaDocument) {
        cerrarNotificacion(alertaDocument);
      }
    }, 5000);
  });

});


</script>
