<template>
  <!-- <div class="column" style="height: 150px">
    <div class="col-3 col-sm-6">.col-3 .col-sm-6</div>
    <div class="col-3 col-sm-6">.col-3 .col-sm-6</div>

    <div class="col-3 col-sm-6">.col-3 .col-sm-6</div>
    <div class="col-3 col-sm-6">.col-3 .col-sm-6</div>
  </div> -->
  <div class="q-pa-md">
    <q-form @submit="login" class="q-gutter-md">
      <q-input
        outlined
        v-model="formLogin.email"
        dense
        label="Email"
        hint="Email"
        lazy-rules
        :rules="[
          (val) => !!val || 'Este campo es requerido',
          (val) =>
            (val.includes('@') && val.includes('.')) ||
            'Ingrese un correo valido',
        ]"
      >
        <template v-slot:prepend>
          <q-icon name="email" />
        </template>
      </q-input>

      <q-input
        outlined
        :type="isPwd ? 'password' : 'text'"
        v-model="formLogin.password"
        dense
        label="Contraseña"
        hint="Contraseña"
        lazy-rules
        :rules="[
          (val) =>
            (val !== null && val !== '') || 'Ingrese una Constraseña valida',
        ]"
      >
        <template v-slot:prepend>
          <q-icon name="lock" />
        </template>
        <template v-slot:append>
          <q-icon
            :name="isPwd ? 'visibility_off' : 'visibility'"
            class="cursor-pointer"
            @click="isPwd = !isPwd"
          />
        </template>
      </q-input>

      <div>
        <q-btn
          label="Ingresar"
          class="full-width"
          type="submit"
          color="primary"
          
        />
      </div>
    </q-form>
  </div>
</template>

<script setup>
import { useQuasar } from "quasar";
import { ref } from "vue";
import { useUserStore } from "src/stores/user-store";
const $q = useQuasar();
const emits = defineEmits(["logued"]);
const userStore = useUserStore();
const progress = ref({ loading: false, portentage: 0 });
const alertText = ref(null);
const errorText = ref(null);
const formLogin = ref({
  email: "",
  password: "",
});
const isPwd = ref(true);

const login = async () => {
  progress.value.loading = true;

  try {
    const login = await userStore.login(
      formLogin.value.email,
      formLogin.value.password
    );
    await userStore.getUser();

    // console.log(login.data.user)
    // userStore.setUser(login.data.user)
    emits("logued");
    console.log("login...");
    alertText.value = "Redireccionando ...";
    progress.value.loading = false;
    $q.notify({
      position: "top",
      type: "positive",
      message: "Seccion Iniciada con Exito",
      timeout: 1000,
    });
  } catch (e) {
    if (e.response) {
      errorText.value = "Credenciales Inconrrectas";
      console.log(e.response);
      $q.notify({
        position: "top",
        type: "negative",
        message: "Credenciales Inconrrectas",
      });
    } else {
      console.log(e);
      errorText.value = "No hay Servidor";
      $q.notify({
        position: "top",
        type: "negative",
        message: "No hay Servidor",
      });
    }
    progress.value.loading = false;
  }

  // console.log(formLogin.value.email)
};
// export default {
//   setup() {
//     const $q = useQuasar();

//     const name = ref(null);
//     const age = ref(null);
//     const accept = ref(false);
//     const isPwd = ref(true)

//     return {
//       name,
//       age,
//       accept,

//       onSubmit() {
//         if (accept.value !== true) {
//           $q.notify({
//             color: "red-5",
//             textColor: "white",
//             icon: "warning",
//             message: "You need to accept the license and terms first",
//           });
//         } else {
//           $q.notify({
//             color: "green-4",
//             textColor: "white",
//             icon: "cloud_done",
//             message: "Submitted",
//           });
//         }
//       },

//       onReset() {
//         name.value = null;
//         age.value = null;
//         accept.value = false;
//       },
//     };
//   },
// };
</script>
<style lang="css" scoped>
.ga--light {
  /* ... */
  background-color: blue;
}

.ga--dark {
  /* ... */
  background-color: rgb(30, 255, 0);
}
</style>
