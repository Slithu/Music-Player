<template>
  <div class="min-h-screen bg-gray-100 text-gray-900">
    <!-- Header / Nav -->
    <nav class="p-4 bg-indigo-600 text-white flex justify-between items-center">
      <div class="font-bold text-lg">🎵 Music Player</div>
      <div class="flex gap-4 items-center">
        <router-link to="/" class="hover:underline">🏠 Home</router-link>
        <router-link to="/songs" class="hover:underline">🎵 Utwory</router-link>
        <router-link to="/playlists" class="hover:underline">📂 Playlisty</router-link>

        <!-- Zalogowany użytkownik -->
        <div v-if="user" class="ml-4 flex items-center gap-2">
          <span>Hi, {{ user.name }}</span>
          <button
            @click="logout"
            class="bg-white text-indigo-600 px-3 py-1 rounded hover:bg-gray-200 transition"
          >
            Logout
          </button>
        </div>

        <!-- Niezalogowany -->
        <div v-else class="ml-4 flex gap-2">
          <router-link
            to="/login"
            class="bg-white text-indigo-600 px-3 py-1 rounded hover:bg-gray-200 transition"
          >Login</router-link>
          <router-link
            to="/register"
            class="bg-white text-indigo-600 px-3 py-1 rounded hover:bg-gray-200 transition"
          >Register</router-link>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="p-6">
      <router-view />
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();
const user = ref(null);

const fetchUser = async () => {
  const token = localStorage.getItem('token');
  if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    try {
      // Tutaj poprawny endpoint
      const res = await axios.get('/api/me');
      user.value = res.data;
    } catch {
      localStorage.removeItem('token');
      user.value = null;
    }
  }
};

const logout = async () => {
  const token = localStorage.getItem('token');
  if (token) {
    try {
      await axios.post('/api/logout'); // opcjonalnie powiadom backend
    } catch {}
  }
  localStorage.removeItem('token');
  user.value = null;
  router.push('/login');
};

onMounted(() => {
  fetchUser();
});
</script>
