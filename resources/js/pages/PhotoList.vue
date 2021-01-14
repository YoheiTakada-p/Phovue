<template>
  <div class="container mt-3">
    <div class="card-columns">
      <PhotoCard />
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
      item: null,
    };
  },
};
</script>
