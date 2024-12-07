import { baseURL } from "../config.connection";

export const GET_ITEMS_PAGINATION = baseURL + "item";
export const DELETE_ITEM = baseURL + "item/{id}";
export const POST_ITEM_CREATE = baseURL + "item/basico";
export const POST_EQUIPO_CREATE = baseURL + "item/equipo";
export const GET_ITEM_SEARCH = baseURL + "item?search={id}"
export const GET_OBSERVACIONES_EQUIPO_BY_ITEM_ID = baseURL + "item/observacion/equipo/{id}";
export const GET_OBSERVACIONES_OFICINA_BY_ITEM_ID = baseURL + "item/observacion/oficina/{id}";
export const GET_EQUIPO_DETAILS_BY_ITEM_ID = baseURL + "item/equipo/detail/";
export const GET_BASICO_DETAILS_BY_ITEM_ID = baseURL + "item/basico/detail/";