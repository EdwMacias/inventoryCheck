import { defineStore } from 'pinia'

interface alerta { tipo: string, cabecera: string, mensaje: string }

export const AlertaStore = defineStore({
  id: 'AlertaStore',
  state: () => ({
    emitNotificacion: (alerta: alerta) => {
    }
  }),
})
