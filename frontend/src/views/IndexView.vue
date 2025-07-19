<template>
  <Suspense fallback="Loading tracks...">
    <ul>
      <TrackTableItem v-for="track in tracks" :key="track.id" :track="track" />
    </ul>
  </Suspense>

  <button @click="createTrack({ title: 'New Track' })">Add Track</button>
  <button @click="updateTrack({ title: 'Updated Track' })">Update Track</button>
</template>

<script setup lang="ts">
import { api } from '@/api';
import TrackTableItem from '@/components/TrackTableItem.vue';
import { useTracksStore } from '@/stores/track';
import { storeToRefs } from 'pinia';
import { onMounted } from 'vue';

const tracksStore = useTracksStore();
const { addTrack } = tracksStore;
const { tracks } = storeToRefs(tracksStore);

onMounted(async () => {
  try {
    const data = await api.fetchTracks();
    data.forEach((track) => addTrack(track));
  } catch (err: unknown) {
    if (err instanceof Error) {
      console.error('Failed to fetch tracks:', err.message);
    } else {
      console.error('Failed to fetch tracks:', err);
    }
  }
});

const createTrack = async (track: { title: string }) => {
  try {
    const newTrack = await api.createTrack({
      ...track,
      artist: 'Unknown Artist',
      duration: 1,
      isrc: null,
    });
    addTrack(newTrack);
  } catch (err: unknown) {
    if (err instanceof Error) {
      console.error('Failed to upload track:', err.message);
    } else {
      console.error('Failed to upload track:', err);
    }
  }
};

const updateTrack = async (track: { title: string }) => {
  try {
    const newTrack = await api.updateTrack(1, {
      ...track,
      artist: 'Unknown Artist',
      duration: 1,
      isrc: null,
    });
    addTrack(newTrack);
  } catch (err: unknown) {
    if (err instanceof Error) {
      console.error('Failed to upload track:', err.message);
    } else {
      console.error('Failed to upload track:', err);
    }
  }
};
</script>
