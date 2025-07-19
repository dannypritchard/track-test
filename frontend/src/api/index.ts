import type { Track, TrackRequest } from '@/types/track';

const baseUrl = 'http://localhost:8000/api';

export const api = {
  async fetchTracks() {
    const tracksResponse = await fetch(`${baseUrl}/tracks`);
    if (!tracksResponse.ok) {
      throw new Error(tracksResponse.statusText);
    }
    return (await tracksResponse.json()) as Track[];
  },

  async createTrack(track: TrackRequest) {
    const response = await fetch(`${baseUrl}/tracks`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(track),
    });

    if (!response.ok) {
      throw new Error(response.statusText);
    }

    return (await response.json()) as Track;
  },

  async updateTrack(id: number, track: TrackRequest) {
    const response = await fetch(`${baseUrl}/tracks/${id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(track),
    });

    if (!response.ok) {
      throw new Error(response.statusText);
    }

    return (await response.json()) as Track;
  },
};
