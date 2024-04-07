import { baseURL } from "../config.connection";

const URL_AUTHENTICACION = baseURL + "auth/"

export const POST_LOGIN_USER = URL_AUTHENTICACION + "login";
export const PUT_LOGOUT_USER = URL_AUTHENTICACION + "logout/:id";