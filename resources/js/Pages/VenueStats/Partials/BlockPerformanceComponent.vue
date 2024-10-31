<template>
    <QCard bg="default-gray">
        <div class="flex justify-space-between align-center w-full">
            <div class="mb-4">
                <h3 class="q-text-qrla_green h3 mb-6">Block Activity</h3>
                <QGraphTimeScaleMenu
                    :handle-time-scale-change="handleTimeScaleChange"
                />
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
                    <!-- Use getBlockColor to match map colors -->
                    <BlockPerformanceRow
                        v-if="blockPercentData.current"
                        v-for="(item, index) in blockPercentData.current.data"
                        :key="index"
                        :visits="item.access_count"
                        :percent-of-total="item.access_percent"
                        :progress-bar-color="getBlockColor(item.block_id)"
                        :block-name="item.block_name"
                        :highest-percentage="
                            blockPercentData.current.data[0].access_count
                        "
                    />
                </QCard>
            </v-col>
            <v-col cols="12" lg="6">
              <!-- Legend -->
              <div class="flex flex-col items-center mb-4">
                <!-- Color Legend -->
                <div style="display: flex; align-items: center;">
                  <div class="flex flex-col items-center mr-2">
                    <span class="h4">Low</span>
                    <span class="h6">{{ minPercent }}%</span>
                  </div>
                  <div
                    style="width: 150px; height: 10px; border-radius: 5px;"
                    :style="{ background: colorGradient }"
                  ></div>
                  <div class="flex flex-col items-center ml-2">
                    <span class="h4">High</span>
                    <span class="h6">{{ maxPercent }}%</span>
                  </div>
                </div>
              </div>
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
                        <Icon
                            icon="material-symbols:stairs-outline"
                            height="25"
                            class="text-primary"
                        />
                    </div>
                    <img
                        :src="STADIUMCHAIRS"
                        alt="Stadium Chairs"
                        class="w-full mb-4"
                    />
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
import { ref, reactive, onMounted, watch, computed } from "vue";
import { Stand, BlockShort, VenuePageProps, TimeRange } from "@/types";
import { getAccessesByBlockOverTime } from "@/utils/apiDataFetchers";
import QCard from "@/components/QComponents/QCard.vue";
import QSpicyLoading from "@/components/QComponents/QSpicyLoading.vue";
import QGraphTimeScaleMenu from "@/components/QComponents/QGraphTimeScaleMenu.vue";
import QMenusAnchor from "@/components/QComponents/QMenusAnchor.vue";
import BlockPerformanceRow from "./BlockPerformanceRow.vue";
import QInteractiveVenueMap from "@/components/QComponents/QInteractiveVenueMap.vue";
import { Icon } from "@iconify/vue";
import { Link } from "@inertiajs/vue3";
import STADIUMCHAIRS from "@/assets/images/QAssets/VenuePerformance/asset1.png";

const props = defineProps<{
    selectedItem: VenuePageProps;
    stands: Stand[];
}>();

// Create a local copy of stands
const localStands = ref<Stand[]>([]);

// Remove the static colors array
// const colors = ['primary', 'warning', 'success', 'purple']

// Color gradient for the venue map
const venueMapColors: string[] = [
    "#440154FF",
    "#481567FF",
    "#482677FF",
    "#453781FF",
    "#404788FF",
    "#39568CFF",
    "#33638DFF",
    "#2D708EFF",
    "#287D8EFF",
    "#238A8DFF",
    "#1F968BFF",
    "#20A387FF",
    "#29AF7FFF",
    "#3CBB75FF",
    "#55C667FF",
    "#73D055FF",
    "#95D840FF",
    "#B8DE29FF",
    "#DCE319FF",
    "#FDE725FF",
];

const loading = ref(false);

type DataObjectForBlockPercentData = { data: BlockShort[] } | null;

interface IBlockPercentData {
    day: DataObjectForBlockPercentData;
    week: DataObjectForBlockPercentData;
    month: DataObjectForBlockPercentData;
    threeMonths: DataObjectForBlockPercentData;
    year: DataObjectForBlockPercentData;
    current: DataObjectForBlockPercentData;
}

const blockPercentData = reactive<IBlockPercentData>({
    day: null,
    week: null,
    month: null,
    threeMonths: null,
    year: null,
    current: null,
});

onMounted(async () => {
    // Deep copy of props.stands to localStands
    localStands.value = JSON.parse(JSON.stringify(props.stands));
    loading.value = true;
    await fetchData();
    loading.value = false;
});

const fetchData = async () => {
    blockPercentData.day = await getAccessesByBlockOverTime(
        props.selectedItem.id,
        "1d",
    );
    blockPercentData.week = await getAccessesByBlockOverTime(
        props.selectedItem.id,
        "1w",
    );
    blockPercentData.month = await getAccessesByBlockOverTime(
        props.selectedItem.id,
        "1m",
    );
    blockPercentData.threeMonths = await getAccessesByBlockOverTime(
        props.selectedItem.id,
        "3m",
    );
    blockPercentData.year = await getAccessesByBlockOverTime(
        props.selectedItem.id,
        "1y",
    );

    blockPercentData.current =
        blockPercentData.threeMonths || blockPercentData.day;

    // Compute and assign colors to blocks
    computeAndAssignColors();
};

const minPercent = ref('0');
const maxPercent = ref('0');

const computeAndAssignColors = () => {
  if (blockPercentData.current && blockPercentData.current.data.length > 0) {
    // Extract access counts
    const accessCounts = blockPercentData.current.data.map(
      (item) => item.access_count,
    );
    const minAccess = Math.min(...accessCounts);
    const maxAccess = Math.max(...accessCounts);
    const range = maxAccess - minAccess || 1; // Avoid division by zero

    // Update minPercent and maxPercent
    const totalAccesses = accessCounts.reduce((sum, val) => sum + val, 0) || 1;
    minPercent.value = ((minAccess / totalAccesses) * 100).toFixed(2);
    maxPercent.value = ((maxAccess / totalAccesses) * 100).toFixed(2);

    // Assign colors to blocks based on normalized access counts
    localStands.value.forEach((stand) => {
      stand.blocks.forEach((block) => {
        // Find corresponding block data
        const blockData = blockPercentData.current.data.find(
          (item) => item.block_id === block.id,
        );
        if (blockData) {
          const normalizedValue =
            (blockData.access_count - minAccess) / range;
          const colorIndex = Math.floor(
            normalizedValue * (venueMapColors.length - 1),
          );
          block.color = venueMapColors[colorIndex];
        } else {
          // Default color if no data
          block.color = '#CCCCCC';
        }
      });
    });
  }
};

// Watch for changes in the current data and recompute colors
watch(
    () => blockPercentData.current,
    () => {
        computeAndAssignColors();
    },
);

// Handle time scale changes
const handleTimeScaleChange = (timeScale: TimeRange) => {
    switch (timeScale) {
        case "1d":
            blockPercentData.current = blockPercentData.day;
            break;
        case "1w":
            blockPercentData.current = blockPercentData.week;
            break;
        case "1m":
            blockPercentData.current = blockPercentData.month;
            break;
        case "3m":
            blockPercentData.current = blockPercentData.threeMonths;
            break;
        case "1y":
            blockPercentData.current = blockPercentData.year;
            break;
    }
};

// Function to get block color
const getBlockColor = (blockId) => {
    for (const stand of localStands.value) {
        const block = stand.blocks.find((block) => block.id === blockId);
        if (block && block.color) {
            return block.color;
        }
    }
    return "#CCCCCC"; // default color if not found
};

const colorGradient = computed(() => {
    return `linear-gradient(to right, ${venueMapColors[0]}, ${venueMapColors[venueMapColors.length - 1]})`;
});
</script>
