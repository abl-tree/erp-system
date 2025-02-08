import { defineStore } from 'pinia'
import axios from 'axios'

const allowedActions = {'view': 'View', 'edit': 'Edit', 'delete': 'Delete', 'disabled': 'Mark as Disabled'}

export const useUserManagementStore = defineStore('userManagement', {
  state: () => ({
    users: [],
    pagination: {},
    user: {},
    edit: {},
    action: null,
  }),
  actions: {
    setUser(user, action = null) {
      user = user || {}
      this.action = allowedActions[action] ?? null
      this.user = {
        id: user.id,
        firstname: user.firstname,
        lastname: user.lastname,
        email: user.email,
        phone: user.phone_number,
        street: user.profile?.address,
        postal_code: user.profile?.postal_code,
        country: user.profile?.country,
        city: user.profile?.city,
        business_type: user.profile?.business_type?.id ?? null,
        role: user.roles ? user.roles[0]?.pivot?.role_id : null,
        job_position: user.employee_profile?.job_position,
        department: user.employee_profile?.department_id,
        employment_type: user.employee_profile?.employment_type_id,
        special_notes: user.employee_profile?.special_notes,
        start_date: user.employee_profile?.hired_at ? user.employee_profile?.hired_at : '',
        attendance_shift: user.employee_profile?.attendance_shift_id
      }
      
    },
    setEdit(edit) {
      this.edit = edit
    },
    async getUsers(page, limit, filter) {
      return axios.get('api/v1/business/users', {
          params: {
              'per_page': limit,
              'page': page,
              'filter': filter
          }
      })
      .then((response) => {
        let result = response.data.data
        
        this.users = result.data
        this.pagination = {
          current_page: result.current_page,
          last_page: result.last_page,
          per_page: result.per_page,
          total: result.total,
          from: result.from,
          to: result.to,
          prev_page_url: result.prev_page_url,
          next_page_url: result.next_page_url,
        }
        return response
      })
      .catch((error) => {
        this.users = []
        this.pagination = {}
        throw error
      })
    },
  },
})
