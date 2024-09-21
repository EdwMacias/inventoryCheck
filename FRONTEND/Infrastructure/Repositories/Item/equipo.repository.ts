import type { EquipoRequestCreateDTO } from "~/Domain/DTOs/EquipoRequestCreateDTO";
import type { EquipoRequestCreate } from "~/Domain/Models/Api/Request/equipo.request";
import { POST_EQUIPO_CREATE } from "~/Infrastructure/Connections/endpoints.connection";
import { http } from "~/Infrastructure/http/http";

export const EquipoRepository = {
    create: async (equipoCreateRequest: FormData) => {
        const response = await http.post<EquipoRequestCreateDTO>(POST_EQUIPO_CREATE, equipoCreateRequest);
        return response;
    }

}