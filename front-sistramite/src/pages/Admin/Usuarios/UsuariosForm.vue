<template>
  <!-- content -->
  <q-card class="my-card">
    <q-card-section class="bg-primary text-white">
      <div class="text-h6">{{ title }}</div>
      <!-- <div class="text-subtitle2">Usuario</div> -->
    </q-card-section>
    <q-form @submit.prevent="submit">
      <q-card-section class="q-pa-md">
        <q-input
          dense
          outlined
          v-model="form.name"
          :loading="form.validating"
          label="Nombre *"
          @change="form.validate('name')"
          :error="form.invalid('name')"
          :class="form.invalid('name') ? 'q-mb-sm' : ''"
          ><template v-slot:prepend>
            <q-icon name="mdi-account" />
          </template>
          <template v-slot:error>
            <div>
              {{ form.errors.name }}
            </div>
          </template>
        </q-input>
        <q-input
          dense
          outlined
          v-model="form.email"
          label="Email *"
          type="email"
          @change="form.validate('email')"
          :error="form.invalid('email')"
          :class="form.invalid('email') ? 'q-mb-sm' : ''"
        >
          <template v-slot:prepend>
            <q-icon name="mail" />
          </template>
          <template v-slot:error>
            <div>
              {{ form.errors.email }}
            </div>
          </template>
        </q-input>
        <q-input
          dense
          outlined
          v-model="form.password"
          :type="isPwd ? 'password' : 'text'"
          label="Constraseña *"
          @change="form.validate('password')"
          :error="form.invalid('password')"
          :class="form.invalid('password') ? 'q-mb-sm' : ''"
        >
          <template v-slot:append>
            <q-icon
              :name="isPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwd = !isPwd"
            />
          </template>
          <template v-slot:prepend>
            <q-icon name="lock" />
          </template>
          <template v-slot:error>
            <div>
              {{ form.errors.password }}
            </div>
          </template>
        </q-input>
        <div class="q-gutter-y-sm column">
          <q-list bordered separator>
            <template v-for="(p, i) in roles" :key="i">
              <q-item clickable v-ripple>
                <q-item-section>
                  <q-toggle
                    keep-color
                    v-model="form.rolesSelected"
                    :label="`${p.name}`"
                    color="secondary"
                    :val="p.id"
                    hide-details
                  >
                  </q-toggle
                ></q-item-section>
              </q-item>
            </template>
          </q-list>
        </div>

      </q-card-section>
      <q-separator />

      <q-card-actions align="right">
        <q-btn label="Cancelar" flat v-close-popup></q-btn>
        <q-btn
          label="Guardar"
          :loading="form.processing"
          type="submit"
          color="positive"
        ></q-btn>
      </q-card-actions>
    </q-form>
  </q-card>
</template>

<script setup>
import { useForm } from "laravel-precognition-vue";
import { onMounted, ref } from "vue";
import RoleService from "src/services/RoleService"
const isPwd = ref(true);
const roles = ref([]);
const emits = defineEmits(["save"]);
const props = defineProps({
  title: String,
  id: Number,
  edit: {
    type: Boolean,
    default: false,
  },
});

let form;
if (props.edit) {
  form = useForm("put", "api/usuarios/" + props.id, {
    id: "",
    name: "",
    email: "",
    password: "",
    rolesSelected: [],
  });
} else {
  form = useForm("post", "api/usuarios/", {
    id: "",
    name: "",
    email: "",
    password: "",
    rolesSelected: [],
  });
}
async function cargar() {
  const { data } = await RoleService.getData({
    params: { rowsPerPage: 0, order_by: "id" },
  });
  roles.value = data;
  console.log(roles.value);
}


const submit = () => {
  if (form.password === "") {
    // Si la contraseña está vacía, eliminar el campo de contraseña del objeto de solicitud
    delete form.password;
  }
  form
    .submit()
    .then((response) => {
      form.reset();
      // form.setData()

      emits("save");
    })
    .catch((error) => {
      // alert("An error occurred.");
    });
};

onMounted(() => {
  // setData();
  console.log(props.edit);
  cargar();
  // console.log(form);
});

defineExpose({
  // setData,
  form,
});
</script>
<style lang="sass" scoped>
p
  font-size: 12px
  line-height: 1

.my-card
  width: 100%
  max-width: 80vw
</style>
