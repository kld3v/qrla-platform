<template>
  <div>
    <h1>Venues</h1>
    <div>
      <p>Total Venues: {{ row2Data.total_venues }}</p>
      <p>Total Plaques: {{ row2Data.total_plaques }}</p>
      <p>Total Visits: {{ row2Data.total_visits }}</p>
    </div>
    <ul>
      <li v-for="venue in venues" :key="venue.id">
        <h2>{{ venue.name }}</h2>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

const { props } = usePage();

const venues = ref(props.value.venues);
const row2Data = ref(props.value.row_2_data);
</script>
