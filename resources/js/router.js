import Vue from 'vue';
import VueRouter from 'vue-router';

import PhotoList from './pages/PhotoList.vue';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: PhotoList
    },
  ]
});

export default router;
