const state = {
  content: ''
}

const mutations = {
  setContent(state, content) {
    state.content = content
  }
}

const actions = {
  content(context, { content, timeout }) {
    context.commit('setContent', content)
    setTimeout(() => (context.commit('setContent', '')), timeout)
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions
}
