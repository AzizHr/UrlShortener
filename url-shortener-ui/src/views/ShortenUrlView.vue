<script>
import axios from "axios";

export default {
  data() {
    return {
      prefix: "http://127.0.0.1:8000/api/",
      longUrls: [],
      content: "",
      longUrlId: 0,
      shortUrl: "",
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

  methods: {
    save() {
      const formdata = new FormData();
      formdata.append("content", this.content);
      if (this.content != "") {
        axios({
          url: "http://127.0.0.1:8000/api/long-urls/create",
          method: "post",
          data: formdata,
        })
          .then((response) => {
            // after sucess
            this.longUrlId = response.data.id;
            console.log(response.data.message);
          })
          .catch((error) => {
            // handle error
            console.log(error.response.data);
          });
      } else {
        alert("Please provide a url");
      }
    },
    shorten() {
      if (this.content != "") {
        axios({
          url: `http://127.0.0.1:8000/api/long-urls/${this.longUrlId}/shorten`,
          method: "post",
        })
          .then((response) => {
            // after sucess
            this.shortUrl = this.prefix + response.data.short_url;
            console.log(response.data.short_url);
          })
          .catch((error) => {
            // handle error
            console.log(error.response.data);
          });
      } else {
        alert("Please provide a url");
      }
    },
    reset() {
      this.content = "";
    },
  },
};
</script>

<template>
  <div class="grid gap-10 text-center">
    <div class="flex gap-10 md:w-1/2 w-full md:px-0 px-10 mx-auto mt-32">
      <input
        type="text"
        placeholder="Paste your URL here"
        class="px-4 py-3 rounded-sm w-[80%] border border-gray-500"
        v-model="content"
        @change="save()"
      />
      <button
        class="bg-green-600 shadow-sm shadow-green-700 px-3 py-2 rounded-sm text-gray-100 font-bold capitalize justify-self-center"
        @click="shorten()"
      >
        generate
      </button>
    </div>
    <a
      v-bind:href="shortUrl"
      v-if="shortUrl != null"
      class="text-blue-600 underline"
      >{{ shortUrl }}</a
    >
  </div>
</template>