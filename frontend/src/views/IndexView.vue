<template>
  <div>
    <h1 class="mb-4 text-3xl font-bold text-gray-900">Track App by Danny Pritchard</h1>

    <Loader v-if="loading" class="mb-4" />

    <div v-if="error" class="mb-4 p-3 bg-red-100 text-red-800 rounded">
      {{ error }}
    </div>

    <div v-if="notification" class="mb-4 p-3 bg-green-100 text-green-800 rounded">
      {{ notification }}
    </div>

    <TrackTable v-if="tracks.length" :tracks="tracks" @edit="openEditModal" class="mb-6" />

    <div v-else class="mb-6 text-gray-500">Please add a track using the button below.</div>

    <button
      @click="openAddModal"
      class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-sm hover:bg-green-700 focus:outline-none focus:ring-3 focus:ring-green-500"
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

const notification = ref<string | null>(null);

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
  notification.value = null;
  const success = await store.createTrack(payload);
  notification.value = success ? 'Track created successfully' : null;
};

const updateTrack = async (track: Track) => {
  notification.value = null;
  const { id, ...rest } = track;
  showModal.value = false;
  const success = await store.updateTrack(id, rest);
  notification.value = success ? 'Track updated successfully' : null;
};
</script>
