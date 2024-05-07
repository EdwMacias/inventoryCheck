import type { PasswordRecovery } from "~/domain/models/Api/Request/password.recovery.model";
import { PasswordRepository } from "~/infrastructure/Repositories/Password/password.repository"

export const RecoveryPasswordServices = {

    CodeTemporaryRecovery: async (email: string) => {
        let response = await PasswordRepository.SendCodeTemporary(email);
        return response;
    },

    UpdatePassword: async (code : number, passwordUpate : PasswordRecovery) => {
        let response = await PasswordRepository.UpdatePassword(code, passwordUpate);
        return response;
    },

    ValidationCodeRecovery: async (email: string, code: number) => {
        let response = await PasswordRepository.ValidateCodeTemporary(email, code);
        return response;
    }

}