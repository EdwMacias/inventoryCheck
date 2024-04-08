import { defineStore } from 'pinia'

interface alerta { tipo: string, cabecera: string, mensaje: string }

export const useMyAlertaStoreStore = defineStore({
  id: 'myAlertaStoreStore',
  state: () => ({
    emitNotificacion: async (alerta: alerta) => {

    }
  }),
})
