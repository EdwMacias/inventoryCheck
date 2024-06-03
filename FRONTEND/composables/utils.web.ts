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


export function useImagen() {
  // const fullSizeImageSrc = ref<string>('');
  // const showModal = ref<boolean>(false);

  const setImagen = (file: File, imagenRef: Ref<HTMLImageElement | null>): void => {
    const reader = new FileReader();
    reader.onload = (e) => {
      if (e.target && typeof e.target.result === 'string' && imagenRef.value) {
        imagenRef.value.src = e.target.result;
      }
    };
    reader.readAsDataURL(file);
  };

  
  // const openModal = (imagenRef :  Ref<HTMLImageElement | null>) => {
  //   if (imagenRef.value) {
  //     fullSizeImageSrc.value = imagenRef.value.src;
  //     showModal.value = true;
  //   }
  // };

  // const closeModal = () => {
  //   showModal.value = false;
  //   fullSizeImageSrc.value = '';
  // };

  return {
    // openModal,
    // closeModal,
    // fullSizeImageSrc,
    // showModal,
    setImagen
  };
}
