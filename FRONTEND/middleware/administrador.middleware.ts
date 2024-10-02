import { RolesRepository } from "~/Infrastructure/Repositories/Roles/role.repository";

export default defineNuxtRouteMiddleware(async (to, from) => {
    if (import.meta.browser) {

        const response = await RolesRepository.getRoleUser();

        if (response.data.name !== 'ADMINISTRADOR') {
            return abortNavigation();
        }

    }
})
