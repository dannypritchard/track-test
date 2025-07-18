<template>
  <li>
    {{ track.title }} - {{ track.artist }}
    <button type="button" @click="removeTrack(track.id)">Remove</button>
  </li>
</template>

<script setup lang="ts">
import { useTracksStore } from '@/stores/track'
import type { Track } from '@/types/track'

const tracksStore = useTracksStore()
const { removeTrack } = tracksStore

const props = defineProps<{
  track: Track
}>()
</script>
