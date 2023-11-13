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
            <q-icon name="mdi-key" />
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
          v-model="form.description"
          label="Descripcion *"

          @change="form.validate('description')"
          :error="form.invalid('emadescriptionil')"
          :class="form.invalid('description') ? 'q-mb-sm' : ''"
        >
          <template v-slot:prepend>
            <q-icon name="description" />
          </template>
          <template v-slot:error>
            <div>
              {{ form.errors.description }}
            </div>
          </template>
        </q-input>
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
// import RoleService from "src/services/RoleService"
// const isPwd = ref(true);
// const roles = ref(false);
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
  form = useForm("put", "api/permisos/" + props.id, {
    id: "",
    name: "",
    description: "",
  });
} else {
  form = useForm("post", "api/permisos/", {
    id: "",
    name: "",
    description: "",
  });
}
// async function cargar() {
//   const { data } = await RoleService.getData({
//     params: { rowsPerPage: 0, order_by: "id" },
//   });
//   roles.value = data;
//   console.log(roles.value);
// }

const submit = () => {
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
  // cargar();
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
