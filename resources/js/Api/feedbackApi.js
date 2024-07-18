import baseApi from './base'

const getFeedback = (postId) => baseApi.baseApi({
    method: 'POST',
    url : `http://localhost:8000/api/feedback/getFeedbacks/${postId}`,
    data: ""
})

const creatFeedback = (data) =>{
    const values = {
        'user_id' : data.user_id,
        'post_id' : data.post_id,
        'comment' : data.comment,
        'parent_id': data.parent_id
    };

    return baseApi.baseApi({
        method: 'POST',
        url : 'http://localhost:8000/api/feedback/insert',
        data: values
    })
}

export default{
    getFeedback,
    creatFeedback
}
