<template>
  <q-layout view="hHh lpR fFf">

    <q-page-container class="q-ma-md">
      <router-view />
    </q-page-container>
    <MainFooter></MainFooter>

  </q-layout>
</template>

<script setup>
import { ref } from 'vue'
import MainFooter from './MainFooter.vue';

defineOptions({
  name: 'MainLayout'
})

const leftDrawerOpen = ref(false)

function toggleLeftDrawer() {
  leftDrawerOpen.value = !leftDrawerOpen.value
}
</script>
