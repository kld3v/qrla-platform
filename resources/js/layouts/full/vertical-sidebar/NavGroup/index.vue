<script setup>
const props = defineProps({ item: Object })
</script>

<template>
	<v-list-subheader class="smallCap text-uppercase text-subtitle-2 font-weight-bold d-flex align-items-center">
		<span class="mini-text text-white">{{ props.item.header }}</span>
	</v-list-subheader>
</template>
