export type UsuarioId = string;

export type Usuario = {
  id?: UsuarioId;
  nombre?: string;
  apellido?: string;
  email?: string;
  celular?: string;
  estado?: string;
};

export type UsuarioStore = {
  usuario?: Usuario;
  conectado: boolean;
};
