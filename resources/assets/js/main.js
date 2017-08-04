var Vue = require('vue');
var App = require('./components/app.vue');

new Vue({
   el: '#app',
      render: function (createElement) {
         return createElement(App)
   }
})
