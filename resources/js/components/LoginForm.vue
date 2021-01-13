<template>
  <li class="nav-item dropdown">
    <a
      class="nav-link dropdown-toggle"
      href="#"
      id="navbarDropdown"
      role="button"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >
      Login
    </a>
    <div class="dropdown-menu form-size" aria-labelledby="navbarDropdown">
      <form class="form-group my-2 mx-2 my-lg-0" v-on:submit.prevent="login">
        <div
          class="mb-1 border border-danger rounded text-secondary bg-error"
          v-if="loginErrors"
        >
          <ul v-if="loginErrors.email">
            <li v-for="msg in loginErrors.email" :key="msg">{{ msg }}</li>
          </ul>
          <ul v-if="loginErrors.password">
            <li v-for="msg in loginErrors.password" :key="msg">{{ msg }}</li>
          </ul>
        </div>
        <div class="form-group">
          <label>Email address</label>
          <input
            type="email"
            class="form-control"
            placeholder="Enter email"
            v-model="loginForm.email"
            required
          />
          <small class="form-text text-muted"
            >We'll never share your email with anyone else.</small
          >
        </div>
        <div class="form-group">
          <label>Password</label>
          <input
            type="password"
            class="form-control"
            placeholder="Password"
            v-model="loginForm.password"
            required
          />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </li>
</template>

<script>
export default {
  data: function () {
    return {
      loginForm: {
        email: "",
        password: "",
      },
    };
  },
  computed: {
    loginErrors: function () {
      return this.$store.state.auth.loginErrorMessages;
    },
  },
  methods: {
    login: async function () {
      await this.$store.dispatch("auth/login", this.loginForm);
      this.loginForm.password = "";
    },
    clearError() {
      this.$store.commit("auth/setLoginErrorMessages", null);
    },
  },
  created() {
    this.clearError();
  },
};
</script>
