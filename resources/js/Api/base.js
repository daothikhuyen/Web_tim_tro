
const baseApi = async (data) => {
    const csrfToken = localStorage.getItem('token');

    const options = {
        method : data.method,
        url : data.url,
        data: data.data,
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${csrfToken}`
        },
    }

    return await axios(options)
    .then((response) => {
        return response.data
    }).catch((error) => {
        alert("Thất bại")
        console.log(error)
    })
}

export default {
    baseApi
}
