<template>
  <div class="svg-wrapper">
    <div v-html="svgContent" ref="svgContainer"></div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick, watch } from 'vue';

const props = defineProps({
  svgUrl: {
    type: String,
    required: true,
  },
  stands: {
    type: Array,
    required: true,
  },
 selectedBlock: {
    type: Object,
    required: false,
  },
});

const svgContent = ref('');
const svgContainer = ref(null);

const standColorMap = ref({});
const blockColorMap = ref({});

const assignStandColors = () => {
  const colors = ['#14E9E2', '#FFAE1F', '#ff6692', '#635BFF', '#ffffff', '#33FFF3'];
  props.stands.forEach((stand, index) => {
    standColorMap.value[stand.id] = colors[index % colors.length];
  });
};

const createBlockColorMap = () => {
  props.stands.forEach((stand) => {
    const color = standColorMap.value[stand.id];
    stand.blocks.forEach((block) => {
      const blockNameWithUnderscores = block.name.replace(/\s+/g, '_'); // Replace spaces with underscores
      blockColorMap.value[blockNameWithUnderscores] = color;
    });
  });
};

const loadSvgFile = async () => {
  try {
    const response = await fetch(props.svgUrl);
    const svg = await response.text();
    svgContent.value = svg;
    nextTick(() => {
      addPolygonHoverEffects();
    });
  } catch (error) {
    console.error('Error loading SVG:', error);
  }
};

const addPolygonHoverEffects = () => {
  const polygons = svgContainer.value.querySelectorAll('polygon');
  polygons.forEach((polygon) => {
    const polygonId = polygon.getAttribute('id');
    if (!polygonId) return;

    const polygonIdWithUnderscores = polygonId.replace(/\s+/g, '_'); // Replace spaces with underscores
    let fillColor = '';

    if (blockColorMap.value[polygonIdWithUnderscores]) {
      fillColor = blockColorMap.value[polygonIdWithUnderscores];
    } else {
      fillColor = '#CCCCCC'; // default color
    }

    // Check if this polygon is the selected block
    if (props.selectedBlock && props.selectedBlock.name.replace(/\s+/g, '_') === polygonIdWithUnderscores) {
      fillColor = '#A2F732'; // Highlight the selected block
    }

    polygon.style.fill = fillColor;

    const originalFill = fillColor; // Store the original fill color
    polygon.addEventListener('mouseover', () => {
      polygon.style.fill = '#A2F732'; // highlight color on hover
    });
    polygon.addEventListener('mouseout', () => {
      polygon.style.fill = originalFill; // reset to original fill color
    });
  });
};


onMounted(() => {
  assignStandColors();
  createBlockColorMap();
  loadSvgFile();
});

watch(
  () => props.selectedBlock,
  () => {
    // Reapply hover effects when the selected block changes
    nextTick(() => {
      addPolygonHoverEffects();
    });
  }
);
</script>

<style scoped>
svg {
  width: 100%;
  height: auto;
}
</style>
