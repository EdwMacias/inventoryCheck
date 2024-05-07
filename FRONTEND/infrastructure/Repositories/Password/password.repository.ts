import type { PasswordRecovery } from "~/domain/models/Api/Request/password.recovery.model";
import type { CodePasswordRespose } from "~/domain/models/Api/Response/code.password.response";
import { http } from "~/infrastructure/http/http";

export const PasswordRepository = {
    SendCodeTemporary: async (email: string) => {
        const response = await http.get<null>('recovery/code/temporary/' + email);
        return response;
    },
    ValidateCodeTemporary: async (email: string, codigo: number) => {
        const response = await http.get<CodePasswordRespose>(`recovery/password/code/authenticacion?email=${email}&codigo=${codigo}`);
        return response;
    },
    UpdatePassword: async (code: number, passwordUpate: PasswordRecovery) => {
        const response = await http.post<null>('recovery/password/' + code, passwordUpate);
        return response;
    }
}