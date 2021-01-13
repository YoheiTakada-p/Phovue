const state = {
  user: null,
}

const getters = {
  user: state => {
    return state.user
  },
  check: state => state.user !== null,
  username: state => state.user ? state.user.name : ''
}

const mutations = {
  setUser: function (state, data) {
    state.user = data
  },
}

const actions = {
  async register(context, data) {
    console.log('会員登録')
    const response = await axios.post('/api/register', data)
    context.commit('setUser', response.data)
  },
  async login(context, data) {
    console.log('ログイン')
    const response = await axios.post('/api/login', data).catch(error => error.response)

    if (response.status === 200) {
      context.commit('setUser', response.data)
      return false
    }

    context.commit('error/setAlert', true, { root: true })
  },
  async logout(context, data) {
    console.log('ログアウト')
    const response = await axios.post('/api/logout')
    context.commit('setUser', null)
  },
  async currentUser(context) {
    console.log('ユーザー取得')
    const response = await axios.get('/api/user')
    //ユーザー情報がない場合は空文字が送られてくるため、nullに変換する
    const user = response.data || null
    context.commit('setUser', user)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
