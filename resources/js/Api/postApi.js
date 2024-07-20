import baseApi from './base'

const listPost = () => baseApi.baseApi({
    method: 'GET',
    url : 'http://localhost:8000/api/posts/getall',
    data: ""
})

const getPostByUserId = (page) => baseApi.baseApi({
    method: 'GET',
    url : `http://localhost:8000/api/posts/getPost_ForMe?page=${page}`,
    data: ""
})
const createPost = (data) => baseApi.baseApi({
    method: 'POST',
    url : 'http://localhost:8000/api/posts/create',
    data: data
})

const deletePosts = (data) => baseApi.baseApi({
    method: 'DELETE',
    url : 'http://localhost:8000/api/posts/destroy',
    data: data
})

const show = (id) => baseApi.baseApi({
    method: 'GET',
    url : `http://localhost:8000/api/posts/edit/${id}`,
    data: ""
})

const edit = (id,data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/posts/edit/${id}`,
    data: data
})

const searchInput = (data,page) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/posts/searchInput?page=${page}`,
    data: data
})

const searchPriceOrArea = (data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/posts/searchPriceOrArea`,
    data: data
})

const searchInputAll = (data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/posts/searchInput_All`,
    data: data
})

const searchByLocation_Id = (data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/posts/searchByLocation_Id`,
    data: data
})

const list_searchSuggestion = (data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/posts/list_searchSeggestion`,
    data: data
})

export default {
    listPost,
    getPostByUserId,
    createPost,
    deletePosts,
    show,
    edit,
    searchInput,
    searchPriceOrArea,
    searchInputAll,
    searchByLocation_Id,
    list_searchSuggestion
}




