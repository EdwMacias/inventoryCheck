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

export function checkWindowSize(size: number) {
  return (window.innerWidth <= size);
};

export function testConsoleLog() {
  console.log('test');
}

export function useImagen() {
  const setImagen = (file: File, imagenRef: Ref<HTMLImageElement | null>): void => {
    const reader = new FileReader();
    reader.onload = (e) => {
      if (e.target && typeof e.target.result === 'string' && imagenRef.value) {
        imagenRef.value.src = e.target.result;
      }
    };
    reader.readAsDataURL(file);
  };
  return {
    setImagen
  };
}

export function buildURLWithId(endpoint: string, id: any): string {
  return endpoint.replace('{id}', id.toString());
}

export function capitalizarPrimeraLetra(str: string) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

export function toFormData(object: any) {
  const formData = new FormData();
  for (const key in object) {
    if (object.hasOwnProperty(key)) {

      if (Array.isArray(object[key])) {
        object[key].forEach((value, index) => {
          if (value instanceof File) {
            formData.append(`${key}[${index}]`, value); // Agrega cada valor del array con la clave en formato 'key[]'
          }
        });
      } else {
        formData.append(key, object[key]);
      }

    }
  }
  return formData;
}

export const dtoToObject = <T>(dto: any) => {
  return { ...dto } as T;
}

export function numeroACadena(numero: number): string {
  // Convertir el número a base 36 (usando caracteres 0-9 y a-z)
  const cadena = numero.toString(36);
  // Si necesitas un prefijo, añádelo manualmente
  return `tercero-natural-detalles-${cadena}`; // Prefijo manual
}

// Función para convertir una cadena de texto larga de vuelta a un número
export function cadenaANumero(cadena: string): number {
  // Eliminar el prefijo 'tercero-natural-detalles-' si lo añadiste
  const limpia = cadena.replace(/^tercero-natural-detalles-/, '');
  // Convertir de base 36 a número
  return parseInt(limpia, 36);
}
