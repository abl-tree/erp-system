import { defineStore } from 'pinia'

export const useBusinessStore = defineStore('business', {
  state: () => ({
    business: null,
    users: [],
    types: [],
    features: [],
  }),
  actions: {
    set_business(business) {
      this.business = business
    },
    async createBusiness(payload) {
      return axios.post('/api/v1/business/create', payload)
        .then((response) => {
          this.business = response.data.data
          return response
        })
        .catch((error) => {
          this.business = null
          throw error
        })
    },
    async createUser(payload) {
      return axios.post('/api/v1/business/user/create', payload)
        .then((response) => {
          this.business = response.data.data
          return response
        })
        .catch((error) => {
          this.business = null
          throw error
        })
    },
    async getTypes() {
      return axios.get('/api/v1/business/types')
        .then((response) => {
          this.types = response.data.data
          return response
        })
        .catch((error) => {
          this.types = []
          throw error
        })
    },
    async getUsers() {
      return axios.get('/api/v1/business/users')
        .then((response) => {
          this.users = response.data.data
          return response
        })
        .catch((error) => {
          this.users = []
          throw error
        })
    },
  },
  getters: {
    currentBusiness: (state) => state.business,
    types: (state) => state.types,
    features: (state) => state.features,
  },
})
