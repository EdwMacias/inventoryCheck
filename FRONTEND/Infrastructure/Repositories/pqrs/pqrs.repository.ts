import type { PqrsRequest } from "~/Domain/Models/Api/Request/pqrs.Request";
import { POST_PQRS_CREATE, GET_PQRS } from "~/Infrastructure/Connections/endpoints.connection"
import { http } from "~/Infrastructure/http/http"

export const ItemRepository = {

    Create: async (pqrsRequest: PqrsRequest) => {
        const response = await http.post<PqrsRequest>(POST_PQRS_CREATE, toFormData(pqrsRequest));
        return response;
    },
    Get: async () => {
        const response = await http.get(GET_PQRS);
        return response;
    }
}   