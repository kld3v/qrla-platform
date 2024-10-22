<template>
	<div class="svg-wrapper">
		<div
			v-html="svgContent"
			ref="svgContainer"></div>
	</div>
</template>

<script setup lang="ts">
import { ref, onMounted, nextTick, watch } from 'vue'
import { Stand, BlockEverywhereElse } from '@/types'

const props = defineProps<{
	svgUrl: string
	stands: Stand[]
	selectedBlocks?: BlockEverywhereElse[]
}>()

const emits = defineEmits(['update:selectedBlocks'])

const svgContent = ref('')
const svgContainer = ref(null)

const standColorMap = ref({})
const blockColorMap = ref({})

const assignStandColors = () => {
	const colors = ['#14E9E2', '#FFAE1F', '#ff6692', '#635BFF', '#ffffff', '#33FFF3']
	props.stands.forEach((stand, index) => {
		standColorMap.value[stand.id] = colors[index % colors.length]
	})
}

const createBlockColorMap = () => {
	props.stands.forEach((stand) => {
		const color = standColorMap.value[stand.id]
		stand.blocks.forEach((block) => {
			const blockNameWithUnderscores = block.name.replace(/\s+/g, '_')
			blockColorMap.value[blockNameWithUnderscores] = color
		})
	})
}

const loadSvgFile = async () => {
	try {
		const response = await fetch(props.svgUrl)
		const svg = await response.text()
		svgContent.value = svg
		nextTick(() => {
			addPolygonHoverEffects()
		})
	} catch (error) {
		console.error('Error loading SVG:', error)
	}
}

const addPolygonHoverEffects = () => {
	const polygons = svgContainer.value.querySelectorAll('polygon')
	polygons.forEach((polygon) => {
		const polygonId = polygon.getAttribute('id')
		if (!polygonId) return

		const polygonIdWithUnderscores = polygonId.replace(/\s+/g, '_')
		let fillColor = ''

		const selectedBlockNames = props.selectedBlocks.map((block) => block.name.replace(/\s+/g, '_'))

		if (selectedBlockNames.includes(polygonIdWithUnderscores)) {
			fillColor = '#A2F732' // Highlight the selected block
		} else if (blockColorMap.value[polygonIdWithUnderscores]) {
			fillColor = blockColorMap.value[polygonIdWithUnderscores]
		} else {
			fillColor = '#CCCCCC' // default color
		}

		polygon.style.fill = fillColor

		const originalFill = fillColor // Store the original fill color

		polygon.addEventListener('mouseover', () => {
			polygon.style.fill = '#A2F732' // highlight color on hover
		})
		polygon.addEventListener('mouseout', () => {
			polygon.style.fill = originalFill // reset to original fill color
		})
		polygon.addEventListener('click', () => {
			handlePolygonClick(polygonIdWithUnderscores)
		})
	})
}

const handlePolygonClick = (polygonIdWithUnderscores) => {
	console.log('Polygon clicked:', polygonIdWithUnderscores)

	let clickedBlock = null
	props.stands.forEach((stand) => {
		stand.blocks.forEach((block) => {
			const blockNameWithUnderscores = block.name.replace(/\s+/g, '_')
			if (blockNameWithUnderscores === polygonIdWithUnderscores) {
				clickedBlock = block
			}
		})
	})

	if (!clickedBlock) {
		console.warn('Block not found for polygon:', polygonIdWithUnderscores)
		return
	}

	const index = props.selectedBlocks.findIndex((block) => block.id === clickedBlock.id)

	let updatedSelectedBlocks = [...props.selectedBlocks]

	if (index !== -1) {
		// Block is selected, so remove it
		updatedSelectedBlocks.splice(index, 1)
	} else {
		// Block is not selected, so add it
		updatedSelectedBlocks.push(clickedBlock)
	}

	console.log('Updated selected blocks:', updatedSelectedBlocks)

	emits('update:selectedBlocks', updatedSelectedBlocks)
}

onMounted(() => {
	assignStandColors()
	createBlockColorMap()
	loadSvgFile()
})

watch(
	() => props.selectedBlocks,
	() => {
		nextTick(() => {
			addPolygonHoverEffects()
		})
	},
	{ immediate: true }
)
</script>

<style scoped>
svg {
	width: 100%;
	height: auto;
}
</style>
