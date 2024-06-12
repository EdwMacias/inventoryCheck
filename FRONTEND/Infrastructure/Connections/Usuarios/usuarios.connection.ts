import { baseURL } from "../config.connection";

export const GET_USUARIOS_ALL = baseURL + 'user/all';
export const PUT_USUARIO_INACTIVAR = baseURL + 'user/inactivar/{id}';
export const PUT_USUARIO_ACTIVAR = baseURL + 'user/activar/{id}';
export const GET_USUARIO_BY_EMAIL = baseURL + 'user/{id}';

export const POST_CREATE_USUARIO = baseURL + 'user/create'
export const POST_UPDATE_USUARIO = baseURL + 'user/update/{id}'