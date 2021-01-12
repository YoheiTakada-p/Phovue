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
      Photo
    </a>
    <div class="dropdown-menu photo-form" aria-labelledby="navbarDropdown">
      <form class="form-group my-2 mx-2 my-lg-0">
        <div class="form-group">
          <label>Photo select</label>
          <input type="file" class="form-control" />
        </div>
        <div class="form-group">
          <label for="Textarea1">Comment</label>
          <textarea class="form-control" id="Textarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </li>
</template>
