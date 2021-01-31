import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import Vuelidate from 'vuelidate';
import Toasted from 'vue-toasted';
import Loader from '@/components/app/Loader.vue';
import App from './App.vue';

import router from './router';
import store from './store';
import vuetify from './plugins/vuetify';

// binding with Vue
Vue.use(VueAxios, axios);
Vue.use(Vuelidate);
Vue.use(Toasted, { duration: 2000 });
Vue.component('Loader', Loader);

// create component
Vue.config.productionTip = false;
new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount('#app');
