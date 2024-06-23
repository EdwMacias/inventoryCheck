import { baseURL } from "../config.connection";

const URL_AUTHENTICACION = baseURL + "auth/"

export const POST_LOGIN_USUARIO = URL_AUTHENTICACION + "login";
export const POST_LOGOUT_USUARIO = URL_AUTHENTICACION + "logout";
export const POST_REFRESH_USUARIO = URL_AUTHENTICACION + "refresh";
export const POST_AUTH_ME = URL_AUTHENTICACION + "me";