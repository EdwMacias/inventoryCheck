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
    
    config.headers['Content-Type'] = (config.data instanceof FormData) ? 'multipart/form-data' : 'application/json';

    return config;
});

export { connection };