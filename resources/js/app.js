/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

import vue from 'vue';

window.Vue = vue;

Vue.use(require('vue-moment'));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('blogs', require('./components/BlogsComponent.vue').default);
Vue.component('blog', require('./components/BlogComponent.vue').default);
Vue.component('blog-form', require('./components/BlogFormComponent.vue').default);
Vue.component('categories', require('./components/CategoriesComponent.vue').default);
Vue.component('category', require('./components/CategoryComponent.vue').default);
Vue.component('category-form', require('./components/CategoryFormComponent.vue').default);
Vue.component('message-form', require('./components/MessageFormComponent.vue').default);
Vue.component('dashboard', require('./components/DashboardComponent.vue').default);
Vue.component('replies', require('./components/RepliesComponent.vue').default);
Vue.component('hero', require('./components/base/HeroComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
