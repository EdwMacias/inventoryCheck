import { defineStore } from 'pinia'
import type { UsuarioEntity } from '~/domain/models/Entities/usuario';

type usuarioStore = {
  conectado: boolean,
  usuario?: UsuarioEntity,
  token?: string
}

export const UsuarioStore = defineStore({
  id: 'UsuarioStore',
  state: (): usuarioStore => ({
    conectado: false,
    usuario: undefined,
    token: undefined
  }),
  actions: {
    setUsuario(usuario: UsuarioEntity) {
      this.usuario = usuario;
    },
    setConectado(conectado: boolean) {
      this.conectado = conectado
    },
    setToken(token: string) {
      this.token = token
    },
    clearStore() {
      this.$reset();
    }
  },
  persist: true
})
