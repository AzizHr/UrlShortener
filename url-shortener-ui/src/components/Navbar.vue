<script setup></script>

<template>
  <nav
    class="flex justify-center items-center justify-between px-16 py-6 shadow-sm shadow-green-400"
  >
    <RouterLink to="/" class="font-bold">Url-Shortener</RouterLink>
    <ul class="flex gap-6">
      <RouterLink to="/">Home</RouterLink>
      <RouterLink to="/shorten-a-url">Shorten a URL</RouterLink>
      <RouterLink to="/urls-stats">Urls Statistics</RouterLink>
    </ul>
  </nav>
</template>
