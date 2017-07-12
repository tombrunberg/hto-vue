import Vue from 'vue'
import Router from 'vue-router'
import Calendar from '@/components/Calendar'
import Guide from '@/components/Guide'
// import Hello from '@/components/Hello'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Calendar',
      component: Calendar
    },
    {
      path: '/guide',
      name: 'Guide',
      component: Guide
    }
  ]
})
