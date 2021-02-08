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
        <div class="px-1">
          <p class="text-justify pl-1">{{ photo.user_comment }}</p>
          <div
            class="d-flex flex-row-reverse border-top border-bottom py-1"
            v-if="photo.owner.id == userId"
          >
            <button
              class="btn btn-sm btn-gray mr-1"
              v-on:click.prevent="postDelete(photo.id)"
            >
              <i class="fas fa-trash" style="color: red"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-between pt-1 mx-1">
        <span class="my-auto pl-1">{{ photo.owner.name }}</span>
        <div class="mr-1">
          <button
            v-if="isLogin == false"
            v-on:click.prevent="alert"
            class="btn btn-sm btn-gray"
          >
            <i class="fas fa-heart" style="color: white"></i>{{ like_count }}
          </button>
          <button
            v-else-if="liked_by_user == true"
            v-on:click.prevent="unlike(photo.id)"
            class="btn btn-sm btn-gray"
          >
            <i class="fas fa-heart" style="color: pink"></i>{{ like_count }}
          </button>
          <button
            v-else-if="liked_by_user == false"
            v-on:click.prevent="like(photo.id)"
            class="btn btn-sm btn-gray"
          >
            <i class="fas fa-heart" style="color: white"></i>{{ like_count }}
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
  data: function () {
    return {
      like_count: this.photo.like_count,
      liked_by_user: this.photo.liked_by_user,
    };
  },
  computed: {
    isLogin: function () {
      return this.$store.getters["auth/check"];
    },
    userId: function () {
      return this.$store.getters["auth/user_id"];
    },
  },
  methods: {
    alert: function () {
      return alert("いいね機能はログインが必要だよ！");
    },
    like: async function (id) {
      console.log("いいねする");
      const response = await axios
        .put("/api/photo/" + id + "/like")
        .catch((error) => error.response);

      if (response.status === 200) {
        this.liked_by_user = !this.liked_by_user;
        this.like_count++;
        console.log("いいねできた");
      } else {
        console.log("error!");
        this.$store.commit("error/setAlert", true);
      }
    },
    unlike: async function (id) {
      console.log("いいね削除する");
      const response = await axios
        .delete("/api/photo/" + id + "/like")
        .catch((error) => error.response);

      if (response.status === 200) {
        this.liked_by_user = !this.liked_by_user;
        this.like_count--;
        console.log("いいね消せた");
      } else {
        console.log("error!");
        this.$store.commit("error/setAlert", true);
      }
    },
    postDelete: async function (id) {
      console.log("投稿削除");
      const response = await axios
        .delete("/api/photo/" + id + "/delete")
        .catch((error) => error.response);

      if (response.status === 200) {
        this.$store.commit("utility/setReacquirePhotos", true);
        console.log("投稿削除できた");
      } else {
        console.log("error!");
        this.$store.commit("error/setAlert", true);
      }
    },
  },
};
</script>
