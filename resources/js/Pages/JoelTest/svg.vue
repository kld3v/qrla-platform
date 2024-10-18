<template>
  <div>
    <div v-html="svgContent" ref="svgContainer"></div>
  </div>
</template>

<script>
import { ref, onMounted, nextTick } from 'vue';

export default {
  props: {
    svgUrl: {
      type: String,
      required: true,
    },
  },
  setup(props) {
    const svgContent = ref(''); // SVG content will be stored here
    const svgContainer = ref(null); // Reference to the SVG container div

    // Function to load SVG file from the passed prop
    const loadSvgFile = async () => {
      try {
        const response = await fetch(props.svgUrl);
        const svg = await response.text();
        svgContent.value = svg;
        // Ensure SVG is rendered before manipulating DOM
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
          polygon.style.fill = '#A2F732'; // Highlight color on hover
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

    return {
      svgContent,
      svgContainer,
    };
  },
};
</script>

<style scoped>
.svg-wrapper {
  background-color: white; /* White background */
  padding: 20px;           /* Optional padding */
  min-height: 100vh;       /* Full height for the page */
}

svg {
  width: 100%;
  height: auto;
}
</style>