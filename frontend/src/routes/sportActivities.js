import Calendar from '@/pages/Calendar.vue';

export default [
  {
    path: '/home',
    redirect: '/',
  },
  {
    path: '/',
    name: 'home',
    component: Calendar,
  },
];
