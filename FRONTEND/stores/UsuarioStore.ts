import { defineStore } from 'pinia'
import { number } from 'yup';
import type { UsuarioEntity } from '~/Domain/Models/Entities/usuario';

type usuarioStore = {
  conectado: boolean,
  usuario?: UsuarioEntity,
  token?: string,
  expire?: number,
  usuarioType?: boolean
}

export const UsuarioStore = defineStore({
  id: 'UsuarioStore',
  state: (): usuarioStore => ({
    conectado: false,
    usuario: undefined,
    token: undefined,
    expire: 0,
    usuarioType: false
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
    setUsuarioType(type: number) {
      this.usuarioType = type
    },
    clearStore() {
      this.$reset();
    }
  },
  persist: true
})
