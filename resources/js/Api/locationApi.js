import baseApi from './base'
import axiosDefault from 'axios'

const getLocation =()=> baseApi.baseApi({
    method: 'GET',
    url : 'http://localhost:8000/api/locations/getAll',
    data: ""
})

const getNameLocation =(data)=> baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/locations/getNameLocation`,
    data: data
})

const getLocationByParent_id = (id,type) => {
    const data = {
        parent_id: id,
        type: type
    }
    return baseApi.baseApi({
        method: 'POST',
        url : `http://localhost:8000/api/locations/getLocationByParent_id`,
        data: data
    })
}

const get_Provinces =()=> baseApi.baseApi({
    method: 'GET',
    url : 'http://localhost:8000/api/locations/get_Provinces',
    data: ""
})

const get_Districts = (province_id) =>{
    const data = {
        province_id : province_id
    }

    return baseApi.baseApi({
        method: 'POST',
        url : `http://localhost:8000/api/locations/get_Districts`,
        data: data
    })
}

const get_Wards = (district_id) =>{
    const data = {
        district_id : district_id
    }

    return baseApi.baseApi({
        method: 'POST',
        url : `http://localhost:8000/api/locations/get_Wards`,
        data: data
    })
}

export default {
    getLocation,
    getNameLocation,
    getLocationByParent_id,
    get_Provinces,
    get_Districts,
    get_Wards
}
