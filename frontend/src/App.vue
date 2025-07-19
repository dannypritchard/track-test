<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router';
</script>

<template>
  <header class="bg-white shadow-sm">
    <div class="container mx-auto px-4">
      <nav class="flex space-x-6 py-4">
        <RouterLink
          to="/"
          class="cursor-pointer text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-3 focus:ring-indigo-500"
        >
          Home
        </RouterLink>
        <RouterLink
          to="/about"
          class="cursor-pointer text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-3 focus:ring-indigo-500"
        >
          About
        </RouterLink>
      </nav>
    </div>
  </header>

  <RouterView />
</template>
<style scoped></style>
