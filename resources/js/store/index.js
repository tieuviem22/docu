import Vue from 'vue'
import Vuex from 'vuex'

import auth from './modules/auth'


Vue.use(Vuex)

const storeData = {
    modules: {
        auth
    }
}

const store = new Vuex.Store(storeData)

export default store