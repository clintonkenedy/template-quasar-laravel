<template>
  <q-btn round color="">
      <q-avatar
      :color="$q.dark.isActive ? 'white' : 'white'"
      :text-color="$q.dark.isActive ? 'primary' : 'primary'"
    >
      {{ initialsMayus }}
    </q-avatar>
    <q-avatar
      size="15px"
      class="overlapping"
      :style="`left: 30px; top:25px`"
      icon="expand_more"
      :color="$q.dark.isActive ? 'white' : 'white'"
      :text-color="$q.dark.isActive ? 'primary' : 'primary'"
    >
    </q-avatar>

    <q-menu transition-show="jump-down" transition-hide="jump-up" style="min-width: 250px;">
      <div class="q-pa-md bg-dark">
        <div class="row items-center justify-center" style="width: 100%;">
          <q-avatar :color="$q.dark.isActive ? 'white' : 'white'" :text-color="$q.dark.isActive ? 'dark' : 'dark'">
            {{ initialsMayus }}
          </q-avatar>
        </div>
        <div class="text-center text-subtitle1 text-white q-mb-xs">
          {{ name }}
        </div>
      </div>

      <q-separator />

      <q-list dense style="min-width: 250px">
        <q-item v-if="userStore.roles[0] === 'Administrador'" clickable v-close-popup @click="editar(userStore.getId)">
          <q-item-section class="text-blue text-weight-medium text-center">Editar</q-item-section>
        </q-item>
        <q-separator />
        <q-item clickable v-close-popup @click="logout()">
          <q-item-section class="text-red text-weight-medium text-center">Cerrar Sesión</q-item-section>
        </q-item>
      </q-list>
    </q-menu>
  </q-btn>
  <!-- <UsuariosForm :perfil="true" ref="usuariosformRef" @save="save()"></UsuariosForm> -->
</template>

<script setup>
import { useUserStore } from "src/stores/user-store";
import { onMounted } from "vue";
import { ref } from "vue";
import { computed } from "vue";
import { useRouter } from "vue-router";
// import UsuarioService from "src/services/UsuarioService";

// import UsuariosForm from "pages/Admin/usuarios/UsuariosForm.vue";
import { useQuasar } from "quasar";
const $q = useQuasar();
const usuariosformRef = ref();
const nombre = ref(null);
const userStore = useUserStore();
const router = useRouter();
const name = ref("");
const initialsMayus = computed(() => {
  // Divide la frase por espacios en palabras
  const words = name.value.split(" ");

  // Obtiene la primera letra de cada palabra y la convierte a mayúscula
  const initials = words.map((word) => word.charAt(0).toUpperCase());

  // Une las iniciales para formar la frase final

  return initials.join("");
  // console.log(userStore.getName);
  // return name.value;
});
onMounted(async () => {
  await userStore.getUser();
  name.value = userStore.getName;
});
const logout = async () => {
  await userStore.logout();
  router.push({ name: "Login" });
};

async function editar(id) {
  usuariosformRef.value.show = true;
  const row = await UsuarioService.get(id);
  usuariosformRef.value.setValue(row);
}
async function save() {
  usuariosformRef.value.loading = true;

  try {
    nombre.value = await UsuarioService.save(usuariosformRef.value.form);
    usuariosformRef.value.loading = false;
    usuariosformRef.value.show = false;
    // tableRef.value.requestServerInteraction();
    $q.notify({
      type: "positive",
      message: "Guardado con Exito.",
      position: "top-right",
      progress: true,
      timeout: 1000,
    });
    name.value = nombre.value.name;
  } catch (e) {
    console.log(e.response.data.errors);
    usuariosformRef.value.errors = e.response.data.errors;
    usuariosformRef.value.loading = false;
  }
}
</script>

<style lang="sass" scoped>
.overlapping
  position: absolute
</style>
