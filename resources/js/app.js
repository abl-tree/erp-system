import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { useAuthStore } from '@/stores/auth';
import router from '@/router';
import App from '@/layouts/App.vue';
import '../css/app.css';
import axios from 'axios';

// Object to hold active requests and their controllers
let activeRequests = {};

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Content-Type'] = 'application/json';
window.axios.defaults.headers.common['Accept'] = 'application/json';
window.axios.defaults.withCredentials = true;
window.axios.defaults.withXSRFToken = true;

// Function to generate a unique key for each request
const generateRequestKey = (method, url, data = {}) => {
  // Generate a unique key based on the request URL, method, and data
  return `${method}:${url}:${JSON.stringify(data)}`;
};

// Add request interceptor to manage cancellation of the same requests
axios.interceptors.request.use(
  (config) => {
    // Generate a unique key for the request
    const requestKey = generateRequestKey(config.method, config.url, config.data);

    // If there's already an active request with the same key, cancel it
    if (activeRequests[requestKey]) {
      activeRequests[requestKey].abort(); // Cancel the previous request
      console.log(`Canceled previous request: ${requestKey}`);
    }

    // Create a new AbortController for the current request
    const controller = new AbortController();
    config.signal = controller.signal;

    // Store the controller in activeRequests object using the requestKey
    activeRequests[requestKey] = controller;

    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Optionally, you can add a response interceptor to clean up the request controller
axios.interceptors.response.use(
  (response) => {
    const requestKey = generateRequestKey(response.config.method, response.config.url, response.config.data);
    // Cleanup the controller after the request finishes
    delete activeRequests[requestKey];
    return response;
  },
  (error) => {
    // In case of error, cleanup the controller too
    if (error.config) {
      const requestKey = generateRequestKey(error.config.method, error.config.url, error.config.data);
      delete activeRequests[requestKey];
    }
    return Promise.reject(error);
  }
);


const pinia = createPinia()
const app = createApp(App)
  .use(pinia)

const userStore = useAuthStore()
userStore.attempt_user()
  .catch((error) => {
    console.log('Please login.')
  })
  .finally(() => {
    app.use(router)
      .mount('#app');
  })
