import { URL_BASE } from "../../config/ConnectionBase";

const URL_AUTHENTICACION = URL_BASE + "auth/"

export const POST_LOGIN_USER = URL_AUTHENTICACION + "login";
export const PUT_LOGOUT_USER = URL_AUTHENTICACION + "logout/:id";