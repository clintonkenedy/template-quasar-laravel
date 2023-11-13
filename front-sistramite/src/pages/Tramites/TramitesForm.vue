<template>
  <q-btn @click="card = true">click</q-btn>
  <q-dialog v-model="card">
    <!-- <q-page padding> -->
      <!-- content -->
      <q-card class="my-card">
        <!-- <q-card-section class="bg-primary text-white">
          <div class="text-h6">Our Changing Planet</div>
          <div class="text-subtitle2">by John Doe</div>
        </q-card-section> -->
        <q-form @submit.prevent="submit" class="q-pa-md">
          <q-input
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
            outlined
            v-model="form.email"
            label="Email *"
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
            outlined
            v-model="form.password"
            label="Constraseña *"
            @change="form.validate('password')"
            :error="form.invalid('password')"
            :class="form.invalid('password') ? 'q-mb-sm' : ''"
          >
            <template v-slot:prepend>
              <q-icon name="lock" />
            </template>
            <template v-slot:error>
              <div>
                {{ form.errors.password }}
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

<!--
        <q-card-section>
          <div class="text-h6">Our Changing Planet</div>
          <div class="text-subtitle2">by John Doe</div>
        </q-card-section>

        <q-separator />

        <q-card-actions align="right">
          <q-btn flat>Action 1</q-btn>
          <q-btn flat>Action 2</q-btn>
        </q-card-actions> -->
      </q-card>
    <!-- </q-page> -->
  </q-dialog>
</template>

<script setup>
import { useForm } from "laravel-precognition-vue";
import { ref } from "vue";

const card = ref(false);
const form = useForm("post", "api/usuarios", {
  name: "",
  email: "",
  password: "",
});

const submit = () => form.submit();
</script>
<style scoped>
/* p {
  font-size: 12px;
  line-height: 1;
} */
</style>
