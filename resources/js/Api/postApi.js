import baseApi from './base'

const listPost = () => baseApi.baseApi({
    method: 'GET',
    url : 'http://localhost:8000/api/get/getallPosts',
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

export default {
    listPost,
    createPost,
    deletePosts
}




