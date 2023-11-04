import { boot, route } from "quasar/wrappers";
import { Cookies } from "quasar";
import { useUserStore } from "src/stores/user-store";
// "async" is optional;
// more info on params: https://v2.quasar.dev/quasar-cli/boot-files
export default boot(({ router }) => {
  // something to do
  router.beforeEach(permisosGuard);
});

const permisosGuard = async (to, from) => {
  if (
    to.matched.some((record) => record.meta.permiso) &&
    to.path != from.path
  ) {
    if (Cookies.get("token") === null && to.path !== "/login") {
      return { path: "/login", query: { redirectTo: to.fullPath } };
    }
    const userStore = useUserStore();
    await userStore.getUser();
    const requiredPermission = to.meta.permiso;
    console.log(requiredPermission);
    if (!userStore.hasPermission(requiredPermission)) {
      // Redirige o muestra un mensaje de error
      // return next("/acceso-denegado");
      return {
        path: "/unauthorized",
        query: {
          page: to.path,
          permission: to.meta.permiso,
        },
      };
      // next({
      //   path: "/unauthorized",
      //   query: {
      //     page: to.path,
      //     permission: to.meta.permiso,
      //   },
      // });
    }
  }
};
