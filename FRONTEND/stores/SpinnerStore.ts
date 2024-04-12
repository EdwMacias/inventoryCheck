import { defineStore } from 'pinia'

export const SpinnerStore = defineStore({
  id: 'SpinnerStore',
  state: () => ({
    status: false
  }),
  actions: {
    activeOrInactiveSpinner(active: boolean) {
      this.status = active
    }
  }
})
