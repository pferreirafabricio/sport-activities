import Vue from 'vue';
import App from './App.vue';

import router from './routes';
import vuetify from './plugins/vuetify';
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'vue-cal/dist/i18n/pt-br.js';

Vue.config.productionTip = false;

new Vue({
  router,
  vuetify,
  render: (h) => h(App),
}).$mount('#app');
