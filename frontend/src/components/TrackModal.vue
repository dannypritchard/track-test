<template>
  <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-black/50">
    <div class="w-96 rounded-lg bg-white p-6">
      <h3 class="mb-4 text-xl font-semibold">
        {{ isEdit ? 'Edit Track' : 'Add New Track' }}
      </h3>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">Title</label>
          <input
            v-model="local.title"
            required
            class="w-full rounded-sm border border-gray-200 px-2 py-1 focus:outline-none focus:ring-3 focus:ring-blue-500"
          />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">Artist</label>
          <input
            v-model="local.artist"
            required
            class="w-full rounded-sm border border-gray-200 px-2 py-1 focus:outline-none focus:ring-3 focus:ring-blue-500"
          />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">Duration (sec)</label>
          <input
            v-model.number="local.duration"
            type="number"
            min="1"
            required
            class="w-full rounded-sm border border-gray-200 px-2 py-1 focus:outline-none focus:ring-3 focus:ring-blue-500"
          />
        </div>
        <div class="mb-6">
          <label class="block text-sm font-medium mb-1">ISRC</label>
          <input
            v-model="local.isrc"
            placeholder="US-ABC-12-34567"
            pattern="^[A-Z]{2}-[A-Z0-9]{3}-\d{2}-\d{5}$"
            class="w-full rounded-sm border border-gray-200 px-2 py-1 focus:outline-none focus:ring-3 focus:ring-blue-500"
          />
        </div>
        <div class="flex justify-end space-x-2">
          <button
            type="button"
            @click="$emit('close')"
            class="px-4 py-2 rounded-sm cursor-pointer focus:outline-none focus:ring-3 focus:ring-gray-500"
          >
            Cancel
          </button>
          <button
            type="submit"
            class="bg-blue-600 px-4 py-2 rounded-sm text-white cursor-pointer focus:outline-none focus:ring-3 focus:ring-blue-500"
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

const submit = () => {
  if (isEdit.value && props.track) {
    emit('update', { ...props.track, ...local });
  } else {
    emit('save', { ...local });
  }
};
</script>
