import 'bootstrap/dist/css/bootstrap.css'
import 'vue-toast-notification/dist/theme-sugar.css'
import Vue from 'vue'
import App from './components/App.vue';
import bootstrap from './bootstrap'

const router = bootstrap.initRouter();

bootstrap.initToast();

const app = new Vue({
    el: '#app',
    router,
    components: { App }
});
