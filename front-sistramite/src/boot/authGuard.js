import { boot } from 'quasar/wrappers'
import { Cookies } from 'quasar'
import { useUserStore } from "src/stores/user-store";
export default boot(({ router, store }) => {
  router.beforeEach(authGuard)
})

const authGuard = (to) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (Cookies.get('token') === null && to.path !== '/login') {
      return {path: '/login', query: {redirectTo: to.fullPath}};
    }
  }
}
