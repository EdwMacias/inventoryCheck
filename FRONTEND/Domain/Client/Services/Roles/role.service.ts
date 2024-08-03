import type { RoleRequestAssingRoleDTO } from "~/Domain/DTOs/Request/Roles/RoleRequestAssingRoleDTO";
import type { RoleRequestAssingRole } from "~/Domain/Models/Api/Request/Role/RoleRequestAssingRole";
import { RolesRepository } from "~/Infrastructure/Repositories/Roles/role.repository";

export const RoleService = {

    assignar: async (roleRequestAssingRoleDTO: RoleRequestAssingRoleDTO) => {
        const responseBoolean = RolesRepository.assignarRole(dtoToObject<RoleRequestAssingRole>(roleRequestAssingRoleDTO));
        return responseBoolean;
    }
}