<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="mb-4 text-3xl font-bold">Track App by Danny Pritchard</h1>

    <Loader v-if="loading" />

    <div v-if="error" class="mb-4 text-red-500">
      {{ error }}
    </div>

    <TrackTable v-if="tracks.length" :tracks="tracks" @edit="openEditModal" />

    <div v-else class="text-gray-500">No tracks yet.</div>

    <button
      @click="openAddModal"
      class="mt-4 cursor-pointer rounded-sm bg-green-600 px-4 py-2 text-white focus:outline-none focus:ring-3 focus:ring-green-500"
    >
      Add Track
    </button>

    <TrackModal
      :show="showModal"
      :track="modalTrack"
      @save="createTrack"
      @update="updateTrack"
      @close="showModal = false"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import { useTracksStore } from '@/stores/track';

import type { Track, TrackRequest } from '@/types/track';

import Loader from '@/components/LoadingSpinner.vue';
import TrackModal from '@/components/TrackModal.vue';
import TrackTable from '@/components/TrackTable.vue';

const store = useTracksStore();
const { tracks, loading, error } = storeToRefs(store);

const showModal = ref(false);
const modalTrack = ref<Track | undefined>();

onMounted(() => {
  store.fetchTracks();
});

const openAddModal = () => {
  modalTrack.value = undefined;
  showModal.value = true;
};

const openEditModal = (track: Track) => {
  modalTrack.value = track;
  showModal.value = true;
};

const createTrack = async (payload: TrackRequest) => {
  showModal.value = false;
  await store.createTrack(payload);
};

const updateTrack = async (track: Track) => {
  const { id, ...rest } = track;
  showModal.value = false;
  await store.updateTrack(id, rest);
};
</script>
