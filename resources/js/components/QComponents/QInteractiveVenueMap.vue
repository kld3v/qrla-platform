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

const onClickSeeIfMrSelectedBlocksHasMyBlockAndPushIfSoRemoveIfNot = (block: BlockExtended) => {
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
	props.updateSelectedBlockState(internalSelectedBlocks.value)
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
	onClickSeeIfMrSelectedBlocksHasMyBlockAndPushIfSoRemoveIfNot(clickedBlock)

	// Update SVG highlighting after selection changes
	nextTick(() => {
		addPolygonHoverEffects() // Reapply polygon effects
	})
}

const addPolygonHoverEffects = () => {
	const polygons = svgContainer.value.querySelectorAll('polygon')
	polygons.forEach((polygon) => {
		const polygonId = polygon.getAttribute('id')
		if (!polygonId) return

		const polygonIdWithUnderscores = polygonId.replace(/\s+/g, '_')
		let fillColor = ''

		// Check if the polygon is in the selected blocks
		const selectedBlockNames = internalSelectedBlocks.value.map((block) => block.name.replace(/\s+/g, '_'))

		if (selectedBlockNames.includes(polygonIdWithUnderscores)) {
			fillColor = '#A2F732' // Highlight the selected block
		} else if (blockColorMap.value[polygonIdWithUnderscores]) {
			fillColor = blockColorMap.value[polygonIdWithUnderscores] // Assign the mapped color
		} else {
			fillColor = '#CCCCCC' // Default color
		}

		// Set the fill color based on the selection status
		polygon.style.fill = fillColor

		// Store the original fill color for reset on hover out
		const originalFill = fillColor

		// Check if event listeners have been added before
		if (!polygon.hasAttribute('data-listeners-added')) {
			// Add event listeners only if they haven't been added
			if (!selectedBlockNames.includes(polygonIdWithUnderscores)) {
				polygon.addEventListener('mouseover', () => {
					polygon.style.fill = '#A2F732' // highlight color on hover
				})
				polygon.addEventListener('mouseout', () => {
					polygon.style.fill = originalFill // reset to original fill color
				})
			}
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
		internalSelectedBlocks.value = newVal
		console.log('local state: updated and next tick called!', internalSelectedBlocks.value)
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
