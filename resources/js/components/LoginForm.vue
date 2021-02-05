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
      ログイン
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
          <label>メールアドレス</label>
          <input
            type="email"
            class="form-control"
            placeholder="メールアドレスを入力してね"
            v-model="loginForm.email"
            required
          />
        </div>
        <div class="form-group">
          <label>パスワード</label>
          <input
            type="password"
            class="form-control"
            placeholder="パスワードを入力してね"
            v-model="loginForm.password"
            required
          />
        </div>
        <button type="submit" class="btn btn-primary">送信</button>
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
