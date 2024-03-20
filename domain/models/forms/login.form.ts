import type { ValidValue } from "./valids.form"

export type FormularioLoginEntity = {
    email: ValidValue<string>,
    password: ValidValue<string>
}