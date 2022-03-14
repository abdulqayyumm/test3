import UserOverview from '../views/Users/UserOverview.vue'
import UserEdit from '../views/Users/UserEdit.vue'

export default {
  routes: [
    {
      path: '/',
      name: 'UserOverview',
      component: UserOverview
    },
    {
        path: '/edit/:id',
        name: 'UserEdit',
        component: UserEdit
      }
  ]
};