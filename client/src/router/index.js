import Vue from 'vue'
import VueRouter from 'vue-router'
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
  Signup
} from '../views'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/auth/signin',
    name: 'SignIn',
    component: Signin,
  },
  {
    path: '/auth/signup',
    name: 'SignUp',
    component: Signup,
  },
  {
    path: '/management',
    name: 'HomeManagemet',
    component: HomeManagement,
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
  },
  {
    path: '/management/room',
    name: 'RoomManagement',
    component: RoomManagement,
  },
  {
    path: '/management/room/:roomId',
    name: 'RoomDetailManagement',
    component: RoomDetailManagement,
  },
  {
    path: '/management/reservation',
    name: 'ReservationManagement',
    component: ReservationManagement,
  },
  {
    path: '/management/news',
    name: 'NewsManagement',
    component: NewsManagement,
  },
  {
    path: '/management/news/:newsId',
    name: 'NewsDetailManagement',
    component: NewsDetailManagement,
  },
  {
    path: '/management/profile',
    name: 'ProfileManagement',
    component: ProfileManagement,
  },
  {
    path: '/management/profile/:userId',
    name: 'UserProfileManagement',
    component: UserProfileManagement,
  },
]

const router = new VueRouter({
  routes
})

export default router
