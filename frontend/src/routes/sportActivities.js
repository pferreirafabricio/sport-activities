import Calendar from '@/pages/Calendar.vue';

export default [
  {
    path: '/',
    redirect: '/calendar',
  },
  {
    path: '/calendar',
    name: 'calendar',
    component: Calendar,
  },
];
