const state = {
  user: null,
  loginErrorMessages: null,
  registerErrorMessages: null
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
  setLoginErrorMessages: function (state, messages) {
    state.loginErrorMessages = messages
  },
  setRegisterErrorMessages: function (state, messages) {
    state.registerErrorMessages = messages
  }
}

const actions = {
  //会員登録
  async register(context, data) {
    console.log('会員登録')
    const response = await axios.post('/api/register', data)
      .catch(error => error.response)

    if (response.status === 201) {
      context.commit('setUser', response.data)
      return false
    }

    if (response.status === 422) {
      context.commit('setRegisterErrorMessages', response.data.errors)
    } else {
      context.commit('error/setAlert', true, { root: true })
    }
  },
  //ログイン
  async login(context, data) {
    console.log('ログイン')
    const response = await axios.post('/api/login', data)
      .catch(error => error.response)

    if (response.status === 200) {
      context.commit('setUser', response.data)
      return false
    }

    if (response.status === 422) {
      context.commit('setLoginErrorMessages', response.data.errors)
    } else {
      context.commit('error/setAlert', true, { root: true })
    }
  },
  //ログアウト
  async logout(context, data) {
    console.log('ログアウト')
    const response = await axios.post('/api/logout')
      .catch(error => error.response)

    if (response.status === 200) {
      context.commit('setUser', null)
    } else {
      context.commit('error/setAlert', true, { root: true })
    }

  },
  //ユーサー取得
  async currentUser(context) {
    console.log('ユーザー取得')
    const response = await axios.get('/api/user')
      .catch(error => error.response)

    if (response.status === 200) {
      //ユーザー情報がない場合は空文字が送られてくるため、nullに変換する
      const user = response.data || null
      context.commit('setUser', user)
    } else {
      context.commit('error/setAlert', true, { root: true })
    }
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
