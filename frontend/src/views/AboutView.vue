<template>
  <div class="container mx-auto px-4 py-8 max-w-3xl">
    <h1 class="mb-4 text-4xl font-extrabold text-gray-900">About</h1>

    <p class="mb-6 text-lg text-gray-700">I made the following considerations during development</p>

    <section class="mt-8">
      <h2 class="mb-3 text-2xl font-semibold text-gray-800">Backend</h2>
      <ul class="list-inside list-disc space-y-2 text-gray-700">
        <li>Symfony 7.3 for the backend framework—latest version with many improvements</li>
        <li>
          Repository pattern with attribute-bound controller DTOs and entities for clear separation
          of concerns
        </li>
        <li>
          Validation for ISRC regex format in the DTO to keep validation out of the persistence
          layer
        </li>
        <li>Nelmio CORS Bundle for handling cross-origin requests</li>
      </ul>
    </section>

    <section class="mt-8">
      <h2 class="mb-3 text-2xl font-semibold text-gray-800">UI</h2>
      <ul class="list-inside list-disc space-y-2 text-gray-700">
        <li>TypeScript over JS for better type safety</li>
        <li>
          Fetch instead of Axios as Axios is currently understaffed and has many bugs (over 500 open
          issues at time of writing)
        </li>
        <li>Pinia for state management instead of Vuex for modularity</li>
        <li>Tailwind CSS for styling instead of traditional CSS for faster development</li>
      </ul>
    </section>
  </div>
</template>
