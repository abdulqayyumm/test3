import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router/index.js'
import VueToast from 'vue-toast-notification'

export default {
  initRouter ()
  {
    Vue.use(VueRouter);

    return new VueRouter(router);
  },
  
  initToast () {
    Vue.use(VueToast, {
      position: 'bottom',
      duration: 3000
    });
  }
}