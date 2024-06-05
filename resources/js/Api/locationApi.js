import baseApi from './base'

const getLocation =()=> baseApi.baseApi({
    method: 'GET',
    url : 'http://localhost:8000/api/get/getLocation',
    data: ""
})

export default {
    getLocation
}
