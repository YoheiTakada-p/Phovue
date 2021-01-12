import Vue from 'vue';
import VueRouter from 'vue-router';

import PhotoList from './pages/PhotoList.vue';
import Register from './pages/Register.vue';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: PhotoList
    },
    {
      path: '/register',
      component: Register
    }
  ]
});

export default router;
