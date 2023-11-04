import { boot } from 'quasar/wrappers'
import axios from 'axios'
import { client } from 'laravel-precognition-vue';
import { Cookies } from 'quasar'

// Be careful when using SSR for cross-request state pollution
// due to creating a Singleton instance here;
// If any client changes this (global) instance, it might be a
// good idea to move this instance creation inside of the
// "export default () => {}" function below (which runs individually
// for each client)
const api = axios.create({ baseURL: import.meta.env.VITE_APP_API_URL })
api.interceptors.request.use(
  (config) => {
    const token = Cookies.get("token"); // Reemplaza con el token de autenticación que desees enviar
    if (token) {
      config.headers["Authorization"] = token;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);
client.use(api)
// const api = client;
// api.axios().defaults.baseURL=import.meta.env.VITE_APP_API_URL

export default boot(({ app }) => {
  // for use inside Vue files (Options API) through this.$axios and this.$api

  app.config.globalProperties.$axios = axios
  // ^ ^ ^ this will allow you to use this.$axios (for Vue Options API form)
  //       so you won't necessarily have to import axios in each vue file

  app.config.globalProperties.$api = api
  // ^ ^ ^ this will allow you to use this.$api (for Vue Options API form)
  //       so you can easily perform requests against your app's API
  // app.config.globalProperties.$client = client;
})

export { api }
