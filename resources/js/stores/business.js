import { defineStore } from 'pinia'
import { useUserManagementStore } from './user-management'

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
    async updateUser(payload) {
      return axios.post('/api/v1/business/user/update', payload)
        .then((response) => {
          // this.business = response.data.data
          return response
        })
        .catch((error) => {
          // this.business = null
          throw error
        })
    },
    async disableUser(payload) {
      const userManagementStore = useUserManagementStore();

      return axios.post('/api/v1/business/user/disable', payload)
        .then((response) => {
          let user = response.data.data
          let status = user.status
          userManagementStore.setStatus(status, payload.id)
          return response
        })
        .catch((error) => {
          // this.business = null
          throw error
        })
    },
    async enableUser(payload) {
      const userManagementStore = useUserManagementStore();

      return axios.post('/api/v1/business/user/enable', payload)
        .then((response) => {
          let user = response.data.data
          let status = user.status
          userManagementStore.setStatus(status, payload.id)
          return response
        })
        .catch((error) => {
          // this.business = null
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
