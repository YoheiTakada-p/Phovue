<template>
  <div class="card">
    <div class="position-relative">
      <img class="card-img" alt="..." :src="photo.url" />
      <a
        class="card-img-overlay"
        data-toggle="collapse"
        :href="'#collapse-comment-' + photo.id"
        role="button"
        aria-expanded="false"
        :aria-controls="'collapse-comment-' + photo.id"
      ></a>
    </div>
    <div class="card-body" style="padding: 0.7rem">
      <div class="collapse" :id="'collapse-comment-' + photo.id">
        <div>
          <p class="text-justify">サンプルコメント</p>
        </div>
      </div>
      <div class="d-flex justify-content-between">
        <span class="my-auto">{{ photo.owner.name }}</span>
        <div>
          <button
            v-if="isLogin == false"
            v-on:click.prevent="alert"
            class="btn btn-sm btn-gray"
          >
            <i class="fas fa-heart" style="color: white"></i
            >{{ photo.like_count }}
          </button>
          <button
            v-else-if="photo.liked_by_user == true"
            v-on:click.prevent="unlike(photo.id)"
            class="btn btn-sm btn-gray"
          >
            <i class="fas fa-heart" style="color: pink"></i
            >{{ photo.like_count }}
          </button>
          <button
            v-else-if="photo.liked_by_user == false"
            v-on:click.prevent="like(photo.id)"
            class="btn btn-sm btn-gray"
          >
            <i class="fas fa-heart" style="color: white"></i
            >{{ photo.like_count }}
          </button>
          <a
            :href="'/photos/' + photo.id + '/download'"
            class="btn btn-sm btn-gray"
          >
            <i class="fas fa-download" style="color: white"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    photo: {
      type: Object,
      required: true,
    },
  },
  computed: {
    isLogin: function () {
      return this.$store.getters["auth/check"];
    },
  },
  methods: {
    alert: function () {
      return alert("いいね機能はログインが必要だよ！");
    },
    like: async function (id) {
      console.log("いいねする");
      const response = await axios.put("/api/photo/" + id + "/like");
      console.log("いいねできた");
    },
    unlike: async function (id) {
      console.log("いいね削除する");
      const response = await axios.delete("/api/photo/" + id + "/like");
      console.log("いいね消せた");
    },
  },
};
</script>
