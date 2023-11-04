<template>
  <q-layout view="hHh Lpr lff" class="">
    <q-header elevated :class="$q.dark.isActive ? 'bg-primary' : 'bg-primary'">
      <q-toolbar>
        <q-btn flat @click="drawer = !drawer" round dense icon="menu" />
        <q-toolbar-title>Header</q-toolbar-title>
        <SwitchDarkMode></SwitchDarkMode>
        <NabvarUser></NabvarUser>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="drawer"
      show-if-above
      :mini="miniState"
      @mouseover="miniState = false"
      @mouseout="miniState = true"
      :width="200"
      :breakpoint="500"
      bordered
      :class="$q.dark.isActive ? 'bg-grey-9' : 'bg-grey-3'"
    >
      <q-scroll-area class="fit" :horizontal-thumb-style="{ opacity: 0 }">
        <q-list  padding>
          <q-item
            :to="{ name: 'Dash' }"
            :active="link === 'Dash'"
            @click="link = 'Dash'"
            clickable
            v-ripple

            class="q-ma-xs rounded-borders"
            active-class="my-menu-link"
          >
            <q-item-section avatar>
              <q-icon name="home" />
            </q-item-section>

            <q-item-section> Inicio </q-item-section>
          </q-item>
          <q-separator />
          <q-item
            :to="{ name: 'Permisos' }"
            :active="link === 'Permisos'"
            @click="link = 'Permisos'"
            clickable
            v-ripple
            class="q-ma-xs rounded-borders"
            active-class="my-menu-link"
          >
            <q-item-section avatar>
              <q-icon name="mdi-key" />
            </q-item-section>

            <q-item-section> Permisos </q-item-section>
          </q-item>
          <q-item
            :to="{ name: 'Roles' }"
            :active="link === 'Roles'"
            @click="link = 'Roles'"
            clickable
            v-ripple
            class="q-ma-xs rounded-borders"
            active-class="my-menu-link"
          >
            <q-item-section avatar>
              <q-icon name="mdi-account-key" />
            </q-item-section>

            <q-item-section> Roles </q-item-section>
          </q-item>

          <q-item
            :to="{ name: 'Usuarios' }"
            :active="link === 'Usuarios'"
            @click="link = 'Usuarios'"
            clickable
            v-ripple
            class="q-ma-xs rounded-borders"
            active-class="my-menu-link"
          >
            <q-item-section avatar>
              <q-icon name="mdi-account" />
            </q-item-section>

            <q-item-section> Usuarios </q-item-section>
          </q-item>

          <q-separator />

          <q-item clickable v-ripple>
            <q-item-section avatar>
              <q-icon name="drafts" />
            </q-item-section>

            <q-item-section> Drafts </q-item-section>
          </q-item>
        </q-list>
      </q-scroll-area>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { onMounted, ref } from "vue";
import SwitchDarkMode from "components/SwitchDarkMode.vue";
import NabvarUser from "components/NabvarUser.vue";
import { useRoute } from "vue-router";
import { format } from "quasar";

const drawer = ref(false);
const miniState = ref(true);
const route = useRoute();
const link = ref(route.name);
</script>
<style lang="sass">
.my-menu-link
  color: white
  background: $primary
</style>
