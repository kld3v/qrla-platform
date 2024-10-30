<!-- BlockPerformanceComponent.vue -->
<template>
  <QCard bg="default-gray">
    <div class="flex justify-space-between align-center w-full">
      <div class="mb-4">
        <h3 class="q-text-qrla_green h3 mb-6">Block Activity</h3>
        <QGraphTimeScaleMenu :handle-time-scale-change="handleTimeScaleChange" />
      </div>
      <QMenusAnchor
        :initial-selected-item="'All'"
        label="Blocks"
        menu-location="start"
        dropdown-button-color="secondary"
        :dropdown-options="['All']"
      ></QMenusAnchor>
    </div>
    <v-row>
      <v-col cols="12" lg="6">
        <QCard
          bg="dark-primary-gradient"
          custom-css="h-[400px] max-h-[480px] h-full"
          :overflow-y="true"
        >
          <p class="h4 mb-4">Top Performing Blocks</p>
          <QSpicyLoading v-if="loading"></QSpicyLoading>
          <!-- Accesses by block -->
          <BlockPerformanceRow
            v-if="blockPercentData.current"
            v-for="(item, index) in blockPercentData.current.data"
            :key="index"
            :visits="item.access_count"
            :percent-of-total="item.access_percent"
            :progress-bar-color="colors[index % colors.length]"
            :block-name="item.block_name"
            :highest-percentage="blockPercentData.current.data[0].access_count"
          />
        </QCard>
      </v-col>
      <v-col cols="12" lg="6">
        <!-- Pass the localStands to QInteractiveVenueMap -->
        <QInteractiveVenueMap
          :svg-url="selectedItem.map_svg_url"
          :stands="localStands"
        />
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" lg="12">
        <QCard bg="dark-primary-gradient">
          <div class="flex justify-space-between align-center">
            <p class="h4 mb-4">Block Performance Tracker</p>
            <Icon icon="material-symbols:stairs-outline" height="25" class="text-primary" />
          </div>
          <img :src="STADIUMCHAIRS" alt="Stadium Chairs" class="w-full mb-4" />
          <Link
            :href="
              route('blocks.showStats', {
                venue: selectedItem.id,
              })
            "
          >
            <v-btn color="primary" class="w-full">
              View Individual Block Performance
            </v-btn>
          </Link>
        </QCard>
      </v-col>
    </v-row>
  </QCard>
</template>

<script setup lang="ts">
import { ref, reactive, onMounted, watch } from 'vue'
import { Stand, BlockShort, VenuePageProps, TimeRange } from '@/types'
import { getAccessesByBlockOverTime } from '@/utils/apiDataFetchers'
import QCard from '@/components/QComponents/QCard.vue'
import QSpicyLoading from '@/components/QComponents/QSpicyLoading.vue'
import QGraphTimeScaleMenu from '@/components/QComponents/QGraphTimeScaleMenu.vue'
import QMenusAnchor from '@/components/QComponents/QMenusAnchor.vue'
import BlockPerformanceRow from './BlockPerformanceRow.vue'
import QInteractiveVenueMap from '@/components/QComponents/QInteractiveVenueMap.vue'
import { Icon } from '@iconify/vue'
import { Link } from '@inertiajs/vue3'
import STADIUMCHAIRS from '@/assets/images/QAssets/VenuePerformance/asset1.png'

const props = defineProps<{
  selectedItem: VenuePageProps
  stands: Stand[]
}>()

// Create a local copy of stands to avoid mutating props directly
const localStands = ref<Stand[]>([])

// Colors for the progress bars in BlockPerformanceRow
const colors = ['primary', 'warning', 'success', 'purple']

// Define the color gradient for the venue map
const venueMapColors: string[] = [
  '#440154FF', '#481567FF', '#482677FF', '#453781FF', '#404788FF',
  '#39568CFF', '#33638DFF', '#2D708EFF', '#287D8EFF', '#238A8DFF',
  '#1F968BFF', '#20A387FF', '#29AF7FFF', '#3CBB75FF', '#55C667FF',
  '#73D055FF', '#95D840FF', '#B8DE29FF', '#DCE319FF', '#FDE725FF',
]

const loading = ref(false)

// Define the structure for blockPercentData
type DataObjectForBlockPercentData = { data: BlockShort[] } | null

interface IBlockPercentData {
  day: DataObjectForBlockPercentData
  week: DataObjectForBlockPercentData
  month: DataObjectForBlockPercentData
  threeMonths: DataObjectForBlockPercentData
  year: DataObjectForBlockPercentData
  current: DataObjectForBlockPercentData
}

const blockPercentData = reactive<IBlockPercentData>({
  day: null,
  week: null,
  month: null,
  threeMonths: null,
  year: null,
  current: null, // For storing the current data passed to the graph
})

onMounted(async () => {
  // Deep copy of props.stands to localStands
  localStands.value = JSON.parse(JSON.stringify(props.stands))
  console.log('localStands after deep copy:', localStands.value)
  loading.value = true
  await fetchData()
  loading.value = false
})

const fetchData = async () => {
  // Fetch data for different time scales
  blockPercentData.day = await getAccessesByBlockOverTime(props.selectedItem.id, '1d')
  console.log('Data for 1d:', blockPercentData.day)
  blockPercentData.week = await getAccessesByBlockOverTime(props.selectedItem.id, '1w')
  console.log('Data for 1w:', blockPercentData.week)
  blockPercentData.month = await getAccessesByBlockOverTime(props.selectedItem.id, '1m')
  console.log('Data for 1m:', blockPercentData.month)
  blockPercentData.threeMonths = await getAccessesByBlockOverTime(props.selectedItem.id, '3m')
  console.log('Data for 3m:', blockPercentData.threeMonths)
  blockPercentData.year = await getAccessesByBlockOverTime(props.selectedItem.id, '1y')
  console.log('Data for 1y:', blockPercentData.year)

  // Set the initial current data
  blockPercentData.current = blockPercentData.threeMonths || blockPercentData.day
  console.log('Initial blockPercentData.current:', blockPercentData.current)

  // Compute and assign colors to blocks
  computeAndAssignColors()
}

// Function to compute and assign colors based on access counts
const computeAndAssignColors = () => {
  if (blockPercentData.current && blockPercentData.current.data.length > 0) {
    // Extract access counts
    const accessCounts = blockPercentData.current.data.map(item => item.access_count)
    const minAccess = Math.min(...accessCounts)
    const maxAccess = Math.max(...accessCounts)
    const range = maxAccess - minAccess || 1 // Avoid division by zero

    console.log('Access Counts:', accessCounts)
    console.log('Min Access:', minAccess)
    console.log('Max Access:', maxAccess)
    console.log('Range:', range)

    // Assign colors to blocks based on normalized access counts
    localStands.value.forEach(stand => {
      stand.blocks.forEach(block => {
        // Find corresponding block data
        const blockData = blockPercentData.current.data.find(item => item.block_id === block.id)
        if (blockData) {
          const normalizedValue = (blockData.access_count - minAccess) / range
          const colorIndex = Math.floor(normalizedValue * (venueMapColors.length - 1))
          block.color = venueMapColors[colorIndex]
          console.log(
            `Block ID: ${block.id}, Access Count: ${blockData.access_count}, Normalized Value: ${normalizedValue}, Color Index: ${colorIndex}, Assigned Color: ${block.color}`
          )
        } else {
          // Default color if no data
          block.color = '#CCCCCC'
          console.log(`Block ID: ${block.id} has no data. Assigned default color.`)
        }
      })
    })
    console.log('localStands after color assignment:', localStands.value)
  } else {
    console.log('No data available in blockPercentData.current or data is empty.')
  }
}

// Watch for changes in the current data and recompute colors
watch(
  () => blockPercentData.current,
  () => {
    console.log('blockPercentData.current changed:', blockPercentData.current)
    computeAndAssignColors()
  }
)

// Handle time scale changes
const handleTimeScaleChange = (timeScale: TimeRange) => {
  console.log('Time scale changed to:', timeScale)
  switch (timeScale) {
    case '1d':
      blockPercentData.current = blockPercentData.day
      break
    case '1w':
      blockPercentData.current = blockPercentData.week
      break
    case '1m':
      blockPercentData.current = blockPercentData.month
      break
    case '3m':
      blockPercentData.current = blockPercentData.threeMonths
      break
    case '1y':
      blockPercentData.current = blockPercentData.year
      break
  }
}
</script>
