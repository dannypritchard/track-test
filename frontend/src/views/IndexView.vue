<template>
  <Suspense fallback="Loading tracks...">
    <ul>
      <TrackTableItem v-for="track in tracks" :key="track.id" :track="track" />
    </ul>
  </Suspense>
</template>

<script setup lang="ts">
import TrackTableItem from '@/components/TrackTableItem.vue'
import { useTracksStore } from '@/stores/track'
import { storeToRefs } from 'pinia'
import { onMounted } from 'vue'

const tracksStore = useTracksStore()
const { addTrack } = tracksStore
const { tracks } = storeToRefs(tracksStore)

onMounted(async () => {
  try {
    const tracksResponse = await fetch('http://localhost:8000/api/tracks')
    console.log('Tracks response:', tracksResponse)
    if (!tracksResponse.ok) {
      throw new Error(tracksResponse.statusText)
    }
    const data = await tracksResponse.json()
    data.forEach((track: any) => addTrack(track))
  } catch (err: any) {
    alert('Failed to fetch tracks: ' + err.message)
  }
})
</script>
