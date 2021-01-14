<template>
  <div
    class="mb-1 border border-success rounded text-secondary bg-ok text-center"
    v-show="message"
  >
    {{ message }}
  </div>
</template>

<script>
export default {
  computed: {
    message: function () {
      return this.$store.state.message.content;
    },
  },
};
</script>
