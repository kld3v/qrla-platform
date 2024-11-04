<template>
	<div class="svg-wrapper">
		<div
			v-html="svgContent"
			ref="svgContainer"
			class="grid place-items-center"></div>
		<div
			ref="tooltipRef"
			class="tooltip"
			v-if="tooltipVisible"
			:style="{ top: tooltipPosition.y + 'px', left: tooltipPosition.x + 'px' }">
			{{ tooltipText }}
		</div>
	</div>
</template>

<script setup lang="ts">
import { ref, onMounted, nextTick, watch } from 'vue'
import { Stand, BlockExtended } from '@/types'

const props = defineProps<{
	svgUrl: string
	stands: Stand[]
	selectedBlocks?: BlockExtended[]
	updateSelectedBlockState?: (blocks: BlockExtended[]) => void
	disableHoverColor?: boolean
}>()

const internalSelectedBlocks = ref<BlockExtended[]>(props.selectedBlocks || [])

const updateInternalBlocksState = (block: BlockExtended) => {
	const blockExists = internalSelectedBlocks.value.find((el) => el.id === block.id)

	if (blockExists) {
		internalSelectedBlocks.value = internalSelectedBlocks.value.filter((el) => el.id !== block.id)
	} else {
		internalSelectedBlocks.value.push(block)
	}

	if (props.updateSelectedBlockState) {
		props.updateSelectedBlockState(internalSelectedBlocks.value)
	}
}

const svgContent = ref('')
const svgContainer = ref<SVGElement | null>(null)
const blockColorMap = ref({})

// Tooltip related refs
const tooltipRef = ref<HTMLDivElement | null>(null)
const tooltipVisible = ref(false)
const tooltipText = ref('')
const tooltipPosition = ref({ x: 0, y: 0 })

const createBlockColorMap = () => {
	props.stands.forEach((stand) => {
		stand.blocks.forEach((block) => {
			const blockNameWithUnderscores = block.name.replace(/\s+/g, '_')
			//@ts-ignore
			blockColorMap.value[blockNameWithUnderscores] = block.color
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
	let clickedBlock: BlockExtended | null = null

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

	updateInternalBlocksState(clickedBlock)
}

const getBlockNameByPolygonId = (polygonIdWithUnderscores: string): string | null => {
	let blockName: string | null = null
	props.stands.forEach((stand) => {
		stand.blocks.forEach((block) => {
			const blockNameWithUnderscores = block.name.replace(/\s+/g, '_')
			if (blockNameWithUnderscores === polygonIdWithUnderscores) {
				blockName = block.name
			}
		})
	})
	return blockName
}

const updateTooltipPosition = (event: MouseEvent) => {
	const svgWrapperRect = svgContainer.value?.getBoundingClientRect()
	if (svgWrapperRect && tooltipRef.value) {
		const tooltipWidth = tooltipRef.value.offsetWidth
		const tooltipHeight = tooltipRef.value.offsetHeight

		tooltipPosition.value.x = event.clientX - svgWrapperRect.left - tooltipWidth / 2
		tooltipPosition.value.y = event.clientY - svgWrapperRect.top - tooltipHeight - 5
	}
}

const addPolygonHoverEffects = () => {
	let polygons: NodeListOf<SVGPolygonElement> | null = null

	if (svgContainer.value) {
		polygons = svgContainer.value.querySelectorAll('polygon')
	}

	if (polygons) {
		polygons.forEach((polygon) => {
			const polygonId = polygon.getAttribute('id')
			if (!polygonId) return

			const polygonIdWithUnderscores = polygonId.replace(/\s+/g, '_')

			const isSelected = internalSelectedBlocks.value.some((block) => block.name.replace(/\s+/g, '_') === polygonIdWithUnderscores)

			let fillColor = ''
			if (isSelected) {
				fillColor = '#A2F732'
				//@ts-ignore
			} else if (blockColorMap.value[polygonIdWithUnderscores]) {
				//@ts-ignore
				fillColor = blockColorMap.value[polygonIdWithUnderscores]
			} else {
				fillColor = '#CCCCCC'
			}

			polygon.style.fill = fillColor

			if (!polygon.hasAttribute('data-listeners-added')) {
				polygon.addEventListener('mouseover', (event: MouseEvent) => {
					// Only change color if hover color is not disabled
					if (!props.disableHoverColor) {
						polygon.style.fill = '#A2F732'
					}
					// Show tooltip
					const blockName = getBlockNameByPolygonId(polygonIdWithUnderscores)
					if (blockName) {
						tooltipText.value = blockName
						tooltipVisible.value = true
						updateTooltipPosition(event)
					}
				})

				polygon.addEventListener('mousemove', (event: MouseEvent) => {
					updateTooltipPosition(event)
				})

				polygon.addEventListener('mouseout', () => {
					const currentlySelected = internalSelectedBlocks.value.some((block) => block.name.replace(/\s+/g, '_') === polygonIdWithUnderscores)

					let fillColor = ''
					if (currentlySelected) {
						fillColor = '#A2F732'
						//@ts-ignore
					} else if (blockColorMap.value[polygonIdWithUnderscores]) {
						//@ts-ignore
						fillColor = blockColorMap.value[polygonIdWithUnderscores]
					} else {
						fillColor = '#CCCCCC'
					}

					// Only reset color if hover color is not disabled
					if (!props.disableHoverColor) {
						polygon.style.fill = fillColor
					}
					// Hide tooltip
					tooltipVisible.value = false
				})

				polygon.addEventListener('click', () => {
					handlePolygonClick(polygonIdWithUnderscores)
				})

				polygon.setAttribute('data-listeners-added', 'true')
			}
		})
	}
}

onMounted(() => {
	createBlockColorMap()
	loadSvgFile()
})

if (props.selectedBlocks !== undefined) {
	watch(
		() => props.selectedBlocks,
		(newVal) => {
			if (newVal !== undefined) {
				internalSelectedBlocks.value = newVal
				nextTick(() => {
					addPolygonHoverEffects()
				})
			}
		},
		{
			immediate: true,
		}
	)
}

watch(
	() => props.stands,
	() => {
		createBlockColorMap()
		nextTick(() => {
			addPolygonHoverEffects()
		})
	},
	{ deep: true }
)
</script>

<style scoped>
.svg-wrapper {
	position: relative;
}

svg {
	width: 100%;
	height: auto;
}

.tooltip {
	position: absolute;
	background-color: #ffffff;
	border: 1px solid #606060;
	padding: 8px;
	font-size: 18px;
	border-radius: 5px;
	pointer-events: none;
	white-space: nowrap;
	z-index: 10;
	box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
	color: #000000;
}
</style>
