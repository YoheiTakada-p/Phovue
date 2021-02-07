const state = {
  reacquirePhotos: true
}

const mutations = {
  setReacquirePhotos: function (state, created) {
    state.reacquirePhotos = created
  }
}

export default {
  namespaced: true,
  state,
  mutations
}
