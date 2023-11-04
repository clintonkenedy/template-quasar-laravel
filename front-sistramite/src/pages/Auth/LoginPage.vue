<template>
  <q-page padding class="row justify-center">
    <div class="col-12 col-sm-6 col-md-4 col-lg-2 self-center text-center">
      <img
        alt="Quasar logo"
        src="https://cdn.quasar.dev/logo-v2/svg/logo.svg"
        style="width: 50px; height: 50px"
        class="q-mb-md"
      />
      <h4 class="q-my-none">Login</h4>
      <LoginForm @logued="onLogued"></LoginForm>
    </div>
  </q-page>
</template>

<script setup>
import LoginForm from "pages/Auth/LoginForm.vue";
import { useRouter } from "vue-router";

const router = useRouter();
import { ref } from "vue";

const lorem = ref(
  "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
);

const onLogued = (e) => {
  router.push({ name: "Dash" });
};
</script>
<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 400px

.responsive
  display: flex
  justify-content: center
  align-items: center
</style>
