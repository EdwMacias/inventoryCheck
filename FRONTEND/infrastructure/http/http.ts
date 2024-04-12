import type { Response } from "@/Domain/Models/Api/Response/api";
import { connection } from "@/Infrastructure/Config/axios";

export const get = async<T>(url: string) => {
    try {
        const response = await connection.get(url);
        return response.data as Response<T>;
    } catch (error) {
        console.error('Error al obtener datos:', error);
        throw error;
    }
}


export const post = async<T>(url: string, data?: {} | string) => {
    const response = await connection.post<Response<T>>(url, data)
        .then(response => response.data).then(data => data).catch(err => err.response.data as Response<T>);
    return response;
}

export const put = async<T>(url: string, data?: {} | string) => {
    try {
        const response = await connection.put(url, data);
        return response.data as Response<T>;
    } catch (error) {
        console.error('Error al actualizar datos:', error);
        throw error;
    }
}

const _delete = async<T>(url: string) => {
    try {
        const response = await connection.delete(url);
        return response.data as Response<T>;
    } catch (error) {
        console.error('Error al eliminar datos:', error);
        throw error;
    }
}

export const request = async<T>(method: string, url: string, data?: string | {}) => {
    try {
        const response = await connection({
            method,
            url,
            data,
        });
        return response.data as Response<T>;
    } catch (error) {
        console.error('Error en la solicitud:', error);
        throw error;
    }
}

export const http = {
    get,
    post,
    put,
    delete: _delete,
    request
}