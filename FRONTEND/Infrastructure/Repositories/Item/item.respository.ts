import type { ItemRequest } from "~/Domain/Models/Api/Request/item.request";
import type { PaginationResponse } from "~/Domain/Models/Api/Response/pagination.response";
import type { ItemEntity } from "~/Domain/Models/Entities/item";
import { GET_ITEMS_PAGINATION, POST_ITEM_CREATE } from "~/Infrastructure/Connections/endpoints.connection"
import { http } from "~/Infrastructure/http/http"

export const ItemRepository = {

    Create: async (itemRequest: ItemRequest) => {
        const response = await http.post<Boolean>(POST_ITEM_CREATE, itemRequest);
        return response;
    },
    Pagination: async (url: string | null = null) => {
        const URL_PETICION = (url) ? url : GET_ITEMS_PAGINATION;
        const response = await http.post<PaginationResponse<ItemEntity>>(URL_PETICION);
        return response;
    }

}   