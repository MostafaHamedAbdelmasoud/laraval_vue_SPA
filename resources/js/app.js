import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import test from '~/pages/test'
import '~/plugins'
import '~/components'
import axios from 'axios';
// window.axios = require('axios');

Vue.config.productionTip = false
// Vue.component('test', require('./pages/test.vue'));

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
