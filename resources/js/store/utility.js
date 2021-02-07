const state = {
  addNewPhoto: null
}

const mutations = {
  setAddNewPhoto: function (state, created) {
    state.addNewPhoto = created
  }
}

export default {
  namespaced: true,
  state,
  mutations
}
