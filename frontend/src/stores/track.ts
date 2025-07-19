import { defineStore } from 'pinia';
import { ref } from 'vue';
import type { Track, TrackRequest } from '@/types/track';
import { api } from '@/api';

export const useTracksStore = defineStore('tracks', () => {
  const tracks = ref<Track[]>([]);
  const loading = ref(false);
  const error = ref<string | null>(null);

  const wrapRequest = async <T>(fn: () => Promise<T>) => {
    loading.value = true;
    error.value = null;
    try {
      return await fn();
    } catch (err: unknown) {
      error.value = err instanceof Error ? err.message : String(err);
      return undefined;
    } finally {
      loading.value = false;
    }
  };

  const fetchTracks = async () => {
    const data = await wrapRequest(() => api.fetchTracks());
    if (data) tracks.value = data;
  };

  const createTrack = async (payload: TrackRequest) => {
    const newTrack = await wrapRequest(() => api.createTrack(payload));
    if (newTrack) {
      tracks.value.push(newTrack);
      return true;
    }
    return false;
  };

  const updateTrack = async (id: number, payload: TrackRequest) => {
    const updated = await wrapRequest(() => api.updateTrack(id, payload));
    if (updated) {
      const idx = tracks.value.findIndex((t) => t.id === id);
      if (idx !== -1) {
        tracks.value.splice(idx, 1, updated);
      }
      return true;
    }
    return false;
  };

  return {
    tracks,
    loading,
    error,
    fetchTracks,
    createTrack,
    updateTrack,
  };
});
