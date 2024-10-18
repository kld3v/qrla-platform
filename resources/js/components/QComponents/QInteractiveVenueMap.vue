<template>
  <div class="svg-wrapper">
    <div v-html="svgContent" ref="svgContainer"></div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue';

// Props - SVG URL will be passed as a prop
const props = defineProps({
  svgUrl: {
    type: String,
    required: true,
  },
});

// References for reactive data and DOM elements
const svgContent = ref(''); // SVG content will be stored here
const svgContainer = ref(null); // Reference to the SVG container div

// Function to load the SVG file from the provided URL
const loadSvgFile = async () => {
  try {
    const response = await fetch(props.svgUrl);
    const svg = await response.text();
    svgContent.value = svg;
    // Ensure SVG is rendered before manipulating the DOM
    nextTick(() => {
      addPolygonHoverEffects();
    });
  } catch (error) {
    console.error('Error loading SVG:', error);
  }
};

// Function to add hover effects to the polygons
const addPolygonHoverEffects = () => {
  const polygons = svgContainer.value.querySelectorAll('polygon');
  polygons.forEach((polygon) => {
    polygon.addEventListener('mouseover', () => {
      polygon.style.fill = '#034694'; // Highlight color on hover
    });
    polygon.addEventListener('mouseout', () => {
      polygon.style.fill = ''; // Revert to original color on mouse out
    });
  });
};

// Load the SVG file when the component is mounted
onMounted(() => {
  loadSvgFile();
});
</script>

<style scoped>
svg {
  width: 100%;
  height: auto;
}
</style>
