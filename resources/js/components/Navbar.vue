<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <router-link class="navbar-brand" to="/">phovue</router-link>
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
        <LoginForm />
        <PhotoForm />
      </ul>
    </div>
  </nav>
</template>

<script>
import LoginForm from "./LoginForm";
import PhotoForm from "./PhotoForm";

export default {
  components: {
    LoginForm,
    PhotoForm,
  },
};
</script>
