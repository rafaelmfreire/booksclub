/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Event = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component( 'profile-component', require('./components/ProfileComponent.vue').default);
Vue.component( 'btn-delete-component', require('./components/BtnDeleteComponent.vue').default);
Vue.component( 'books-list', require('./components/BooksList.vue').default);
Vue.component( 'elections-list', require('./components/ElectionsList.vue').default);
Vue.component( 'results-list', require('./components/ResultsList.vue').default);

Vue.component( 'alert', require('./components/Alert.vue').default);

Vue.component('hamburger-menu', {
  methods: {
    onClick() {
      Event.$emit('hamburger-clicked');
    }
  }
});

Vue.component('collapsed-menu', {
  data() {
    return { isMenuOpen: false };
  },
  created() {
    Event.$on('hamburger-clicked', () => (this.isMenuOpen = !this.isMenuOpen));
  }
});


import moment from 'moment';
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value).substring(0, 10)).format('DD/MM/YYYY');
  }
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
