<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router';
</script>

<template>
  <header class="bg-white shadow-sm">
    <div class="mx-auto max-w-4xl px-4">
      <nav class="flex space-x-6 py-4">
        <RouterLink
          to="/"
          class="text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
          Home
        </RouterLink>
        <RouterLink
          to="/about"
          class="text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
          About
        </RouterLink>
      </nav>
    </div>
  </header>

  <main class="mx-auto max-w-4xl px-4 py-6">
    <RouterView />
  </main>
</template>
