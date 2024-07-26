import baseApi from './base'
import axiosDefault from 'axios'

const sendContact =(data)=> baseApi.baseApi({
    method: 'post',
    url : 'http://localhost:8000/api/contact/send_contact',
    data: data
})

export default{
    sendContact
}
