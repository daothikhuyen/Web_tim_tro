import baseApi from './base'

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

export default {
    getLocation,
    getNameLocation,
    getLocationByParent_id
}
