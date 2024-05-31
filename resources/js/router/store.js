
import { createStore } from 'vuex'
import router from './index';
import axios from 'axios';
import { array } from 'yup';

export default createStore({
    state : { // toy
      isLoggedIn : !!localStorage.getItem('token'),
      verifyOTP : null,
      authUser: null,
      newPosts: null,
      getLocation : [],
      getAllPosts: []
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

      GET_LOCATION(state,location){
        state.getLocation = location
      },

      GET_ALL_POSTS(state,allPosts){
        state.getAllPosts = allPosts
      }
    },

    actions: {// kids
        login({commit}){
            commit('LOGIN')
        },

        async logout({commit, dispatch}){
            const csrfToken = localStorage.getItem('token');
            console.log(csrfToken);

            await axios.post('http://localhost:8000/api/logout', {}, {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${csrfToken}`
                },
            })
            .then((response) => {

                if(response.data.error == false){
                    localStorage.removeItem('token')
                    commit('LOGOUT')
                    dispatch('navigateTologin')
                }
            })
            .catch(error => {
                alert("Đã Xảy Ra lỗi")
                console.error(error);
            })

        },

        navigateTologin(){
            router.push({name: 'login'});
        },

        async getUser({commit,dispatch}){
            try {
                const csrfToken = localStorage.getItem('token');

                if(csrfToken){
                    const response = await axios.get("http://localhost:8000/api/getUser",{
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${csrfToken}`
                        },
                    });
                    console.log(response.data)
                    commit('SET_USER',response.data)
                }



            } catch (error) {
                console.error('Lỗi lấy thông tin:', error);
            }
        },

        async signup({commit}, values){
            await axios.post('http://localhost:8000/api/signup', values)
                .then((results) => {
                    if(results.data.error == false){
                        commit('OTP',results.data.otp)
                        alert(results.data.otp)
                        this.$router.push({name : 'verify_otp'})
                    }else{
                        this.error['error'] = results.data.message
                    }
                })
                .catch(error => {
                    alert("Đã Xảy Ra lỗi")
                    console.error(error);
                })
        },

        async getLocation({commit}){
            await axios.get('http://localhost:8000/api/getLocation')
            .then((results) => {
                console.log(results.data.error)
                if(results.data.error == false){
                    console.log(results.data.message)
                    commit('GET_LOCATION',results.data.message)
                }

            })
            .catch(error => {
                alert("Đã Xảy Ra lỗi")
                console.error(error);
            })
        },

        async getPosts({commit}){
            await axios.get('http://localhost:8000/api/getallPosts')
            .then((results) => {
                if(results.data.error == false){
                    commit('GET_ALL_POSTS',results.data.message)
                }
            })
            .catch(error => {
                alert("Đã Xảy Ra lỗi")
                console.error(error);
            })

        },
    },

  })

