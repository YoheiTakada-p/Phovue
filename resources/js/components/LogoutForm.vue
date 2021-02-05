<template>
  <li class="nav-item">
    <div>
      <a class="nav-link" href="" v-on:click.prevent="logout">ログアウト</a>
    </div>
  </li>
</template>

<script>
export default {
  methods: {
    logout: async function () {
      await this.$store.dispatch("auth/logout");
    },
  },
};
</script>
