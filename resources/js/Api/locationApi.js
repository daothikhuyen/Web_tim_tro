const getLocation =(parent_id)=> {
    const location = [
        {
            id: 1,
            name: "Đà Nẵng",
            title: 'Thành phố',
            parent_id: 0,

        },
        {
            id: 2,
            name: "Ngũ Hành Sơn",
            title: 'Quận huyện',
            parent_id: 1
        },
        {
            id: 3,
            name: "Hải Châu",
            title: 'Quận huyện',
            parent_id: 1
        },
        {
            id: 4,
            name: "Hồ Chí Minh",
            parent_id: 0,
        },
        {
            id: 5,
            name: "Ngũ Hành Sơn 1",
            parent_id: 4,
        },
        {
            id: 6,
            name: "Hải Châu 2",
            parent_id: 4,
        },
        {
            id: 7,
            name: "Phường Hoà Hải",
            parent_id: 2,
        },
        {
            id: 6,
            name: "Phường Hoà Quý",
            parent_id: 2,
        }
        ,
        {
            id: 8,
            name: "Đường Lê Lợi",
            parent_id: 7
        },
        {
            id: 9,
            name: "Đường Hành Châu",
            parent_id: 6
        },
    ]

    return location.filter(item => item.parent_id === parent_id)
}

export default {
    getLocation
}
