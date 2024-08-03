export class RoleRequestAssingRoleDTO {
    role_id: number;
    email: string;

    constructor(role: any) {
        this.email = role.email;
        this.role_id = getIdRole(role.role);
    }
}

function getIdRole(roleFind: string) {
    return ['SUPERADMINISTRADOR',
        'ADMINISTRADOR',
        'USUARIO'].findIndex(value => value == roleFind) + 1;
}