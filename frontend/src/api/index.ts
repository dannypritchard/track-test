import type { Track, TrackRequest } from '@/types/track';

const baseUrl = 'http://localhost:8000/api';

async function apiRequest<T>(url: string, opts?: RequestInit): Promise<T> {
  const res = await fetch(url, opts);
  const payload = await res.json().catch(() => ({}));

  if (!res.ok) {
    const message =
      ('detail' in payload && payload.detail) ?? res.statusText ?? `HTTP ${res.status}`;
    throw new Error(message);
  }

  return payload as T;
}
/**
 * TODO: object validation with zod/valibot/yup
 * We're assuming the API is stable and returns the expected data structure.
 */
export const api = {
  async fetchTracks() {
    return apiRequest<Track[]>(`${baseUrl}/tracks`);
  },

  async createTrack(track: TrackRequest) {
    return apiRequest<Track>(`${baseUrl}/tracks`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(track),
    });
  },

  async updateTrack(id: number, track: TrackRequest) {
    return apiRequest<Track>(`${baseUrl}/tracks/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(track),
    });
  },
};
