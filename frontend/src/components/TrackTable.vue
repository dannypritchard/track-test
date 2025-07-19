<template>
  <table class="min-w-full border-collapse">
    <thead>
      <tr class="bg-gray-100">
        <th class="border border-gray-200 px-4 py-2 text-left">Title</th>
        <th class="border border-gray-200 px-4 py-2 text-left">Artist</th>
        <th class="border border-gray-200 px-4 py-2 text-left">Duration</th>
        <th class="border border-gray-200 px-4 py-2 text-left">ISRC</th>
        <th class="border border-gray-200 px-4 py-2 text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="t in tracks" :key="t.id" class="hover:bg-gray-50">
        <td class="border border-gray-200 px-4 py-2">{{ t.title }}</td>
        <td class="border border-gray-200 px-4 py-2">{{ t.artist }}</td>
        <td class="border border-gray-200 px-4 py-2">{{ formatTime(t.duration) }}</td>
        <td class="border border-gray-200 px-4 py-2">{{ t.isrc }}</td>
        <td class="border border-gray-200 px-4 py-2 text-center">
          <button
            @click="$emit('edit', t)"
            class="text-blue-600 cursor-pointer focus:outline-none focus:ring-3 focus:ring-blue-500"
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
