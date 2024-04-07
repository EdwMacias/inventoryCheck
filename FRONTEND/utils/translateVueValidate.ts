import * as validators from '@vuelidate/validators'
const { required, email } = validators;

required.$message = "Dato Requerido";
email.$message = "Email no valido"

export { required, email }