import { defineStore } from 'pinia'

export const DatatableStore = defineStore({
  id: 'DatatableStore',
  state: (): { dt: any, reload: any } => ({
    dt: undefined,
    reload: undefined
  }),
  actions: {
    setDt(dt: any) {
      this.dt = dt
    }
  },

})
