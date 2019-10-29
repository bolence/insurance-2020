require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue'
import store from './store/store'

Vue.use(BootstrapVue);


import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


Vue.component('vuetable-component', require('./components/VueTableComponent.vue').default);
Vue.component('sidebar-menu-component', require('./components/SidebarMenuComponent.vue').default);
Vue.component('login-component', require('./components/LoginComponent.vue').default);
Vue.component('new-vehicle-form-component', require('./components/forms/AddNewVehicle.vue').default);

Vue.config.productionTip = true

const app = new Vue({
    el: '#app',
    store,
});