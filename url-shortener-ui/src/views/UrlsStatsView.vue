<script>
import axios from "axios";
import UrlComponent from "@/components/UrlComponent.vue";

export default {
  components: {
    UrlComponent,
  },
  data() {
    return {
      longUrls: [],
    };
  },
  mounted() {
    axios
      .get("http://127.0.0.1:8000/api/long-urls")
      .then((response) => {
        // handle success
        this.longUrls = response.data;
        console.log(response.data);
      })
      .catch((error) => {
        // handle error
        console.log(error.message);
      })
      .finally(() => {
        // always executed
        console.log("Always executed!");
      });
  },

  methods: {},
};
</script>

<template>
  <h1 class="text-2xl fonr-bold ml-20 mt-20 uppercase">urls statistics</h1>
  <hr class="mx-20 mt-4" />
  <div
    class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10 mx-20"
  >
    <!-- Start -->
    <UrlComponent
      v-for="longUrl in longUrls"
      v-bind:key="longUrl.id"
      :longUrl="longUrl"
    />
    <!-- End -->
  </div>
  <span class="ml-24" v-if="longUrls.length === 0"> No urls found! </span>
</template>
