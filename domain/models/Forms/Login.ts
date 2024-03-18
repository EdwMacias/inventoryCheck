import type { ValidValue } from "./Valids"

export type FormularioLoginEntity = {
    email: ValidValue<string>,
    password: ValidValue<string>
}