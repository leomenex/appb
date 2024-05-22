<script setup>
import { ref } from 'vue';

const tab = ref(0);
const linksList = [
  {
    name: 'home',
    label: 'Início',
    icon: 'home',
    link: 'https://quasar.dev'
  },
  {
    name: 'service',
    label: 'Serviços',
    icon: 'support_agent',
    link: 'https://quasar.dev'
  },
  {
    name: 'courses',
    label: 'Cursos',
    icon: 'school',
    link: 'https://quasar.dev'
  },
  {
    name: 'profile',
    label: 'Perfil',
    icon: 'person',
    link: 'https://quasar.dev'
  },
]

</script>

<template>
  <q-footer bordered class="bg-blue ">
    <div style="height: 10px;"></div>

    <q-tabs v-model="tab" dense style="border-radius: 20px 20px 0 0;" class="bg-white">
      <q-tab v-for="(item, index) in linksList" :key="index" :name="item.name" :icon="item.icon" :label="item.label" />
    </q-tabs>
  </q-footer>
</template>

<style>
.q-tab--inactive {
  color: #c5cfe0;
}

.q-tab--active {
  color: #389ed0;
}

.q-tab__label {
  font-size: 15px;
  text-transform: capitalize;
}
</style>
