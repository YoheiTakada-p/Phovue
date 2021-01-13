<template>
  <div>
    <header>
      <Navbar />
    </header>
    <main>
      <router-view />
    </main>
  </div>
</template>

<script>
import Navbar from "./components/Navbar.vue";

export default {
  components: {
    Navbar,
  },
  computed: {
    errorCode: function () {
      return this.$store.state.error.code;
    },
    errorAlert: function () {
      return this.$store.state.error.alert;
    },
  },
  watch: {
    errorCode: {
      handler: function (value) {
        if (value === 500) {
          alert("システムエラーが発生しました");
          this.$router.push("/500");
          this.$store.commit("error/setCode", null);
        }
      },
      immediate: true,
    },
    errorAlert: {
      handler: function (value) {
        if (value) {
          alert("500:システムエラーが発生しました");
          this.$store.commit("error/setAlert", null);
        }
      },
      immediate: true,
    },
  },
};
</script>
