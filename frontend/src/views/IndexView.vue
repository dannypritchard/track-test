<template>
  <div>
    <h1>My Tracks</h1>

    <div v-if="loading">Loading tracks…</div>

    <div v-if="error" class="error">{{ error }}</div>

    <ul v-if="tracks.length">
      <TrackTableItem
        v-for="track in tracks"
        :key="track.id"
        :track="track"
        @update="updateTrack"
      />
    </ul>

    <hr />

    <h2>Add New Track</h2>
    <form @submit.prevent="handleAdd">
      <label for="newTitle">Title:</label>
      <input id="newTitle" v-model="formValues.title" placeholder="Track Title" required />
      <label for="newArtist">Artist:</label>
      <input id="newArtist" v-model="formValues.artist" placeholder="Track Artist" required />
      <label for="newDuration">Duration (seconds):</label>
      <input id="newDuration" v-model.number="formValues.duration" type="number" min="1" required />
      <label for="newIsrc">ISRC:</label>
      <input
        id="newIsrc"
        v-model="formValues.isrc"
        placeholder="ISRC (e.g., US-ABC-12-34567)"
        pattern="^[A-Z]{2}-[A-Z0-9]{3}-\d{2}-\d{5}$"
      />
      <button type="submit">Add Track</button>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import TrackTableItem from '@/components/TrackTableItem.vue';
import { useTracksStore } from '@/stores/track';
import type { ISRC } from '@/types/track';

const store = useTracksStore();
const { tracks, loading, error } = storeToRefs(store);

onMounted(() => {
  store.fetchTracks();
});

const formValues = ref({
  title: '',
  artist: '',
  duration: 1,
  isrc: '',
});

const validateForm = (form: typeof formValues.value) => {
  return form.title && form.artist && form.duration > 0;
};

const clearForm = () => {
  formValues.value = { title: '', artist: '', duration: 1, isrc: '' };
};

const handleAdd = async (event: Event) => {
  event.preventDefault();

  if (!validateForm(formValues.value)) {
    return;
  }

  await store.createTrack({
    title: formValues.value.title,
    artist: formValues.value.artist,
    duration: formValues.value.duration,
    isrc: (formValues.value.isrc as ISRC) || null,
  });

  clearForm();
};

const updateTrack = async (id: number, title: string) => {
  await store.updateTrack(id, {
    title,
    artist: 'Unknown Artist',
    duration: 1,
    isrc: null,
  });
};
</script>
