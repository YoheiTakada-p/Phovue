<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <router-link class="navbar-brand" to="/">phovue</router-link>
    <span class="navbar-text" v-show="isLogin == true"
      >ようこそ、{{ username }}！</span
    >
    <span class="navbar-text" v-show="isLogin == false"
      >ログインして写真を投稿してみよう！</span
    >
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <LoginForm v-if="isLogin == false" />
        <RegisterForm v-if="isLogin == false" />
        <PhotoForm v-if="isLogin == true" />
        <LogoutForm v-if="isLogin == true" />
      </ul>
    </div>
  </nav>
</template>

<script>
import LoginForm from "./LoginForm";
import LogoutForm from "./LogoutForm";
import PhotoForm from "./PhotoForm";
import RegisterForm from "./RegisterForm";

export default {
  components: {
    LoginForm,
    PhotoForm,
    LogoutForm,
    RegisterForm,
  },
  computed: {
    isLogin: function () {
      return this.$store.getters["auth/check"];
    },
    username: function () {
      return this.$store.getters["auth/username"];
    },
  },
};
</script>
