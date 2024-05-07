import { defineStore } from 'pinia'

interface PasswordStore {
  email?: string,
  code?: number
}

export const useRecoveryPasswordStore = defineStore({
  id: 'RecoveryPasswordStore',
  state: (): PasswordStore => ({
  }),
  actions: {
    setEmail(email: string) {
      this.email = email;
    },
    setCode(code: number) {
      this.code = code
    }
  }
})
