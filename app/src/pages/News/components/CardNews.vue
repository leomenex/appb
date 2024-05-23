<script setup>
import Circle from 'src/components/BaseCircle.vue';

defineOptions({
  name: 'card-news'
})

const props = defineProps({
  news: Object
});

function getTitle(text = '') {
  const words = text.split(' ');

  const phrase = words.filter((item, i) => i <= 5).join(' ');

  return phrase + (words.length > 6 ? ' ...' : '');
}
</script>

<template>
  <q-card class="card-size q-ma-sm">
    <q-card-section style="width: 100;">
      <img src="https://cdn.quasar.dev/img/mountains.jpg" style="border-radius: 5px 5px 0 0; width: 100%;">

      <div class="text-weight-bold text-subtitle2">
        {{ getTitle(news.title) }}
      </div>

      <div class="text-body2 row items-center">
        <Circle :class="['q-mr-sm', `bg-${news.category.color}`]" />
        {{ news.category.name }}
      </div>
    </q-card-section>

  </q-card>
</template>

<style scoped>
.card-size {
  border-radius: 15px;
  height: 200px;
  width: 200px;
}
</style>
