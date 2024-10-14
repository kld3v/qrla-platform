<script setup>
import { Icon } from '@iconify/vue'
import { Link } from '@inertiajs/vue3'
const props = defineProps({ item: Object, level: Number })
</script>

<template>
	<!---Single Item-->

	<v-list-item
		:to="item.type === 'external' ? '' : item.to"
		:href="item.type === 'external' ? item.to : ''"
		rounded
		:disabled="item.disabled"
		:target="item.type === 'external' ? '_blank' : ''"
		v-scroll-to="{ el: '#top' }">
		<!---If icon-->
		<template v-slot:prepend>
			<Icon
				:icon="item.icon"
				height="22"
				width="22"
				:level="level"
				class="dot"
				:class="'text-' + item.BgColor" />
		</template>
		<v-list-item-title class="muted !whitespace-pre-wrap"
			><Link :href="item.to">{{ item.title }}</Link></v-list-item-title
		>
		<!---If Caption-->
		<v-list-item-subtitle
			v-if="item.subCaption"
			class="text-caption mt-n1 hide-menu">
			{{ item.subCaption }}
		</v-list-item-subtitle>
		<!---If any chip or label-->
		<template
			v-slot:append
			v-if="item.chip">
			<v-chip
				:color="item.chipColor"
				:class="'sidebarchip hide-menu bg-' + item.chipBgColor"
				:size="item.chipIcon ? 'small' : 'small'"
				:variant="item.chipVariant"
				:prepend-icon="item.chipIcon">
				{{ item.chip }}
			</v-chip>
		</template>
	</v-list-item>
</template>
