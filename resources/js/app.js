require('./bootstrap');

import Vue from 'vue'
import Vuex from 'vuex'
import Axios from 'axios'
import Notifications from 'vue-notification'

Vue.prototype.$http = Axios

Vue.use(Vuex)
Vue.use(Notifications)

Vue.component('event', require('./containers/Event.vue').default)

const app = new Vue({
    el: '#content'
});