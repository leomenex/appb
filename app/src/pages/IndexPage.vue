<script setup>
import BaseSection from 'src/components/BaseSection.vue';
import CardNews from './News/components/CardNews.vue';
import Profile from 'src/components/BaseProfile.vue';

defineOptions({
  name: 'IndexPage'
});

const news = [
  {
    title: 'MAIO AMARELO - Blitz Educativa leva mensagem por um trânsito',
    category: {
      name: 'Trânsito',
      color: 'yellow',
    }
  },
  {
    title: 'COMUNICADO Mirant Edileusa Lós tem novo horário de funcionamento',
    category: {
      name: 'Esporte',
      color: 'purple',
    }
  },
  {
    title: 'COMUNICADO Mirant Edileusa Lós tem novo horário de funcionamento',
    category: {
      name: 'Artes',
      color: 'green',
    }
  },
]
</script>

<template>
  <q-page>
    <Profile />

    <BaseSection title="Acesso Rápido">
      <q-virtual-scroll :items="news" virtual-scroll-horizontal v-slot="{ item, index }" style="height: 230px;"
        class="q-gutter items-center">
        <CardNews :news="item" :key="index"></CardNews>
      </q-virtual-scroll>
    </BaseSection>

    <BaseSection title="Notícias">
      <q-virtual-scroll :items="news" virtual-scroll-horizontal v-slot="{ item, index }" style="height: 230px;"
        class="q-gutter items-center">
        <CardNews :news="item" :key="index"></CardNews>
      </q-virtual-scroll>
    </BaseSection>
  </q-page>
</template>
