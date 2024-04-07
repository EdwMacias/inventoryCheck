import { connection } from "../Config/axios.config";

export const get = async<T>(url: string) => {
    try {
        const response = await connection.get(url);
        return response.data as T;
    } catch (error) {
        console.error('Error al obtener datos:', error);
        throw error;
    }
}


export const post = async<T>(url: string, data?: {} | string) => {
    try {
        const response = await connection.post(url, data);
        return response.data as T;
    } catch (error) {
        console.error('Error al enviar datos:', error);
        throw error;
    }
}

export const put = async<T>(url: string, data?: {} | string) => {
    try {
        const response = await connection.put(url, data);
        return response.data as T;
    } catch (error) {
        console.error('Error al actualizar datos:', error);
        throw error;
    }
}

const _delete = async<T>(url: string) => {
    try {
        const response = await connection.delete(url);
        return response.data as T;
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
        return response.data as T;
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