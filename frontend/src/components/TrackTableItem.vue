<template>
  <li class="track-item">
    <template v-if="!editMode">
      <span>{{ track.title }} — {{ track.artist }}</span>
      <span v-if="track.duration">Duration: {{ track.duration }} seconds</span>
      <span v-if="track.isrc">ISRC: {{ track.isrc }}</span>
      <button @click="editMode = true">Edit</button>
    </template>

    <template v-else>
      <input v-model="editTitle" />
      <button @click="save">Save</button>
      <button @click="cancel">Cancel</button>
    </template>
  </li>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import type { Track } from '@/types/track';

const props = defineProps<{ track: Track }>();
const emit = defineEmits<{
  (e: 'update', id: number, newTitle: string): void;
}>();

const editMode = ref(false);
const editTitle = ref(props.track.title);

const save = () => {
  if (editTitle.value.trim()) {
    emit('update', props.track.id, editTitle.value.trim());
  }
  editMode.value = false;
};

const cancel = () => {
  editTitle.value = props.track.title;
  editMode.value = false;
};
</script>
