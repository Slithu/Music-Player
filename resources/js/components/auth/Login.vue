<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()
const email = ref('')
const password = ref('')
const error = ref('')

const login = async () => {
  error.value = ''
  try {
    const res = await axios.post('/api/login', {
      email: email.value,
      password: password.value
    })
    localStorage.setItem('token', res.data.access_token)
    axios.defaults.headers.common['Authorization'] = `Bearer ${res.data.access_token}`
    router.push('/')
  } catch (e) {
    error.value = e.response?.data?.message || 'Login failed'
  }
}
</script>

<template>
  <div class="min-h-screen flex items-start justify-center bg-gradient-to-br from-indigo-50 to-indigo-100 p-4 pt-20">
    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md border border-gray-200">
      <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Login</h2>

      <div v-if="error" class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center font-medium">
        {{ error }}
      </div>

      <input
        v-model="email"
        type="email"
        placeholder="Email"
        class="w-full p-4 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
      />
      <input
        v-model="password"
        type="password"
        placeholder="Password"
        class="w-full p-4 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
      />

      <button
        @click="login"
        class="w-full bg-indigo-600 text-white p-4 rounded-lg hover:bg-indigo-700 transition font-semibold shadow-md"
      >
        Login
      </button>
    </div>
  </div>
</template>
