<template>
  <div class="row justify-between">
    <div>
      <h5 class="text-weight-bold q-ma-none">{{ title }}</h5>
      <div class="circle-full"></div>
    </div>
    <q-btn flat color="text-more" label="Ver Todos" />
    <!-- <div class="text-more">
      Ver Todos
    </div> -->
  </div>
</template>

<script setup>
defineOptions({
  name: 'base-section'
})

const props = defineProps({
  title: String,
})
</script>

<style>
.circle-full {
  height: 15px;
  width: 15px;
  border-radius: 10px;
  background-color: #389ed0;
}

.text-more {
  color: #c5cfe0;
}

.q-btn__content {
  text-transform: capitalize !important;
}
</style>
