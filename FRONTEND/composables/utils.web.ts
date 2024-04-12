export function saveToLocalStorage(key: string, value: any) {
  localStorage.setItem(key, JSON.stringify(value));
}

export function getFromLocalStorage(key: string) {
  const value = localStorage.getItem(key);
  const result = value ? JSON.parse(value) : null;
  return result;
}

export function removeFromLocalStorage(key: string) {
  localStorage.removeItem(key);
}

export const setDataWithoutValid = async<T>(entity: any, value: string) => {
  return { ...entity, value, valid: true } as T;
}

const validateValues = (value?: string | number) => {
  return (value !== undefined && (value === "" || value === 0))
}

export const validateNumber = (value: any): boolean => {
  return typeof value === 'number' && !isNaN(value);
}

export const validateAndSetFormValidity = (form: any) => {
  let isValid = true;

  for (const key in form) {
    if (Object.prototype.hasOwnProperty.call(form, key)) {
      const obj = form[key as keyof typeof form];
      isValid = validateValues(obj.value);
    }
  }

  return isValid;
};

export const emitNotificaciones = async (alertas: { tipo: string, cabecera: string, mensaje: string }) => {
  const alertaStore = AlertaStore();
  await alertaStore.emitNotificacion(alertas);
}

