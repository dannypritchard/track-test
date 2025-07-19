import { createRouter, createWebHistory } from 'vue-router';
import Index from '@/views/IndexView.vue';
import About from '@/views/AboutView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Index,
    },
    {
      path: '/about',
      name: 'about',
      component: About,
    },
  ],
});

export default router;
