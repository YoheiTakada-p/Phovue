import Vue from 'vue';
import VueRouter from 'vue-router';

import PhotoList from './pages/PhotoList.vue';
import SystemError from './pages/errors/System.vue';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: PhotoList
    },
    {
      path: '/500',
      component: SystemError
    }
  ]
});

export default router;
