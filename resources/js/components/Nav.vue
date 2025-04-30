<template>
  <v-sheet color="#0d1117" elevation="3" rounded="lg">
    <v-tabs
      v-model="tab"
      :items="tabs"
      align-tabs="center"
      color="white"
      height="60"
      slider-color="#f78166"
    >
      <template v-slot:tab="{ item }">
        <v-tab
          :prepend-icon="item.icon"
          :text="item.text"
          :value="item.value"
          :to="item.link"
          class="text-none"
        ></v-tab>
      </template>
    </v-tabs>
  </v-sheet>
</template>

<script setup>
  import { shallowRef } from 'vue';

  const tab = shallowRef('tab-1');
  const tabs = [
    {
      icon: '',
      text: 'Home',
      value: 'tab-1',
      link: '/',
    },
    {
      icon: '',
      text: 'Users',
      value: 'tab-2',
      link: '/users',
    },
    {
      icon: '',
      text: 'About',
      value: 'tab-3',
      link: '/about',
    },
  ];
</script>
