import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import UrlsStatsViewVue from '@/views/UrlsStatsView.vue'
import ShortenUrlViewVue from '@/views/ShortenUrlView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/urls-stats',
      name: 'urlsStats',
      component: UrlsStatsViewVue
    },
    {
      path: '/shorten-a-url',
      name: 'shortenAUrl',
      component: ShortenUrlViewVue
    }
  ]
})

export default router
