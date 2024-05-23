<template>
  <div class="q-my-md">
    <div class="row justify-between q-my-md">
      <div>
        <h6 class="text-weight-bold q-ma-none text-subtitle1">{{ title }}</h6>
        <Circle />
      </div>
      <q-btn flat color="text-secondary" label="Ver Todos" />
    </div>
    <slot></slot>
  </div>
</template>

<script setup>
import Circle from './BaseCircle.vue'

defineOptions({
  name: 'base-section'
})

const props = defineProps({
  title: String,
})
</script>

<style>
.q-btn__content {
  text-transform: capitalize !important;
}
</style>
