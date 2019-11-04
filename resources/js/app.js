require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue'
import store from './store/store'
import moment from 'moment'
import VueAWN from "vue-awesome-notifications";
import VueSweetAlert from 'vue-sweetalert';
import VuejsDialog from "vuejs-dialog";
var numeral = require("numeral");


// import css
import "vue-awesome-notifications/dist/styles/style.css"; // vue notification css
import "vuejs-dialog/dist/vuejs-dialog.min.css"; // vue confirmation css
// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


var options = {
    position: 'top-right',
    duration: 2000,
    maxNotifications: 10,
}


Vue.use(VuejsDialog, {
    html: false,
    loader: true,
    okText: 'Nastavi',
    cancelText: 'Otkaži',
    animation: 'bounce',
});


Vue.use(VueAWN, options); // toastr notifications
Vue.use(VueSweetAlert); // sweet alert js
Vue.use(VuejsDialog); // vue confirmation dialog
Vue.use(BootstrapVue);

Vue.component('vuetable-component', require('./components/VueTableComponent.vue').default);
Vue.component('vuetable-damages-component', require('./components/VueTableDamagesComponent.vue').default);
Vue.component('sidebar-menu-component', require('./components/SidebarMenuComponent.vue').default);
Vue.component('login-component', require('./components/LoginComponent.vue').default);
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('new-vehicle-form-component', require('./components/forms/AddNewVehicle.vue').default);
Vue.component('edit-vehicle-form-component', require('./components/forms/EditVehicleForm.vue').default);


Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD.MM.YYYY');
    }
});

Vue.filter("formatNumber", function(value) {
    return numeral(value).format("0,0.00");
});


Vue.filter('formatDateTime', function(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY HH:mm');
    }
});

Vue.config.productionTip = true;

const app = new Vue({
    el: '#app',
    store,
});


const app1 = new Vue({
    el: '#app1',
    store,
});
