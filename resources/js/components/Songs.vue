<script setup>
import { ref, onMounted } from 'vue'

const songs = ref([])

// Pobranie utworów
async function fetchSongs() {
  const res = await fetch('/api/jamendo/tracks?limit=10')
  songs.value = await res.json()
}

onMounted(() => {
  fetchSongs()
})
</script>

<template>
  <div>
    <ul>
      <li v-for="song in songs" :key="song.id">
        <h3>{{ song.title }} - {{ song.artist }}</h3>
        <audio :src="song.file_path" controls></audio>
        <img v-if="song.cover_path" :src="song.cover_path" alt="cover" width="100"/>
        <p v-if="song.tags">Gatunki: {{ song.tags.join(', ') }}</p>
      </li>
    </ul>
  </div>
</template>
