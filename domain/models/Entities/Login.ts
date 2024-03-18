export type LoginEntity = {
    email: string,
    correo: string
}

export type ResponseLogin = {
    token: string,
    estado: boolean
}

export interface ResponseData<T> {
    data: T
    status?: number;
}
