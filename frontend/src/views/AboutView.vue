<template>
  <div>
    <h1 class="mb-4 text-4xl font-extrabold text-gray-900">About</h1>

    <p class="mb-6 text-lg text-gray-700">I made the following considerations during development</p>

    <section class="mb-8">
      <h2 class="mb-3 text-2xl font-semibold text-gray-800">Backend</h2>
      <ul class="list-disc list-inside space-y-2 text-gray-700">
        <li>
          Upgraded to Symfony 6.4 for the backend - latest LTS version with lots of nice to haves
          and security fixes
        </li>
        <li>
          Repository pattern with attribute-bound controller input DTOs for clear separation between
          request data and database entities - no services required
        </li>
        <li>Nelmio CORS Bundle for handling cross-origin requests</li>
      </ul>
    </section>

    <section>
      <h2 class="mb-3 text-2xl font-semibold text-gray-800">UI</h2>
      <ul class="list-disc list-inside space-y-2 text-gray-700">
        <li>TypeScript over JS for better type safety</li>
        <li>
          Fetch instead of Axios, as Axios is currently understaffed and has many bugs (over 500
          open issues at time of writing)
        </li>
        <li>Pinia for state management cross-component communication</li>
        <li>Tailwind CSS for styling for faster development iteration</li>
      </ul>
    </section>
  </div>
</template>
