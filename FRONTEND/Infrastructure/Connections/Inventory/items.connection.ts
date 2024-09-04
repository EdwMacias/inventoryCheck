import { baseURL } from "../config.connection";

export const GET_ITEMS_PAGINATION = baseURL + "item";
export const POST_ITEM_CREATE = baseURL + "item/basico";
export const POST_EQUIPO_CREATE = baseURL + "item/equipo";

export const GET_OBSERVACIONES_EQUIPO_BY_ITEM_ID= baseURL+"item/observacion/equipo/{id}";