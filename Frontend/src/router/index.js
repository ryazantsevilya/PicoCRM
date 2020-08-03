import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import CreateUser from '../views/CreateClient.vue'
import ClientsComponent from '../views/Clients'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    children: [
      {
        path: '/create',
        name: 'create-client',
        component: CreateUser
      },
      {
        path: '/clients',
        name: 'clients',
        component: ClientsComponent
      }
    ]
  },

]

const router = new VueRouter({
  routes
})

export default router
