import axios, { type AxiosInstance } from 'axios';
import { URL_BASE } from '@/connections/config/ConnectionBase';

export const connection: AxiosInstance = axios.create({ baseURL: URL_BASE });
export const setAuthenticationAxios = (token?: string) => { connection.defaults.headers.common["Authorization"] = token };