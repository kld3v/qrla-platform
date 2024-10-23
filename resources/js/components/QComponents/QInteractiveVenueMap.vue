<template>
	<div class="svg-wrapper">
		<div
			v-html="svgContent"
			ref="svgContainer"></div>
	</div>
</template>

<script setup lang="ts">
import { ref, onMounted, nextTick, watch } from 'vue'
import { Stand, BlockExtended } from '@/types'

const props = defineProps<{
	svgUrl: string
	stands: Stand[]
	selectedBlocks: BlockExtended[]
	updateSelectedBlockState: (blocks: BlockExtended[]) => void
}>()

const internalSelectedBlocks = ref<BlockExtended[]>(props.selectedBlocks)

const updateInternalBlocksState = (block: BlockExtended) => {
	// Check if the block is already in the selectedBlocks
	const iDoHaveYourBlock = internalSelectedBlocks.value.find((el) => el.id === block.id)

	if (iDoHaveYourBlock) {
		// If it exists, remove it from internalSelectedBlocks
		internalSelectedBlocks.value = internalSelectedBlocks.value.filter((el) => el.id !== block.id)
	} else {
		// If it doesn't exist, add it to internalSelectedBlocks
		internalSelectedBlocks.value.push(block)
	}
	console.log('internalValue', internalSelectedBlocks.value)
}

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

const handlePolygonClick = (polygonIdWithUnderscores: string) => {
	console.log('Polygon clicked:', polygonIdWithUnderscores)

	let clickedBlock: BlockExtended | null = null

	// Find the block that corresponds to the clicked polygon
	props.stands.forEach((stand) => {
		stand.blocks.forEach((block) => {
			const blockNameWithUnderscores = block.name.replace(/\s+/g, '_')
			if (blockNameWithUnderscores === polygonIdWithUnderscores) {
				clickedBlock = block
			}
		})
	})

	// If no block is found, log a warning and return
	if (!clickedBlock) {
		console.warn('Block not found for polygon:', polygonIdWithUnderscores)
		return
	}

	// Update internal selection and propagate to parent
	updateInternalBlocksState(clickedBlock)
	props.updateSelectedBlockState(internalSelectedBlocks.value)
}

const addPolygonHoverEffects = () => {
	const polygons = svgContainer.value.querySelectorAll('polygon')

	polygons.forEach((polygon) => {
		const polygonId = polygon.getAttribute('id')
		if (!polygonId) return

		const polygonIdWithUnderscores = polygonId.replace(/\s+/g, '_')

		// Determine if the polygon is selected
		const isSelected = internalSelectedBlocks.value.some((block) => block.name.replace(/\s+/g, '_') === polygonIdWithUnderscores)

		// Set the initial fill color based on selection or stand color
		let fillColor = ''
		if (isSelected) {
			fillColor = '#A2F732' // Highlight color for selected blocks
		} else if (blockColorMap.value[polygonIdWithUnderscores]) {
			fillColor = blockColorMap.value[polygonIdWithUnderscores]
		} else {
			fillColor = '#CCCCCC' // Default color
		}

		polygon.style.fill = fillColor

		// Store the original fill color for use in mouseout
		const originalFill = fillColor

		// Add event listeners only if they haven't been added yet
		if (!polygon.hasAttribute('data-listeners-added')) {
			// Always add hover listeners
			polygon.addEventListener('mouseover', () => {
				polygon.style.fill = '#A2F732' // Highlight color on hover
			})

			polygon.addEventListener('mouseout', () => {
				// Re-determine if the polygon is selected after hover
				const currentlySelected = internalSelectedBlocks.value.some((block) => block.name.replace(/\s+/g, '_') === polygonIdWithUnderscores)

				if (currentlySelected) {
					polygon.style.fill = '#A2F732' // Maintain highlight if selected
				} else if (blockColorMap.value[polygonIdWithUnderscores]) {
					polygon.style.fill = blockColorMap.value[polygonIdWithUnderscores]
				} else {
					polygon.style.fill = '#CCCCCC'
				}
			})

			// Add click listener
			polygon.addEventListener('click', () => {
				handlePolygonClick(polygonIdWithUnderscores)
			})

			// Mark the polygon as having listeners added
			polygon.setAttribute('data-listeners-added', 'true')
		}
	})
}

onMounted(() => {
	assignStandColors()
	createBlockColorMap()
	loadSvgFile()
})

watch(
	() => props.selectedBlocks,
	(newVal, oldVal) => {
		// internalSelectedBlocks.value = newVal
		// console.log('local state: updated and next tick called!', internalSelectedBlocks.value)
		console.log('addPolygonHoverEffects')
		nextTick(() => {
			addPolygonHoverEffects()
		})
	},
	{
		immediate: true,
	}
)
</script>

<style scoped>
svg {
	width: 100%;
	height: auto;
}
</style>
