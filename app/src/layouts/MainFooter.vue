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
  <q-footer bordered class="footer">
    <div class="container">
      <div class="item yellow"></div>
      <div class="item orange"></div>
      <div class="item blue"></div>
      <div class="item blue2"></div>
      <div class="item green"></div>
      <div class="item green2"></div>
    </div>

    <q-tabs v-model="tab" dense style="border-radius: 10px 10px 0 0;" class="bg-white">
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
  font-size: 10px;
  text-transform: capitalize;
}

.yellow {
  background-color: #f8d006;
}

.orange {
  background-color: #f19021;
}

.blue {
  background-color: #04a9e9;
}

.blue2 {
  background-color: #0487cc;
}

.green {
  background-color: #7fbe42;
}

.green2 {
  background-color: #10ae4c;
}

.container {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  grid-template-rows: 8px;
}

.item {
  height: 100%;
  width: 100%;
}

.footer {
  border: 0;
  background-image: linear-gradient(90deg, #f8d006, #10ae4c) !important;
}
</style>
