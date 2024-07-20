import type { ItemRequest } from "~/Domain/Models/Api/Request/item.request";
import type { ItemResponse } from "~/Domain/Models/Api/Response/item.response";
import type { PaginationResponse } from "~/Domain/Models/Api/Response/pagination.response";
import { GET_ITEMS_PAGINATION, POST_ITEM_CREATE } from "~/Infrastructure/Connections/endpoints.connection"
import { http } from "~/Infrastructure/http/http"

export const ItemRepository = {

    Create: async (itemRequest: ItemRequest) => {
        const formData = new FormData();

        formData.set("name",itemRequest.name);
        formData.set("serial_number",itemRequest.serie_lote);
        formData.set("resource",itemRequest.resource);

        const response = await http.post<Boolean>(POST_ITEM_CREATE, formData);
        return response;
    },
    Pagination: async (url: string | null = null)  => {
        const URL_PETICION = (url) ? url : GET_ITEMS_PAGINATION;
        const response = await http.get<PaginationResponse<ItemResponse>>(URL_PETICION);
        return response.data;
    }

}   