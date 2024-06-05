import baseApi from './base'

const getLikePost = () => {

    return baseApi.baseApi({
        method: 'GET',
        url : `http://localhost:8000/api/ratting/getLikePost`,
        data:""
    })
}

const getLikeFeedback = (feedbackId,author) => {

    if(author != null){
        const value = {
            "feedback_id" : feedbackId,
            "user_id" : author.id
        }
        return baseApi.baseApi({
            method: 'POST',
            url : `http://localhost:8000/api/ratting/getlikeFeddback`,
            data:value
        })
    }

}
const createLikePost = (data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/ratting/likePost`,
    data: data
})

const createLikeFeedback = (data) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/ratting/likeFeddback`,
    data: data
})

export default {
    getLikePost,
    getLikeFeedback,
    createLikePost,
    createLikeFeedback,

}
