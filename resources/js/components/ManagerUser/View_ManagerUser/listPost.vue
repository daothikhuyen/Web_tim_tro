// view list post

<template>
    <div class="container-fluid px-0 bg-white h-100">
        <navbar/>
        <div class="listPost">
            <sidebar/>
            <div class="viewListPost w-100">
                <div class="bg-secondary-subtle p-2 ps-3 w-100">
                    <span class="title">PhongTot</span> / <span class="title">Quản lí </span>/ <span>Danh sách</span>
                </div>
                <section class="search">
                    <div class="search_item d-flex justify-content-end w-100">
                        <div class="w-100">
                            <input type="text" class="border-0 w-100" style="outline: none" placeholder="Tìm kiếm...">
                        </div>
                        <button class="btn_search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </section>
                <section class="list_table mt-4 mb-3">
                    <table class="table table-hover">
                        <thead class="table_list">
                            <tr class="bg-secondary text-center">
                                <th scope="col STT">STT</th>
                                <th scope="col Title">Title</th>
                                <th scope="col Price">Price</th>
                                <th scope="col Acrege">Acrege</th>
                                <th scope="col Adress">Adress</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody class="table_list">
                            <tr>
                                <th scope="row" class="STT">1</th>
                                <td class="Title">Mark Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Repellendus modi architecto iure quidem aut dicta a aliquam vero eum,</td>
                                <td class="Price">2500000 VNĐ</td>
                                <td class="Acrege">3,2 m<sup>2</sup></td>
                                <td class="Adress">Hoà Khành, Đại Nghĩa , Đà Nẵng</td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm ms-1"  href="">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="STT">2</th>
                                <td class="Title">Mark Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                                <td class="Price">2500000 VNĐ</td>
                                <td class="Acrege">3,2 m<sup>2</sup></td>
                                <td class="Adress">Hoà Khành, Đại Nghĩa , Đà Nẵng</td>
                                 <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm ms-1"  href="">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'

import Navbar from '../NavbarManagerUser.vue'
import Sidebar from '../Sidebar.vue'

export default defineComponent({
    name: "HomeManager",
    components: {
        Navbar,
        Sidebar
    }
})
</script>

<style scoped>
    .listPost{
        display: flex;
    }

    .listPost .search{
        float: right;
        margin-top: 20px;
        padding: 5px;
        width: auto;
        border: 1px solid rgb(162, 160, 160,0.5);
    }

    .listPost .viewListPost{
        margin:30px;
    }

    .listPost .viewListPost span{
        font-size: 15px;
    }

    .listPost .viewListPost .title{
        color: var(--primary-color);
        font-weight: 600;
    }

    .table .col {

    }

    .table .table_list .STT{
        width: 5%;
        text-align: center;
    }

    .table .table_list .Adress,
    .table .table_list .Title{
        width: 30%;
    }

    .table .table_list .Acrege,
    .table .table_list .Price{
        width: 10%;
        text-align: center;
    }

    .table .btn_delete,
    .table .btn_detail{
        padding: 5px 45px;
        margin: 0 5px;
    }

</style>
