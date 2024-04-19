import { defineStore } from 'pinia'
import type { UsuarioEntity } from '~/domain/models/Entities/usuario';

type usuarioStore = {
  conectado: boolean,
  usuario?: UsuarioEntity,
  token?: string,
  expire?: number,
}

export const UsuarioStore = defineStore({
  id: 'UsuarioStore',
  state: (): usuarioStore => ({
    conectado: false,
    usuario: undefined,
    token: undefined,
    expire: 0
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
    setExpire(expire: number) {
      this.expire = expire
    },
    clearStore() {
      this.$reset();
    }
  },
  persist: true
})
