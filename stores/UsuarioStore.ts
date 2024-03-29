import { defineStore } from 'pinia'
import { UsuarioService } from '~/domain/services/usuario.services';
import type { LoginEntity } from '~/domain/models/entities/login.entity';
import type { UsuarioStore as usuarioModel } from '~/domain/models/entities/usuario.entity';

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
