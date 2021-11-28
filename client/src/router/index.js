import Vue from 'vue'
import VueRouter from 'vue-router'
import { getDataAPI, postDataAPI } from '../utils/fetchData';
import {
  Home, 
  HomeManagement, 
  News, 
  NewsDetail, 
  NewsDetailManagement, 
  NewsManagement, 
  Profile, 
  ProfileManagement, 
  Reservation, 
  ReservationManagement, 
  Room, 
  RoomDetailManagement, 
  RoomManagement,
  UserProfileManagement,
  Signin,
  Signup,
  Page404
} from '../views'

Vue.use(VueRouter)

const routes = [
  {
    path: '*',
    name: '404',
    component: Page404,
  },
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/auth/signin',
    name: 'SignIn',
    component: Signin,
    beforeEnter: async (to, from, next) => {
      var token = localStorage.getItem("token");
      if (token) {
        let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200) {
          if (res.data["user"]["type"] === 'M') {
            next('/management');
          }
          else {
            next('/');
          }
        }
        else {
          localStorage.removeItem("token");
          next();
        }
      }
      else next();
    }
  },
  {
    path: '/auth/signup',
    name: 'SignUp',
    component: Signup,
    beforeEnter: async (to, from, next) => {
      var token = localStorage.getItem("token");
      if (token) {
        let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200) {
          if (res.data["user"]["type"] === 'M') {
            next('/management');
          }
          else {
            next('/');
          }
        }
        else {
          localStorage.removeItem("token");
          next();
        }
      }
      else next();
    }
  },
  {
    path: '/management',
    name: 'HomeManagemet',
    component: HomeManagement,
    beforeEnter: async (to, from, next) => {
      var token = localStorage.getItem("token");
      if (token) {
        let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200 && res.data["user"]["type"] === 'M') {
          next()
        }
        else next('/')
      }
      else next('/')
    }
  },
  {
    path: '/room',
    name: 'Room',
    component: Room,
  },
  {
    path: '/reservation',
    name: 'Reservation',
    component: Reservation,
  },
  {
    path: '/news',
    name: 'News',
    component: News,
  },
  {
    path: '/news/:newsId',
    name: 'NewsDetail',
    component: NewsDetail,
  },
  {
    path: '/profile',
    name: 'Profile',
    component: Profile,
    beforeEnter: async (to, from, next) => {
      var token = localStorage.getItem("token");
      if (token) {
        let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200) {
          next()
        }
        else next('/')
      }
      else next('/')
    }
  },
  {
    path: '/management/room',
    name: 'RoomManagement',
    component: RoomManagement,    
    beforeEnter: async (to, from, next) => {
      var token = localStorage.getItem("token");
      if (token) {
        let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200 && res.data["user"]["type"] === 'M') {
          next()
        }
        else next('/room')
      }
      else next('/room')
    }
  },
  {
    path: '/management/room/:roomId',
    name: 'RoomDetailManagement',
    component: RoomDetailManagement,
    beforeEnter: async (to, from, next) => {
      var token = localStorage.getItem("token");
      if (token) {
        let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200 && res.data["user"]["type"] === 'M') {
          next()
        }
        else next('/room')
      }
      else next('/room')
    }
  },
  {
    path: '/management/reservation',
    name: 'ReservationManagement',
    component: ReservationManagement,
    beforeEnter: async (to, from, next) => {
      var token = localStorage.getItem("token");
      if (token) {
        let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200 && res.data["user"]["type"] === 'M') {
          next()
        }
        else next('/reservation')
      }
      else next('/reservation')
    }
  },
  {
    path: '/management/news',
    name: 'NewsManagement',
    component: NewsManagement,    
    beforeEnter: async (to, from, next) => {
      var token = localStorage.getItem("token");
      if (token) {
        let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200 && res.data["user"]["type"] === 'M') {
          next()
        }
        else next('/news')
      }
      else next('/news')
    }
  },
  {
    path: '/management/news/:newsId',
    name: 'NewsDetailManagement',
    component: NewsDetailManagement,
    beforeEnter: async (to, from, next) => {
      var token = localStorage.getItem("token");
      if (token) {
        let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200 && res.data["user"]["type"] === 'M') {
          next()
        }
        else next('/news')
      }
      else next('/news')
    }
  },
  {
    path: '/management/profile',
    name: 'ProfileManagement',
    component: ProfileManagement,
    beforeEnter: async (to, from, next) => {
      var token = localStorage.getItem("token");
      if (token) {
        let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200 && res.data["user"]["type"] === 'M') {
          next()
        }
        else next('/profile')
      }
      else next('/profile')
    }
  },
  {
    path: '/management/profile/:userId',
    name: 'UserProfileManagement',
    component: UserProfileManagement,
    beforeEnter: async (to, from, next) => {
      var token = localStorage.getItem("token");
      if (token) {
        let res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200 && res.data["user"]["type"] === 'M') {
          next()
        }
        else next('/profile')
      }
      else next('/profile')
    }
  },
]

const router = new VueRouter({
  routes
})

export default router
