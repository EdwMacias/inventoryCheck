import axios, { type AxiosInstance } from 'axios';
import { BASE_URL } from '~/infrastructure/connections/config/connection.config';

const connection: AxiosInstance = axios.create({
    baseURL: BASE_URL, timeout: 5000,
    headers: {
        'Accept': 'application/json',
    },
});

connection.interceptors.request.use(config => {
    const token = getFromLocalStorage('session_token_user');

    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
    }

    if (config.data instanceof FormData) {
        config.headers['Content-Type'] = 'multipart/form-data';
    } else {
        config.headers['Content-Type'] = 'application/json';
    }
    return config;
});

export { connection };