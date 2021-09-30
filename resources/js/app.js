import Vue from 'vue';
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';

import store from './store'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import router from './router';


import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
window.Vue = require('vue').default;

Vue.config.productionTip = false


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.use(Antd);


new Vue({
    router,
    store
}).$mount('#app');