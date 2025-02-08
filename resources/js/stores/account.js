import { defineStore } from 'pinia'

export const useAccountStore = defineStore('account', {
  state: () => ({
    status: [],
    roles: [],
  }),
  actions: {
    set_user(status) {
      this.status = status
    },
    async getStatus() {
      return axios.get('/api/v1/account/status')
        .then((response) => {          
          this.status = response.data.data
          return response
        })
        .catch((error) => {
          this.status = []
          throw error
        })
    },
    async getRoles() {
      return axios.get('/api/v1/account/roles')
        .then((response) => {          
          this.roles = response.data.data
          return response
        })
        .catch((error) => {
          this.roles = []
          throw error
        })
    },
  },
  getters: {
    statusList: (state) => state.status,
    rolesList: (state) => state.roles,
  },
  persist: true,
})
