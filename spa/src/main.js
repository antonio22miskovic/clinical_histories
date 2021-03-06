import Vue from "vue";
import "./plugins/base";
import App from "./App.vue";
import router from "./router";
import vuetify from './plugins/vuetify';
import store from "./store";
import {axiosHeaders} from './conf/axiosHeader'
import {handler} from './conf/confAuth'
axiosHeaders(store)
handler(store,router)

Vue.config.productionTip = false;

new Vue({
  router,
  vuetify,
  store,
  render: h => h(App)
}).$mount("#app");