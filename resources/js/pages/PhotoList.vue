<template>
  <div class="container mt-3">
    <div class="card-columns">
      <PhotoCard
        v-for="photo in photos"
        v-bind:key="photo.id"
        v-bind:photo="photo"
      />
    </div>
  </div>
</template>

<script>
import PhotoCard from "../components/PhotoCard";

export default {
  components: {
    PhotoCard,
  },
  data: function () {
    return {
      photos: [],
    };
  },
  methods: {
    fetchPhotos: async function () {
      console.log("写真取得");
      const response = await axios
        .get("/api/photo")
        .catch((error) => error.response);

      if (response.status === 200) {
        this.photos = response.data;
      } else {
        this.$store.commit("error/setCode", response.status);
      }
    },
  },
  watch: {
    $route: {
      handler: async function () {
        await this.fetchPhotos();
      },
      immediate: true,
    },
  },
};
</script>
