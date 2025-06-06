import { createRouter, createWebHistory } from "vue-router"
import { useAuthStore } from '@/stores/auth.js'

import NotFound from '@/pages/NotFound.vue'
import Guest from '@/layouts/Guest.vue'
import Register from '@/pages/auth/Register.vue'
import Login from '@/pages/auth/Login.vue'
import TwoFactorChallenge from '@/pages/auth/TwoFactorChallenge.vue'
import ForgotPassword from '@/pages/auth/ForgotPassword.vue'
import ResetPassword from '@/pages/auth/ResetPassword.vue'
import VerifyEmail from '@/pages/auth/VerifyEmail.vue'

import Authenticated from '@/layouts/Authenticated.vue'
import ConfirmPassword from '@/pages/auth/ConfirmPassword.vue'
import Home from '@/pages/Home.vue'
import User from '@/pages/User.vue'
import BusinessRegistration from '@/pages/BusinessRegistration.vue'
import UserManagement from '@/pages/UserManagement.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      component: Authenticated,
      meta: { requiresAuth: true, isVerified: true },
      children: [
        { path: "/", name: 'Home', component: Home },
        { path: "/user", name: 'User', component: User },
        { path: "/user-management", name: 'UserManagement', component: UserManagement },
        { path: "/confirm-password", name: 'ConfirmPassword', component: ConfirmPassword },
      ]
    },
    {
      path: '/',
      component: Authenticated,
      // meta: { requiresAuth: true, isVerified: false },
      children: [
        { path: "/verify-email", name: 'VerifyEmail', component: VerifyEmail },
      ]
    },
    {
      path: '/auth',
      redirect: "/login",
      component: Guest,
      meta: { isGuest: true },
      children: [
        { path: "/register", name: 'Register', component: Register },
        { path: "/login", name: 'Login', component: Login },
        { path: "/two-factor-challenge", name: 'TwoFactorChallenge', component: TwoFactorChallenge },
        { path: "/forgot-password", name: 'ForgotPassword', component: ForgotPassword },
        { path: "/reset-password/:token", name: 'ResetPassword', component: ResetPassword },
        { path: "/business-registration", name: 'BusinessRegistration', component: BusinessRegistration }
      ]
    },
    {
      path: '/:pathMatch(.*)*',
      name: '404',
      component: NotFound,
    }
  ],
});

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()

  if (to.meta.requiresAuth && !authStore.currentUser) {
    next({ name: "Login" })
  } else if (to.meta.isVerified && !authStore.currentUser.email_verified_at) {
      next({ name: "VerifyEmail" })
  } else if (!to.meta.isVerified && authStore.currentUser && authStore.currentUser.email_verified_at) {
    next({ name: "Home" })
  } else if (to.meta.isGuest && authStore.currentUser) {
    next({ name: "Home" })
  } else {
    next();
  }
});

export default router;
