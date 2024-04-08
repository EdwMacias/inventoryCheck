import { defineStore } from 'pinia'
import type { UsuarioEntity } from '~/Domain/Models/Entities/usuario.entity'

type usuarioStore = {
  conectado: boolean,
  usuario?: UsuarioEntity
}

export const UsuarioStore = defineStore({
  id: 'UsuarioStore',
  state: (): usuarioStore => ({
    conectado: false,
    usuario : undefined
  }),
  actions: {
    setUsuario(usuario: UsuarioEntity) {
      this.usuario = usuario;
    },
    setConectado(conectado: boolean) {
      this.conectado = conectado
    },
    clearStore(){
      this.$reset();
    }
  },
  persist: true
})
