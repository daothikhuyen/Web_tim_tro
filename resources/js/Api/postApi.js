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

export default {
    listPost,
    createPost
}




