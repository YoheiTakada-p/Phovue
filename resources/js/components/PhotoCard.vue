<template>
  <div class="card">
    <div class="position-relative">
      <img class="card-img" alt="..." :src="item.url" />
      <a
        class="card-img-overlay"
        data-toggle="collapse"
        :href="'#collapse-comment-' + item.id"
        role="button"
        aria-expanded="false"
        :aria-controls="'collapse-comment-' + item.id"
      ></a>
    </div>
    <div class="card-body" style="padding: 0.7rem">
      <div class="collapse" :id="'collapse-comment-' + item.id">
        <div>
          <p class="text-justify">サンプルコメント</p>
        </div>
      </div>
      <div class="d-flex justify-content-between">
        <span class="my-auto">{{ item.owner.name }}</span>
        <div>
          <button class="btn btn-sm btn-gray">
            <i class="fas fa-heart" style="color: pink"></i>1
          </button>
          <a
            :href="'/photos/' + item.id + '/download'"
            class="btn btn-sm btn-gray"
          >
            <i class="fas fa-download" style="color: white"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
};
</script>
