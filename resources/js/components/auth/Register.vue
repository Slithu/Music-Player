<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const errors = ref([]);

const register = async () => {
  errors.value = [];
  try {
    await axios.post('/api/register', {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value
    });

    // Po poprawnej rejestracji przekieruj na login
    router.push('/login');
  } catch (err) {
    if (err.response?.data?.errors) {
      errors.value = Object.values(err.response.data.errors).flat();
    } else if (err.response?.data?.message) {
      errors.value = [err.response.data.message];
    } else {
      errors.value = ['Something went wrong.'];
    }
  }
};
</script>

<template>
  <div class="min-h-screen flex items-start justify-center bg-gradient-to-br from-indigo-50 to-indigo-100 p-4 pt-20">
    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md border border-gray-200">
      <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Register</h2>

      <ul v-if="errors.length" class="mb-4 bg-red-100 text-red-700 p-3 rounded">
        <li v-for="(err, idx) in errors" :key="idx" class="mb-1 font-medium">
          {{ err }}
        </li>
      </ul>

      <input
        v-model="name"
        type="text"
        placeholder="Name"
        class="w-full p-4 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
      />
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
        class="w-full p-4 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
      />
      <input
        v-model="password_confirmation"
        type="password"
        placeholder="Confirm Password"
        class="w-full p-4 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
      />

      <button
        @click="register"
        class="w-full bg-indigo-600 text-white p-4 rounded-lg hover:bg-indigo-700 transition font-semibold shadow-md"
      >
        Register
      </button>
    </div>
  </div>
</template>
