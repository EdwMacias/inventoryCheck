import axios, { type AxiosInstance } from 'axios';
import { baseURL } from '../Connections/config.connection';

const connection: AxiosInstance = axios.create({
    baseURL: baseURL, timeout: 5000,
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