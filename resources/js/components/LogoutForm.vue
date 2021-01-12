<template>
  <li class="nav-item">
    <div>
      <a class="nav-link" href="#" v-on:click.prevent="logout">Logout</a>
    </div>
  </li>
</template>

<script>
export default {
  methods: {
    logout: async function () {
      this.$store.dispatch("auth/logout");
    },
  },
};
</script>
