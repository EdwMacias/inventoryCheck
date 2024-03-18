

export const setDataWithoutValid = async<T> (entity: any, value: string) => {
  return { ...entity, value, valid: true } as T;
}