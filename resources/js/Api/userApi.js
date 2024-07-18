import baseApi from './base'

const user =()=> baseApi.baseApi({
    method: 'GET',
    url : `http://localhost:8000/api/user/getUser`,
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
    url : `http://localhost:8000/api/user/logout`,
    data: ""
})

const uploadAvatar = (data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/upload-file`,
    data: data
})

const update_personalInfo = (data,id) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/user/update/${id}`,
    data: data
})

const change_password = (data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/user/update_password`,
    data: data
})

const delete_account = () => baseApi.baseApi({
    method: 'DELETE',
    url : `http://localhost:8000/api/user/destroy`,
    data: ""
})

const forgot_password = (data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/user/forgot_password`,
    data: data,
})

const reset_password = (data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/user/reset_password/${data.token}`,
    data: data,
})

export default {
    user,
    login,
    signup,
    verifyOTP,
    logout,
    uploadAvatar,
    update_personalInfo,
    change_password,
    delete_account,
    forgot_password,
    reset_password,
}
