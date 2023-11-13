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
            <q-icon name="mdi-account-key" />
          </template>
          <template v-slot:error>
            <div>
              {{ form.errors.name }}
            </div>
          </template>
        </q-input>

        <div class="q-gutter-y-sm column">
          <q-list bordered separator>
            <template v-for="(p, i) in permisos" :key="i">
              <q-item clickable v-ripple>
                <q-item-section>
                  <q-toggle
                    keep-color
                    v-model="form.permisosSelected"
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
import PermisoService from "src/services/PermisoService";
const permisos = ref([]);
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
  form = useForm("put", "api/roles/" + props.id, {
    id: "",
    name: "",
    permisosSelected: [],
  });
} else {
  form = useForm("post", "api/roles/", {
    id: "",
    name: "",
    permisosSelected: [],
  });
}
async function cargar() {
  const { data } = await PermisoService.getData({
    params: { rowsPerPage: 0, order_by: "id" },
  });
  permisos.value = data;
  console.log(permisos.value);
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
