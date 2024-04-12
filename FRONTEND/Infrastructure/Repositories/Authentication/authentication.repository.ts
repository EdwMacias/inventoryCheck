

export const AuthenticationRepository = {
    getToken: async (credenciales: LoginRequest) => {
        const response = await http.post<loginResponse>(POST_LOGIN_USUARIO, credenciales);
        return response;
    },

    deleteToken: async () => {
        const response = await http.post<boolean>(POST_LOGOUT_USUARIO);
        return response;
    },

    updateToken: async () => {
        const response = await http.post<loginResponse>(POST_REFRESH_USUARIO);
        return response;
    }
}