<script>
export default {
  props: ["longUrl"],
  methods: {
    getClicksNumber(longUrl) {
      return longUrl.short_urls.reduce(
        (totalClicks, shortUrl) => totalClicks + shortUrl.clicks,
        0
      );
    },
  },
};
</script>

<template>
  <!-- Start -->
  <div class="rounded overflow-hidden shadow-lg flex flex-col">
    <a href="#"></a>
    <div class="relative">
      <a href="#">
        <div
          class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"
        ></div>
      </a>
    </div>
    <div class="px-6 py-4 mb-auto">
      <a
        v-bind:href="longUrl.content"
        class="font-medium underline inline-block hover:text-indigo-600 transition duration-500 ease-in-out inline-block mb-2"
        >{{ longUrl.content }}</a
      >
      <p class="text-gray-500 text-sm">
        This url has been shortened {{ longUrl.short_urls_count }} times
      </p>
    </div>
    <div
      class="px-6 py-3 flex flex-row items-center justify-between bg-gray-100"
    >
      <span
        href="#"
        class="py-1 text-xs font-regular text-gray-900 mr-1 flex flex-row items-center"
      >
        <svg
          width="22"
          height="22"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M13.172 5.717l2.71-1.297.432.902-2.865 1.372zm.203-4.301l-.943-.333-1.028 2.915.872.535zm-9.219 8.616l.432.902 2.865-1.37-.587-.829zM6.978 2.03L8.06 4.291l.902-.431L7.88 1.599zm-.342 4.25L3.72 5.252l-.332.943 3.117 1.1zM21.813 15H16.36l3.032 6.049-3.94 1.981-3.106-6.152L9 21.462V5.65zm-7.074-1h4.007L10 7.618v10.777l2.501-3.427 3.393 6.72 2.155-1.084z"
          />
          <path fill="none" d="M0 0h24v24H0z" />
        </svg>
        <span class="ml-1">{{ getClicksNumber(longUrl) }}</span>
      </span>
    </div>
  </div>
  <!-- End -->
</template>
