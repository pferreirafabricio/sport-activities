import Calendar from '@/pages/Calendar.vue';

export default [
  {
    path: '/home',
    redirect: '/calendar',
  },
  {
    path: '/calendar',
    name: 'calendar',
    component: Calendar,
  },
];
