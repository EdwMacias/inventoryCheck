import type { AxiosError } from "axios";
import type { Response } from "../../Domain/Models/Api/Response/api";
import { connection } from "../Config/axios";
import Swal from "sweetalert2";

export const get = async<T>(url: string) => {
    try {
        const response = await connection.get(url);
        return response.data as Response<T>;
    } catch (error) {
        throw new Error(await throwError(error)).message;
    }
}


export const post = async<T>(url: string, data?: {} | string) => {

    try {
        const response = await connection.post<Response<T>>(url, data);
        return response.data;
    } catch (error: any) {
        // console.log(error);
        // console.log(throwError(error));
        // console.error(throwError(error));

        throw new Error(await throwError(error)).message;
    }

}

export const put = async<T>(url: string, data?: {} | string) => {
    try {
        const response = await connection.put<Response<T>>(url, data);
        return response.data;
    } catch (error: any) {
        throw new Error(await throwError(error)).message;

    }
}

const _delete = async<T>(url: string) => {
    try {
        const response = await connection.delete(url);
        return response.data as Response<T>;
    } catch (error) {
        throw new Error(await throwError(error)).message;
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
        // console.log(throwError(error));
        throw new Error(await throwError(error)).message;
    }
}

export const http = {
    get,
    post,
    put,
    delete: _delete,
    request
}

async function throwError(error: any) {
    // const spinnerStore = SpinnerStore();
    // spinnerStore.status = true;

    let err = error as AxiosError<Response<{ error: string }>, Response<{ error: string }>>;
    if (err.code === "ERR_NETWORK") return "No hay respuesta del servidor";
    const { response } = err;
    if (response?.data) {
        const data = response.data.data;
        // console.log(data);

        if (data != null) {
            // console.log("aqui");

            if (data.error) {
                if (Array.isArray(data.error)) {
                    data.error = data.error.map((message: string, index: number) => `${index + 1}. ${message}`).join('\n');
                }
                Swal.fire({
                    icon: 'warning',
                    title: 'Informacion',
                    text: data.error
                })
                return data.error;
                // return response.data.data.error;
            }
        }

        if (response.data.messages) {
            // console.log("aqui");

            if (Array.isArray(response.data.messages)) {
                response.data.messages = response.data.messages.map((message, index) => `${index + 1}. ${message}`).join('\n');
            }

            Swal.fire({
                icon: 'warning',
                title: 'Informacion',
                text: response.data.messages
            })
            // spinnerStore.status = false;
            return response.data.messages;
        }

        // console.log("aquiafuersa");



        return error;
    }
    return "Error Desconocido"
}