import baseApi from './base'

const listPost = () => baseApi.baseApi({
    method: 'GET',
    url : 'http://localhost:8000/api/get/getallPosts',
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

export default {
    listPost,
    getPostByUserId,
    createPost,
    deletePosts,
    show,
    edit,
    searchInput
}




