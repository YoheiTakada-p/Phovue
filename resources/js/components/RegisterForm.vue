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
      Register
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <form class="form-group my-2 mx-2 my-lg-0" v-on:submit.prevent="register">
        <div class="form-group">
          <label>Name</label>
          <input
            type="text"
            class="form-control"
            placeholder="Enter name"
            v-bind:value="registerForm.name"
            v-on:input="registerForm.name = $event.target.value"
          />
        </div>
        <div class="form-group">
          <label>Email address</label>
          <input
            type="email"
            class="form-control"
            placeholder="Enter email"
            v-model="registerForm.email"
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
            v-model="registerForm.password"
          />
        </div>
        <div class="form-group">
          <label>Password confirm</label>
          <input
            type="password_confirmation"
            class="form-control"
            placeholder="Password confirm"
            v-model="registerForm.password_confirmation"
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
      registerForm: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  methods: {
    register: async function () {
      await this.$store.dispatch("auth/register", this.registerForm);

      console.log(this.$store.getters["auth/user"]);

      this.$router.push("/", () => {});
    },
  },
};
</script>
