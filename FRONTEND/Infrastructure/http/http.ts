import type { AxiosError } from "axios";
import type { Response } from "../../Domain/Models/Api/Response/api";
import { connection } from "../Config/axios";

export const get = async<T>(url: string) => {
    try {
        const response = await connection.get(url);
        return response.data as Response<T>;
    } catch (error) {
        let err = error as AxiosError<Response<{ error: string }>, Response<{ error: string }>>;
        if (err.code === "ERR_NETWORK") throw new Error("No hay respuesta del servidor");
        const { response } = err;
        if (response?.data) {
            const { error } = response.data.data;
            throw new Error(error);
        }
    }
}


export const post = async<T>(url: string, data?: {} | string) => {

    try {
        const response = await connection.post<Response<T>>(url, data);
        return response.data;
    } catch (error: any) {
        let err = error as AxiosError<Response<{ error: string }>, Response<{ error: string }>>;
        if (err.code === "ERR_NETWORK") throw new Error("No hay respuesta del servidor");
        const { response } = err;
        if (response?.data) {
            const { error } = response.data.data;
            throw new Error(error);
        }
    }

}

export const put = async<T>(url: string, data?: {} | string) => {
    try {
        const response = await connection.put<Response<T>>(url, data);
        return response.data;
    } catch (error: any) {
        let err = error as AxiosError<Response<{ error: string }>, Response<{ error: string }>>;
        if (err.code === "ERR_NETWORK") throw new Error("No hay respuesta del servidor");
        const { response } = err;
        if (response?.data) {
            const { error } = response.data.data;
            throw new Error(error);
        }
    }
}

const _delete = async<T>(url: string) => {
    try {
        const response = await connection.delete(url);
        return response.data as Response<T>;
    } catch (error) {
        let err = error as AxiosError<Response<{ error: string }>, Response<{ error: string }>>;
        if (err.code === "ERR_NETWORK") throw new Error("No hay respuesta del servidor");
        const { response } = err;
        if (response?.data) {
            const { error } = response.data.data;
            throw new Error(error);
        }
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
        let err = error as AxiosError<Response<{ error: string }>, Response<{ error: string }>>;
        if (err.code === "ERR_NETWORK") throw new Error("No hay respuesta del servidor");
        const { response } = err;
        if (response?.data) {
            const { error } = response.data.data;
            throw new Error(error);
        }
    }
}

export const http = {
    get,
    post,
    put,
    delete: _delete,
    request
}