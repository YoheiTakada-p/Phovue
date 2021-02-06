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
      登録
    </a>
    <div class="dropdown-menu form-size" aria-labelledby="navbarDropdown">
      <form class="form-group my-2 mx-2 my-lg-0" v-on:submit.prevent="register">
        <div
          class="mb-1 border border-danger rounded text-secondary bg-error"
          v-if="registerErrors"
        >
          <ul v-if="registerErrors.name">
            <li v-for="msg in registerErrors.email" :key="msg">{{ msg }}</li>
          </ul>
          <ul v-if="registerErrors.email">
            <li v-for="msg in registerErrors.email" :key="msg">{{ msg }}</li>
          </ul>
          <ul v-if="registerErrors.password">
            <li v-for="msg in registerErrors.password" :key="msg">{{ msg }}</li>
          </ul>
        </div>
        <div class="form-group">
          <label>名前</label>
          <input
            type="text"
            class="form-control"
            placeholder="名前をここに入力"
            v-bind:value="registerForm.name"
            v-on:input="registerForm.name = $event.target.value"
            required
          />
        </div>
        <div class="form-group">
          <label>メールアドレス</label>
          <input
            type="email"
            class="form-control"
            placeholder="メールアドレスをここに入力"
            v-model="registerForm.email"
            required
          />
        </div>
        <div class="form-group">
          <label>パスワード</label>
          <input
            type="password"
            class="form-control"
            placeholder="パスワードをここに入力"
            v-model="registerForm.password"
            required
          />
        </div>
        <div class="form-group">
          <label>確認用パスワード</label>
          <input
            type="password"
            class="form-control"
            placeholder="同じパスワードをここに入力"
            v-model="registerForm.password_confirmation"
            required
          />
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
      </form>
    </div>
  </li>
</template>

<script>
export default {
  data: function () {
    return {
      registerForm: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  computed: {
    registerErrors: function () {
      return this.$store.state.auth.registerErrorMessages;
    },
  },
  methods: {
    register: async function () {
      await this.$store.dispatch("auth/register", this.registerForm);
      this.registerForm.password = "";
      this.registerForm.password_confirmation = "";
    },
    clearError: function () {
      this.$store.commit("auth/setRegisterErrorMessages", null);
    },
  },
  created() {
    this.clearError();
  },
};
</script>
