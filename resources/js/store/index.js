import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from './error'
import message from './message'
import utility from './utility'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error,
    message,
    utility
  }
})

export default store
