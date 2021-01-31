import Vue from 'vue';
import VueRouter from 'vue-router';
import BooksList from '@/views/BooksList.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'Books',
    component: BooksList,
  },
  {
    path: '/book/add',
    name: 'Books',
    component: () => import('../views/AddBook.vue'),
  },
  {
    path: '/book/:id',
    name: 'Books',
    component: () => import('../views/BookDetail.vue'),
  },
];

const router = new VueRouter({
  mode: 'history',
  base: '/',
  routes,
});

export default router;
