import type { RoleRequestAssingRole } from "~/Domain/Models/Api/Request/Role/RoleRequestAssingRole";
import { GET_ROLE_USER_BY_EMAIL, POST_ASIGNACION_ROLE_USER } from "~/Infrastructure/Connections/endpoints.connection";
import { http } from "~/Infrastructure/http/http"

interface ResponseRoleUser {
    name: string | null
}

export const RolesRepository = {
    getRoleByEmail: async (email: string) => {
        const response = await http.get<ResponseRoleUser>(buildURLWithId(GET_ROLE_USER_BY_EMAIL, email));
        return response;
    },

    assignarRole: async (roleRequestAssingRole: RoleRequestAssingRole) => {
        const response = await http.post<boolean>(POST_ASIGNACION_ROLE_USER, toFormData(roleRequestAssingRole));
        return response;
    }
}