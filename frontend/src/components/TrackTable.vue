<!-- TrackTable.vue -->
<template>
  <table class="min-w-full divide-y divide-gray-200 border-collapse">
    <thead>
      <tr class="bg-gray-100">
        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border border-gray-200">
          Title
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border border-gray-200">
          Artist
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border border-gray-200">
          Duration
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border border-gray-200">
          ISRC
        </th>
        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 border border-gray-200">
          Actions
        </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      <tr v-for="t in tracks" :key="t.id" class="hover:bg-gray-50">
        <td
          class="px-6 py-4 text-sm text-gray-900 border border-gray-200 whitespace-normal break-all"
        >
          {{ t.title }}
        </td>
        <td
          class="px-6 py-4 text-sm text-gray-900 border border-gray-200 whitespace-normal break-all"
        >
          {{ t.artist }}
        </td>
        <td class="px-6 py-4 text-sm text-gray-900 border border-gray-200 whitespace-normal">
          {{ formatTime(t.duration) }}
        </td>
        <td
          class="px-6 py-4 text-sm text-gray-900 border border-gray-200 whitespace-normal break-keep"
        >
          {{ t.isrc }}
        </td>
        <td class="px-6 py-4 text-sm text-gray-900 border border-gray-200 whitespace-normal">
          <button
            @click="$emit('edit', t)"
            class="px-4 py-2 font-medium text-white bg-blue-600 rounded-sm hover:bg-blue-700 focus:outline-none focus:ring-3 focus:ring-blue-500 text-sm cursor-pointer"
          >
            Edit
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script setup lang="ts">
import type { Track } from '@/types/track';

defineProps<{ tracks: Track[] }>();
defineEmits<{
  (e: 'edit', track: Track): void;
}>();

const formatTime = (seconds: number) => {
  const m = Math.floor(seconds / 60);
  const s = seconds % 60;
  const mm = String(m).padStart(2, '0');
  const ss = String(s).padStart(2, '0');
  return `${mm}:${ss}`;
};
</script>
