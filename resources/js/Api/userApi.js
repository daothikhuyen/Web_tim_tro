import baseApi from './base'

const user =()=> baseApi.baseApi({
    method: 'GET',
    url : `http://localhost:8000/api/getUser`,
    data: ""
})

const login = (data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/login`,
    data: data
})

const signup = (data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/signup`,
    data: data
})

const verifyOTP = (data) =>  baseApi.baseApi({
    method: 'POST',
    url : `/api/check/verifyOTP`,
    data: data
})

const logout = () =>  baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/logout`,
    data: ""
})

export default {
    user,
    login,
    signup,
    verifyOTP,
    logout
}
