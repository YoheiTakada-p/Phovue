const state = {
  code: null,
  alert: null
}

const mutations = {
  setCode: function (state, code) {
    state.code = code
  },
  setAlert: function (state, alert) {
    state.alert = alert
  }
}

export default {
  namespaced: true,
  state,
  mutations
}
