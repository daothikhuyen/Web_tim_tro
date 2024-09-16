import userApi from "../../Api/userApi"
import router from '../../router/index';
import axios from 'axios';

export default ({
    state : { // toy
      isLoggedIn : !!localStorage.getItem('token'),
      verifyOTP : null,
      authUser: null,
      isEmailUser: null
    },

    getters: {
        isLoggedIn: (state) => state.isLoggedIn,
        authUser:(state) => state.authUser,
        isEmailUser:(state) => state.isEmailUser
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
        // console.log(state.authUser);
      },

      OTP(state,otp){
        state.verifyOTP = otp
      },

      SET_EMAIL(state,email){
        state.isEmailUser = email
      }

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
                    if(!response.error){
                        commit('SET_USER',response.user)
                    }else{
                        dispatch('logout')
                    }
                }

            } catch (error) {
                localStorage.removeItem('token')
                console.error('Lỗi lấy thông tin:', error);
            }
        },

    },

  })

