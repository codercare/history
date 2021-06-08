/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('admin-lte');

window.Vue = require('vue');
 // or
//import Vue from 'vue';


import VueRouter from 'vue-router';

import moment from 'moment';
Vue.use(VueRouter);

/** Error handling in client side & Laravel Form Validation 
 *  with vform packages
 */
import { Form, HasError, AlertError } from 'vform';
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
window.Form  = Form;



/**
 *  ES6 Modules or TypeScript
 *  Sweet Alert for Confirming Delete, Success, Error message 
 * 
 * 
 */ 
import swal from 'sweetalert2';
window.swal = swal;

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', swal.stopTimer)
    toast.addEventListener('mouseleave', swal.resumeTimer)
  }
});

window.toast = toast;
/*
const swalWithBootstrapButtons = swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
});
window.swalWithBootstrapButtons = swalWithBootstrapButtons;
*/

/**
 * 
 *  Progrss bar to show progress percentage in top bar windows
 * 
 */
import VueProgressBar from 'vue-progressbar'
const progress_options = {
  color: '#28a745 ',
  failedColor: '#dc3545',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false
}
Vue.use(VueProgressBar, progress_options)


/**
 *  Tree Chart view for Family Hirarchy 
 * 
 */
import TreeChart from "vue-tree-chart";
window.TreeChart = TreeChart;

import html2canvas from 'html2canvas';
window.html2canvas = html2canvas;


/**
 * 
 *  Vue search component with pagination from Remote /Server side
 */
import VueGoodTable from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTable);


/**
*  Define some routes
*  Each route should map to a component. The "component" can
*  either be an actual component constructor created via
*  `Vue.extend()`, or just a component options object.
*  We'll talk about nested routes later.
* 
*/
let routes = [
    { path: '/dashboard', component:  require('./components/Dashboard.vue').default },
    { path: '/home', component:  require('./components/Home.vue').default },
    { path: '/events', component:  require('./components/Events.vue').default },
    { path: '/users', component:  require('./components/Users.vue').default },
    { path: '/members', component:  require('./components/Members.vue').default },
    { path: '/member-profile', component:  require('./components/MemberProfile.vue').default },
    { path: '/members-list', component:  require('./components/MembersList.vue').default },
    { path: '/family-tree', component:  require('./components/FamilyTree.vue').default },
   

    {path: '/auth/:provider/callback',component: {template: '<div class="auth-component"></div>'}},
    { path: '/developer', component:  require('./components/Developer.vue').default },
    { path: '/family', component:  require('./components/Family.vue').default },
    { path: '/profile', component:  require('./components/Profile.vue').default },
    { path: '/settings', component:  require('./components/Settings.vue').default },
    { path: '/password', component:  require('./components/Password.vue').default },
    { path: '/not-found', component:  require('./components/NotFound.vue').default },
    { path: '*', component:  require('./components/NotFound.vue').default },
  ]


/**
 *  Create the router instance and pass the `routes` option
    You can pass in additional options here, but let's
    keep it simple for now.
 */
const router = new VueRouter({
    routes // short for `routes: routes`
  })
  
Vue.filter('myDate',function(date){
  return moment(date).format('MMMM DD YYYY,h:mm:ss a')
});

Vue.filter('humanDate',function(date){
  return moment(date, "YYYYMMDD").fromNow(); // 9 years ago 
  //moment(date).format('MMMM DD YYYY,h:mm:ss a')
});


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

 /**
  * 
  * Passport Default Component 
  */
Vue.component(
  'passport-clients',
  require('./components/passport/Clients.vue').default
);

Vue.component(
  'passport-authorized-clients',
  require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
  'passport-personal-access-tokens',
  require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
  'vue-search',
  require('./components/VueSearchComponent.vue').default
);



// import Vue from 'vue'
// import VueAxios from 'vue-axios'
import VueSocialauth from 'vue-social-auth'
// import axios from 'axios';
 
// Vue.use(VueAxios, axios)
Vue.use(VueSocialauth, {
 
  providers: {
    github: {
      clientId: '',
      redirectUri: '/auth/github/callback' // Your client app URL
    }
  }
})





const app = new Vue({
    el: '#app',
    router
});
