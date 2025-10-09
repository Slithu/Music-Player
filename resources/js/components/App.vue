<template>
  <div class="min-h-screen bg-gray-100 text-gray-900">
    <nav class="p-4 bg-indigo-600 text-white flex gap-4">
      <router-link to="/">🏠 Home</router-link>
      <router-link to="/songs">🎵 Utwory</router-link>
      <router-link to="/playlists">📂 Playlisty</router-link>
    </nav>

    <main class="p-6">
      <router-view />
    </main>
  </div>
</template>

<script setup>
// Brak logiki – prosty layout
</script>
