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
      <Loader v-show="loading">Sending your photo...</Loader>
      <form
        class="form-group my-2 mx-2 my-lg-0"
        v-on:submit.prevent="upload"
        v-show="!loading"
      >
        <Message />
        <div class="form-group">
          <label>Photo select</label>
          <input type="file" class="form-control" v-on:change="onFileChange" />
          <output v-if="preview">
            <img class="output py-2" :src="preview" alt="" />
          </output>
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

<script>
import Loader from "./Loader";
import Message from "./Message";

export default {
  components: {
    Loader,
    Message,
  },
  data: function () {
    return {
      preview: null,
      photo: null,
      loading: false,
    };
  },
  methods: {
    onFileChange: function (event) {
      if (event.target.files.length === 0) {
        this.reset();
        return false;
      }

      if (!event.target.files[0].type.match("image.*")) {
        return false;
      }

      //output用
      const reader = new FileReader();

      reader.onload = (e) => {
        this.preview = e.target.result;
      };
      reader.readAsDataURL(event.target.files[0]);

      //upload用
      this.photo = event.target.files[0];
      // console.log(event.target.files[0].name);
      // console.log(event.target.files[0].type);
      // console.log(event.target.files[0].size);
    },
    upload: async function () {
      if (!this.preview) {
        alert("ファイルを選択してね！");
        return false;
      }
      //loading components on
      this.loading = true;

      const formData = new FormData();
      formData.append("photo", this.photo);

      const response = await axios
        .post("/api/photo", formData)
        .catch((error) => error.response);

      //loading components off
      this.reset();
      this.loading = false;

      if (response.status === 201) {
        console.log("upload!");
        this.$store.commit("message/setContent", {
          content: "投稿できたよ！",
          timeout: 6000,
        });
      } else {
        console.log("error!");
        this.$store.commit("error/setAlert", true);
      }
    },
    reset: function () {
      this.preview = null;
      this.photo = null;
      this.$el.querySelector('input[type="file"]').value = null;
    },
  },
};
</script>
