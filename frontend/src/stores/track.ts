import { defineStore } from 'pinia'
import { type Track } from '@/types/track'
import { ref } from 'vue'

export const useTracksStore = defineStore('trackStore', () => {

  const tracks = ref<Track[]>([])

  const addTrack = (track: Track) => {
    tracks.value.push(track)
  }

  const removeTrack = (trackId: number) => {
    console.log(`Removing track with ID: ${trackId}`)
    tracks.value = tracks.value.filter((track) => track.id !== trackId)
  }

  const getTrackById = (trackId: number) => {
    return tracks.value.find((track) => track.id === trackId)
  }

  return { tracks, addTrack, removeTrack, getTrackById }
})
