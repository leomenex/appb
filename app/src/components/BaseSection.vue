<template>
  <div class="q-my-md">
    <div class="row justify-between q-my-md">
      <div>
        <h5 class="text-weight-bold q-ma-none">{{ title }}</h5>
        <Circle />
      </div>
      <q-btn flat color="text-more" label="Ver Todos" />
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
.text-more {
  color: #c5cfe0 !important;
}

.q-btn__content {
  text-transform: capitalize !important;
}
</style>
