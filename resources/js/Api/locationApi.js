const getLocation =()=> {
    return [
        {
            id: 1,
            name: "Thành phố Đà Nẵng",
            title: 'Thành Phố',
            parent_id: 0,
            location : [
                {
                    id: 3,
                    name: "Ngũ Hành Sơn",
                    title: 'Quận Huyện',
                    parent_id: 1,
                    location : [
                        {
                            id: 5,
                            name: "Hoà Quý",
                            title: 'Phường Xã',
                            parent_id: 3,
                            location : [
                                {
                                    id: 7,
                                    name: "Trần Đại Nghĩa",
                                    title: 'Đường Phố',
                                    parent_id: 3,
                                    location : []
                                },
                            ]

                        },
                        {
                            id: 6,
                            name: "Khuê Mỹ",
                            title: 'Phường Xã',
                            parent_id: 3,
                            location : [

                            ]

                        },
                    ]

                },
                {
                    id: 4,
                    name: "Hải Châu",
                    title: 'Quận Huyện',
                    parent_id: 1,
                    location : []

                },
            ]

        },
        {
            id: 2,
            name: "Thành Phố HCM",
            title: 'Thành Phố',
            parent_id: 0
        },
    ]

    // return location.filter(item => item.parent_id === parent_id)
}

export default {
    getLocation
}
