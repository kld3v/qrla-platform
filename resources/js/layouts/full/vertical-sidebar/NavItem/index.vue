<script setup>
import { Icon } from '@iconify/vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  item: Object,
  level: Number,
})

const { item, level } = props

const handleClick = () => {
  if (item.disabled) {
    return
  }

  // Scroll to top
  window.scrollTo({ top: 0, behavior: 'smooth' })

  if (item.type === 'external') {
    window.open(item.to, '_blank')
  } else {
    router.visit(item.to)
  }
}
</script>

<template>
  <v-list-item
    :disabled="item.disabled"
    rounded
    @click="handleClick"
    link
  >
    <!-- Icon -->
    <template v-slot:prepend>
      <Icon
        :icon="item.icon"
        height="22"
        width="22"
        class="dot"
        :class="'text-' + item.BgColor"
      />
    </template>

    <!-- Title -->
    <v-list-item-title class="!whitespace-pre-wrap">
      {{ item.title }}
    </v-list-item-title>

    <!-- If Caption -->
    <v-list-item-subtitle
      v-if="item.subCaption"
      class="text-caption mt-n1 hide-menu"
    >
      {{ item.subCaption }}
    </v-list-item-subtitle>

    <!-- If any chip or label -->
    <template v-slot:append v-if="item.chip">
      <v-chip
        :color="item.chipColor"
        :class="'sidebarchip hide-menu bg-' + item.chipBgColor"
        size="small"
        :variant="item.chipVariant"
        :prepend-icon="item.chipIcon"
      >
        {{ item.chip }}
      </v-chip>
    </template>
  </v-list-item>
</template>
