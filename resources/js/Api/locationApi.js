import baseApi from './base'

const getLocation =()=> baseApi.baseApi({
    method: 'GET',
    url : 'http://localhost:8000/api/get/getLocation',
    data: ""
})

const getNameLocation =(data)=> baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/get/getNameLocation`,
    data: data
})

export default {
    getLocation,
    getNameLocation
}
