import type { EquipoRequestCreateDTO } from "~/Domain/DTOs/EquipoRequestCreateDTO";
import type { EquipoInterface } from "~/Domain/DTOs/Items/Equipo/EquipoInterfaces";
import { GET_EQUIPO_DETAILS_BY_ITEM_ID, POST_CREATE_COMPONENTE_EQUIPO_BY_ITEM_ID, POST_EQUIPO_CREATE } from "~/Infrastructure/Connections/endpoints.connection";
import { http } from "~/Infrastructure/http/http";

export const EquipoRepository = {
    create: async (equipoCreateRequest: FormData) => {
        const response = await http.post<EquipoRequestCreateDTO>(POST_EQUIPO_CREATE, equipoCreateRequest);
        return response;
    },

    details: async (itemdId: string) => {
        const response = await http.get<EquipoInterface>(GET_EQUIPO_DETAILS_BY_ITEM_ID + itemdId);
        return response;
    },

    registarComponentes: async (componentes: FormData, itemId: string) => {
        const response = await http.post<EquipoInterface>(POST_CREATE_COMPONENTE_EQUIPO_BY_ITEM_ID+itemId, componentes);
        return response;
    }

}