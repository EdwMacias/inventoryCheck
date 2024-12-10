import type { Oficina } from "~/Domain/DTOs/Items/Oficina/OficinaInterface";
import type { ItemRequest } from "~/Domain/Models/Api/Request/item.request";
import type { ItemBasicoRequest } from "~/Domain/Models/Api/Request/itemBasico.request";
import type { ItemResponse } from "~/Domain/Models/Api/Response/item.response";
import type { PaginationResponse } from "~/Domain/Models/Api/Response/pagination.response";
import { DELETE_ITEM, GET_BASICO_DETAILS_BY_ITEM_ID, GET_ITEM_FILTER, GET_ITEM_PAGINATION_QUERYS, GET_ITEM_SEARCH, GET_ITEMS_PAGINATION, POST_ITEM_CREATE } from "~/Infrastructure/Connections/endpoints.connection"
import { http } from "~/Infrastructure/http/http"

export const ItemRepository = {

    Create: async (formData: FormData) => {
        const response = await http.post<ItemBasicoRequest>(POST_ITEM_CREATE, formData);
        return response;
    },
    Pagination: async (url: string | null = null) => {
        const URL_PETICION = (url) ? url : GET_ITEMS_PAGINATION;
        const response = await http.get<PaginationResponse<ItemResponse>>(URL_PETICION);
        return response.data;
    },
    PaginationBySearch: async (search: string) => {
        const response = await http.get<PaginationResponse<ItemResponse>>(buildURLWithId(GET_ITEM_SEARCH, search));
        return response.data;
    },
    paginationByFilter: async (search: string) => {
        const response = await http.get<PaginationResponse<ItemResponse>>(buildURLWithId(GET_ITEM_FILTER, search));
        return response.data;
    },
    paginationByFilterAndSearch: async (categoria: string, search: string) => {
        const response = await http.get<PaginationResponse<ItemResponse>>(GET_ITEM_PAGINATION_QUERYS + `categoria=${categoria}&search=${search}`);
        return response.data;
    },
    Delete: async (itemId: string) => {
        const response = await http.delete<boolean>(buildURLWithId(DELETE_ITEM, itemId));
        return response.data;
    },
    details: async (itemId: string) => {
        const response = await http.get<Oficina>(GET_BASICO_DETAILS_BY_ITEM_ID + itemId);
        return response;
    }
}   