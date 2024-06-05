import userApi from "../../Api/userApi"
import router from '../../router/index';
import axios from 'axios';

export default ({
    state : { // toy
      isLoggedIn : !!localStorage.getItem('token'),
      verifyOTP : null,
      authUser: null,
      newPosts: null,
    },

    getters: {
        isLoggedIn: (state) => state.isLoggedIn,
        authUser:(state) => state.authUser,
    },

    mutations: { // button (instructions)

      LOGIN(state){
        state.isLoggedIn = true //ON
      },

      LOGOUT(state){
        state.isLoggedIn = false // OFF
      },

      SET_USER(state,user){
        state.authUser = user
      },

      OTP(state,otp){
        state.verifyOTP = otp
      },

      CREATE_NEW_POST(state,newpost){
        state.newPosts = newpost
        console.log(state.newPost)
      },

    },

    actions: {// kids
        login({commit}){
            commit('LOGIN')
        },

        async logout({commit, dispatch}){

            const result = await userApi.logout()

            if(result.error == false){
                localStorage.removeItem('token')
                commit('LOGOUT')
                dispatch('navigateTologin')
            }

        },

        navigateTologin(){
            router.push({name: 'login'});
        },

        async getUser({commit,dispatch}){
            try {
                const csrfToken = localStorage.getItem('token');

                if(csrfToken){
                    const response = await userApi.user()
                    commit('SET_USER',response)
                }

            } catch (error) {
                console.error('Lỗi lấy thông tin:', error);
            }
        },
    },

  })

