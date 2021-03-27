import Vue from 'vue';
import Router from 'vue-router';
import sportActivities from './sportActivities';

Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    ...sportActivities,
  ]
});
