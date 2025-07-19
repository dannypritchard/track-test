<template>
  <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
      <h3 class="mb-4 text-xl font-semibold text-gray-900">
        {{ isEdit ? 'Edit Track' : 'Add New Track' }}
      </h3>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Title (255 max)</label>
          <input
            v-model="local.title"
            required
            :maxlength="255"
            class="mt-1 block w-full border border-gray-300 rounded-sm px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 text-sm"
          />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Artist (255 max)</label>
          <input
            v-model="local.artist"
            required
            :maxlength="255"
            class="mt-1 block w-full border border-gray-300 rounded-sm px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 text-sm"
          />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Duration (sec)</label>
          <input
            v-model.number="local.duration"
            type="number"
            min="1"
            required
            class="mt-1 block w-full border border-gray-300 rounded-sm px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 text-sm"
          />
        </div>
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-1">ISRC</label>
          <input
            v-model="local.isrc"
            placeholder="US-ABC-12-34567"
            pattern="^[A-Z]{2}-[A-Z0-9]{3}-\d{2}-\d{5}$"
            :maxlength="20"
            class="mt-1 block w-full border border-gray-300 rounded-sm px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 text-sm"
          />
        </div>
        <div class="flex justify-end space-x-2">
          <button
            type="button"
            @click="$emit('close')"
            class="px-4 py-2 font-medium text-gray-700 bg-white border border-gray-200 rounded-sm hover:bg-gray-50 focus:outline-none focus:ring-3 focus:ring-gray-500 text-sm cursor-pointer"
          >
            Cancel
          </button>
          <button
            type="submit"
            class="px-4 py-2 font-medium text-white bg-blue-600 rounded-sm hover:bg-blue-700 focus:outline-none focus:ring-3 focus:ring-blue-500 text-sm cursor-pointer"
          >
            {{ isEdit ? 'Save' : 'Add' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed, reactive, watch } from 'vue';
import type { Track } from '@/types/track';

const props = defineProps<{ show: boolean; track?: Track }>();
const emit = defineEmits<{
  (e: 'save', payload: Omit<Track, 'id'>): void;
  (e: 'update', payload: Track): void;
  (e: 'close'): void;
}>();

const isEdit = computed(() => !!props.track);

const local = reactive<Omit<Track, 'id'>>({
  title: props.track?.title || '',
  artist: props.track?.artist || '',
  duration: props.track?.duration || 1,
  isrc: props.track?.isrc || null,
});

// Initialize local state when props.track changes
watch(
  () => props.track,
  (track) => {
    local.title = track?.title ?? '';
    local.artist = track?.artist ?? '';
    local.duration = track?.duration ?? 1;
    local.isrc = track?.isrc ?? null;
  },
  { immediate: true },
);

// Reset local state when modal is closed
watch(
  () => props.show,
  (visible) => {
    if (visible) {
      local.title = props.track?.title ?? '';
      local.artist = props.track?.artist ?? '';
      local.duration = props.track?.duration ?? 1;
      local.isrc = props.track?.isrc ?? null;
    }
  },
);

const submit = () => {
  if (isEdit.value && props.track) {
    emit('update', { ...props.track, ...local });
  } else {
    emit('save', { ...local });
  }
};
</script>
