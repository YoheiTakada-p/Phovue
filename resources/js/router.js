import Vue from 'vue';
import VueRouter from 'vue-router';

import Sample from './components/Sample.vue'

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: Sample
    }
  ]
})
export default router;
