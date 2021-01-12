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
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <form class="form-group my-2 mx-2 my-lg-0">
        <div class="form-group">
          <label>Email address</label>
          <input type="email" class="form-control" placeholder="Enter email" />
          <small class="form-text text-muted"
            >We'll never share your email with anyone else.</small
          >
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" placeholder="Password" />
        </div>
        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          <div class="col-6 text-center m-auto">
            <router-link to="/register">Register</router-link>
          </div>
        </div>
      </form>
    </div>
  </li>
</template>
