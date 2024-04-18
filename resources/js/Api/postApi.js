
const listPost = () => {
    return [
        {
            user : {
                id: 1,
                username: "Khuyên Khuyên",
                password: "123456",
                email: "daothikhuyen30@gmail.com",
                phone: "0835667553",
                avatar: 'http://localhost/Lavarel_Vuejs_project/Web_tim_phong_project/resources/image/avatar/35974153931cc138a337256ce086e9f1.jpg'
            },
            postData: {
                id: 1,
                title: "Phòng full nt ở Bùi Đình Tuý Bình Thạnh",
                description: `
                Phòng cho thuê cao cấp - Oledo maison
                Giá chỉ: 2.5 triệu/ tháng - Diện tích: 25m2

                Một không gian sống văn minh, trong lành, yên tĩnh, an ninh trong lòng TP, với đầy đủ tiện nghi, không chung chủ và tự do về giờ giấc
                - Địa chỉ: Đường Tôn Đản - TP Đà Nẵng
                + Vị trí nằm trong TTTP, chỉ với 5p đến Bến xe Trung Tâm, gần cầu vượt ngã ba Huế hiện đại nút giao thông Điện Biên Phủ – Tôn Đức Thắng - Trường Chinh, 10-15p đến Coop mart, Sân Bay Quốc tế ĐN, ĐH Duy Tân, Bách Khoa, Sư Phạm, Big C, Bến xe, Ga tàu,...
                + Hẻm dân cư rộng 3m
                * Đầy đủ tiện nghi thoải mái
                - Camera, hệ thống điều hòa, nóng lạnh, truyền hình cáp quang FPT, Wifi tốc độ cao, bãi để xe rộng rãi, sân phơi, sân sinh hoạt chung, hệ thống điện nước âm tường, trần đóng thạch cao, đồng hồ điện nước riêng.
                - Có gác lửng đúc, WC, bếp sạch sẽ, sang trọng
                * Giá thuê hấp dẫn bất ngờ chỉ từ 2.5trđ - 2.9trđ/ tháng
                * Thời gian thuận tiện liên hệ xem phòng: 13h - 17h (thứ 7 và CN). Hoặc sau 19h hàng ngày
                * Gọi ngay cho tôi Mr Thành: ***
                + Mail: phuocthanh85@gmail.com`,
                full_address: " Đường Tôn Đản - TP Đà Nẵng",
                price: "2,5 triệu/tháng",
                arceage:25,
                user_id: 1,
                category_id:1,
                number_like: 136

            },
            images :[
                {
                    id: 1,
                    image: 'https://cloud.mogi.vn/images/2024/03/29/570/3c707d8330004321b870d719942f2db1.jpg',
                    post_id: 1
                },
                {
                    id: 2,
                    image: 'https://cloud.mogi.vn/images/2024/03/29/571/7f61404c62a6412ca109ff5beceaff55.jpg',
                    post_id: 1
                }
            ]

        },
        {
            user : {
                id: 2,
                username: "Minh Khả",
                password: "123456",
                email: "daothikhuyen30@gmail.com",
                phone: "0835667553",
                avatar: 'http://localhost/Lavarel_Vuejs_project/Web_tim_phong_project/resources/image/avatar/35974153931cc138a337256ce086e9f1.jpg'
            },
            postData: {
                id: 2,
                title: "Phòng full nt ở Bùi Đình Tuý Bình Thạnh",
                description: "Một không gian sống văn minh, trong lành, yên tĩnh, an ninh trong lòng TP, với đầy đủ tiện nghi, không chung chủ và tự do về giờ giấc",
                full_address: " Đường Tôn Đản - TP Đà Nẵng",
                price: "2,5 triệu/tháng",
                arceage:25,
                user_id: 1,
                category_id:1,
                number_like: 136

            },
            images :[
                {
                    id: 1,
                    image: 'https://cloud.mogi.vn/images/2024/03/29/570/3c707d8330004321b870d719942f2db1.jpg',
                    post_id: 2
                },
                {
                    id: 2,
                    image: 'https://cloud.mogi.vn/images/2024/03/29/571/7f61404c62a6412ca109ff5beceaff55.jpg',
                    post_id: 2
                }
            ]


        },
        {
            user : {
                id: 2,
                username: "Đào Khuyên",
                password: "123456",
                email: "daothikhuyen30@gmail.com",
                phone: "0835667553",
                avatar: 'http://localhost/Lavarel_Vuejs_project/Web_tim_phong_project/resources/image/avatar/35974153931cc138a337256ce086e9f1.jpg'
            },
            postData: {
                id: 3,
                title: "Phòng full nt ở Bùi Đình Tuý Bình Thạnh",
                description: `
                Phòng cho thuê cao cấp - Oledo maison
                Giá chỉ: 2.5 triệu/ tháng - Diện tích: 25m2

                Một không gian sống văn minh, trong lành, yên tĩnh, an ninh trong lòng TP, với đầy đủ tiện nghi, không chung chủ và tự do về giờ giấc
                - Địa chỉ: Đường Tôn Đản - TP Đà Nẵng
                + Vị trí nằm trong TTTP, chỉ với 5p đến Bến xe Trung Tâm, gần cầu vượt ngã ba Huế hiện đại nút giao thông Điện Biên Phủ – Tôn Đức Thắng - Trường Chinh, 10-15p đến Coop mart, Sân Bay Quốc tế ĐN, ĐH Duy Tân, Bách Khoa, Sư Phạm, Big C, Bến xe, Ga tàu,...
                + Hẻm dân cư rộng 3m
                * Đầy đủ tiện nghi thoải mái
                - Camera, hệ thống điều hòa, nóng lạnh, truyền hình cáp quang FPT, Wifi tốc độ cao, bãi để xe rộng rãi, sân phơi, sân sinh hoạt chung, hệ thống điện nước âm tường, trần đóng thạch cao, đồng hồ điện nước riêng.
                - Có gác lửng đúc, WC, bếp sạch sẽ, sang trọng
                * Giá thuê hấp dẫn bất ngờ chỉ từ 2.5trđ - 2.9trđ/ tháng
                * Thời gian thuận tiện liên hệ xem phòng: 13h - 17h (thứ 7 và CN). Hoặc sau 19h hàng ngày
                * Gọi ngay cho tôi Mr Thành: ***
                + Mail: phuocthanh85@gmail.com`,
                full_address: " Đường Tôn Đản - TP Đà Nẵng",
                price: "2,5 triệu/tháng",
                arceage:25,
                user_id: 1,
                category_id:1,
                number_like: 136

            },
            images :[
                {
                    id: 1,
                    image: 'https://cloud.mogi.vn/images/2024/03/29/570/3c707d8330004321b870d719942f2db1.jpg',
                    post_id: 3
                },
                {
                    id: 2,
                    image: 'https://cloud.mogi.vn/images/2024/03/29/571/7f61404c62a6412ca109ff5beceaff55.jpg',
                    post_id: 3
                }
            ]

        },
    ]
}

export default {
    listPost
}



