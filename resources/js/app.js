require('./bootstrap');

window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

 var _token=$(name['csrf-token']).val();
const app = new Vue({
    el: '#app',
});
