import { BASE_URL } from "../../config/connection.config";

const URL_AUTHENTICACION = BASE_URL + "auth/"

export const POST_LOGIN_USER = URL_AUTHENTICACION + "login";
export const PUT_LOGOUT_USER = URL_AUTHENTICACION + "logout/:id";