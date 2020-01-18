require('./bootstrap');

import 'bootstrap-vue/dist/bootstrap-vue.css';


window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue';
import MdDateRangePicker from "v-md-date-range-picker";

Vue.use(BootstrapVue);
Vue.use(MdDateRangePicker);


Vue.component('news', require('./components/News').default);
Vue.component('news-create-form', require('./components/NewsFormCreate').default);
Vue.component('edit', require('./components/Edit').default);



const app = new Vue({
    el: '#app'
});