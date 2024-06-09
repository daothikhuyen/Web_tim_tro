import { createStore } from 'vuex'

import user from './modules/User'
import post from './modules/Post'

const store = new createStore({
    modules: {
        user,
        post
    }
})

export default store;
