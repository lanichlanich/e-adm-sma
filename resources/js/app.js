/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('admin-lte');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform';

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import VueRouter from 'vue-router';

import VueProgressBar from 'vue-progressbar';

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '4px'
});

Vue.use(VueRouter);

const routes = [{
    path: '/dashboard',
    component: require('./components/Dashboard.vue').default
},
{
    path: '/profile',
    component: require('./components/Profile.vue').default
},
{
    path: '/user',
    component: require('./components/User.vue').default
},
{
    path: '/surat_keluar',
    component: require('./components/SuratKeluar.vue').default
},
{
    path: '/surat_masuk',
    component: require('./components/SuratMasuk.vue').default
},
{
    path: '/surat_penting',
    component: require('./components/SuratPenting.vue').default
},
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})
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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});

let Fire = new Vue();
window.Fire = Fire;

Vue.filter('capitalize', function (text) {

    return text.charAt(0).toUpperCase() + text.slice(1)
});

import moment from 'moment';

Vue.filter('tanggal', function (tgl) {

    moment.locale('id');
    return moment(tgl).format('LL');
});

import Swal from 'sweetalert2'
window.Swal = Swal;


