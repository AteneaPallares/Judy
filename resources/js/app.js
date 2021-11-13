/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');
 import Vue from 'vue';
 import ElementUI from 'element-ui';
 import 'element-ui/lib/theme-chalk/index.css';
 import locale from 'element-ui/lib/locale/lang/es'
 
 Vue.use(ElementUI,{locale});
 window.Vue = require('vue').default;
 
 /**
  * The following block of code may be used to automatically register your
  * Vue components. It will recursively scan this directory for the Vue
  * components and automatically register them with their "basename".
  *
  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
  */

 Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 Vue.component('sidebar-component', require('./components/Layout/Sidebar.vue').default);
 Vue.component('topbar-component', require('./components/Layout/topMenu.vue').default);
 Vue.component('usersindex-component', require('./components/Users/index.vue').default);
 Vue.component('userscreate-component', require('./components/Users/create.vue').default);
 Vue.component('clientsindex-component', require('./components/Clients/index.vue').default);
 Vue.component('clientscreate-component', require('./components/Clients/create.vue').default);
 Vue.component('productsindex-component', require('./components/Products/index.vue').default);
 Vue.component('productscreate-component', require('./components/Products/create.vue').default);

 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
 const app = new Vue({
     el: '#app',
     
 });
 