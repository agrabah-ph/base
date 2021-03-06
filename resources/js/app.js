
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue';
require('./bootstrap');

window.Vue = require('vue');

import store from './store/index'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('searchbar', require('./components/UserSearchbarComponent.vue').default);
Vue.component('user', require('./components/UserComponent.vue').default);
Vue.component('users', require('./components/UsersComponent.vue').default);
Vue.component('loginlogs-table', require('./components/LoginLogsTableComponent.vue').default);
Vue.component('user-location', require('./components/LocationComponent.vue').default);
Vue.component('user-profile', require('./components/ProfileComponent.vue').default);
Vue.component('purchase-orders', require('./components/PurchaseOrders/PurchaseOrdersComponent.vue').default);
Vue.component('po-bids', require('./components/PurchaseOrders/POBidsComponent.vue').default);
Vue.component('add-order', require('./components/PurchaseOrders/AddOrderComponent.vue').default);
Vue.component('client-orders', require('./components/PurchaseOrders/OrdersComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
});
