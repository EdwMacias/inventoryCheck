import { defineStore } from 'pinia'
<<<<<<< HEAD:FRONTEND/stores/UsuarioStore.ts
import { UsuarioService } from '~/domain/Services/Usuario.services';
import type { LoginEntity } from '~/domain/models/Entities/Login';
import type { UsuarioStore as usuarioModel } from '~/domain/models/Entities/Usuario';
=======
import { UsuarioService } from '~/domain/services/usuario.services';
import type { LoginEntity } from '~/domain/models/entities/login.entity';
import type { UsuarioStore as usuarioModel } from '~/domain/models/entities/usuario.entity';
>>>>>>> 5fa06c1ec8c38782a1ff44952937d0310ffa14e8:stores/UsuarioStore.ts

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
