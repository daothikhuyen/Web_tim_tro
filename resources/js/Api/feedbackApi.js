const feedback = () => {
    return{
        feedback: [
            {
                id_feedback: 1,
                username: "Khuyên Khuyên",
                avatar: 'http://localhost/Lavarel_Vuejs_project/Web_tim_phong_project/resources/image/avatar/35974153931cc138a337256ce086e9f1.jpg',
                post_id : 1,
                user_id : 1,
                content : 'Chất lượng thế, ui xịn thế 😒',
                created_time : "12/03/2004",
                parent_id: 0,
                feedback:[
                    {
                        id_feedback: 2,
                        username: "Khuyên Khuyên",
                        avatar: 'http://localhost/Lavarel_Vuejs_project/Web_tim_phong_project/resources/image/avatar/35974153931cc138a337256ce086e9f1.jpg',
                        post_id : 1,
                        user_id : 1,
                        content : 'Chất lượng thế, ui xịn thế 😒',
                        created_time : "12/03/2004",
                        parent_id: 1,
                    },
                    {
                        id_feedback: 3,
                        username: "Đào Khuyên",
                        avatar: 'http://localhost/Lavarel_Vuejs_project/Web_tim_phong_project/resources/image/avatar/35974153931cc138a337256ce086e9f1.jpg',
                        post_id : 1,
                        user_id : 1,
                        content : 'Chất lượng thế, ui xịn thế 😒',
                        created_time : "12/03/2004",
                        parent_id: 1,
                    }
                ]
            },
            {
                id_feedback: 4,
                username: "Khuyên Khuyên",
                avatar: 'http://localhost/Lavarel_Vuejs_project/Web_tim_phong_project/resources/image/avatar/35974153931cc138a337256ce086e9f1.jpg',
                post_id : 2,
                user_id : 1,
                content : 'Chất lượng thế, ui xịn thế 😒',
                created_time : "12/03/2004",
                parent_id: 0,
                feedback:[

                ]
            },
            {
                id_feedback: 5,
                username: "Khuyên Khuyên",
                avatar: 'http://localhost/Lavarel_Vuejs_project/Web_tim_phong_project/resources/image/avatar/35974153931cc138a337256ce086e9f1.jpg',
                post_id : 1,
                user_id : 1,
                content : 'Chất lượng thế, ui xịn thế 😒',
                created_time : "12/03/2004",
                parent_id: 0,
                feedback:[
                    {
                        id_feedback: 6,
                        username: "Khuyên Khuyên",
                        avatar: 'http://localhost/Lavarel_Vuejs_project/Web_tim_phong_project/resources/image/avatar/35974153931cc138a337256ce086e9f1.jpg',
                        post_id : 1,
                        user_id : 1,
                        content : 'Chất lượng thế, ui xịn thế 😒',
                        created_time : "12/03/2004",
                        parent_id: 5,
                        feedback:[

                        ]
                    }
                ]
            }
        ]
    }
}

export default{
    feedback
}
