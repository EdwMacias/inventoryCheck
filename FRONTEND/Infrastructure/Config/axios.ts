import axios, { type AxiosInstance } from 'axios';


const connection: AxiosInstance = axios.create({
    baseURL: baseURL,
    headers: {
        'Accept': 'application/json',
    },
});

connection.interceptors.request.use(config => {
    const token = UsuarioRepository.getToken();

    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
    }
    
    config.headers['Content-Type'] = (config.data instanceof FormData) ? 'multipart/form-data' : 'application/json';

    return config;
});

export { connection };