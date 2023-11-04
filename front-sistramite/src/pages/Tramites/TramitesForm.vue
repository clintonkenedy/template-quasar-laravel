<template>
  <q-page padding>
    <!-- content -->
    <q-card class="my-card">
      <q-card-section class="bg-primary text-white">
        <div class="text-h6">Our Changing Planet</div>
        <div class="text-subtitle2">by John Doe</div>
      </q-card-section>
      <q-form @submit.prevent="submit" class="q-pa-md">
        <q-input
          standout="bg-primary text-white"
          v-model="form.codigo"
          :loading="form.validating"
          label="Codigo *"
          @change="form.validate('codigo')"
          :error="form.invalid('codigo')"
          :class="form.invalid('codigo') ? 'q-mb-sm' : ''"
        >
          <template v-slot:error>
            <div>
              {{ form.errors.codigo }}
            </div>
          </template>
        </q-input>
        <q-input
          standout="bg-primary text-white "
          v-model="form.descripcion"
          label="descripcion *"
          @change="form.validate('descripcion')"
          :error="form.invalid('descripcion')"
          :class="form.invalid('descripcion') ? 'q-mb-sm' : ''"
        >
          <template v-slot:error>
            <div>
              {{ form.errors.descripcion }}
            </div>
          </template>
        </q-input>
        <div>
          <q-btn
            label="Submit"
            :loading="form.processing"
            type="submit"
            color="primary"
          />
          <q-btn
            label="Reset"
            type="reset"
            color="primary"
            flat
            class="q-ml-sm"
          />
        </div>
      </q-form>
      <transition
        appear
        v-if="form.invalid('codigo')"
        enter-active-class="animated swing"
        leave-active-class="animated swing"
      >
        <!-- Wrapping only one DOM element, defined by QBtn -->
        <q-btn color="secondary" icon="mail" label="Email" />
      </transition>

      <q-card-section>
        <div class="text-h6">Our Changing Planet</div>
        <div class="text-subtitle2">by John Doe</div>
      </q-card-section>

      <q-separator />

      <q-card-actions align="right">
        <q-btn flat>Action 1</q-btn>
        <q-btn flat>Action 2</q-btn>
      </q-card-actions>
    </q-card>
  </q-page>
</template>

<script setup>
import { useForm } from "laravel-precognition-vue";

const form = useForm("post", "http://sis-tramite.test/api/folios", {
  codigo: "",
  descripcion: "",
});

const submit = () => form.submit();
</script>
<style scoped>
p {
  font-size: 12px;
  line-height: 1;
}
</style>
