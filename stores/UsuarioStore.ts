import { defineStore } from 'pinia'
import { UsuarioService } from '~/domain/Services/Usuario.services';
import type { LoginEntity } from '~/domain/models/LoginEntity';
import type { UsuarioStore as usuarioModel } from '~/domain/models/UsuarioEntity';

export const UsuarioStore = defineStore({
  id: 'UsuarioStore',
  state: (): usuarioModel => ({
    conectado: false,
    usuario: {
      id: undefined,
      nombre: undefined,
      apellido: undefined,
      celular: undefined,
      email: undefined,
      estado: undefined
    }
  }),
  actions: {
    async LoginUsuarioConnection(Credenciales: LoginEntity) {
      const { usuario, conectado } = await UsuarioService.AuthenticationUser(Credenciales);
      this.usuario = usuario;
      this.conectado = conectado;
    }
  }
})
