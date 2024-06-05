// view list post

<template>
    <div class="container-fluid px-0 bg-white h-100">
        <div class="listPost">
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
                                <th scope="col Title">Tiêu đề</th>
                                <th scope="col Price">Giá phòng</th>
                                <th scope="col Acrege">Diện tích</th>
                                <th scope="col Adress">Địa chỉ</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody class="table_list">
                            <tr v-for="(attribute,index) in my_posts" :key="index">
                                <th scope="row" class="STT">{{ index+1}}</th>
                                <td class="Title">{{ attribute.postData.title }}</td>
                                <td class="Price" id="Price">{{ attribute.postData.price }}</td>
                                <td class="Acrege">{{ attribute.postData.area }} m<sup>2</sup></td>
                                <td class="Adress">{{ attribute.postData.full_address }}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="./edit.vue">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm ms-1"  @click.prevent="deletePosts(attribute.postData.id)">
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
import {mapState,mapGetters,mapActions} from 'vuex'
import Swal from 'sweetalert2'
import postApi from '../../../Api/postApi'

import Navbar from '../NavbarManagerUser.vue'
import Sidebar from '../Sidebar.vue'

export default defineComponent({
    name: "HomeManager",
    computed:{
        ...mapGetters(['authUser'])
    },
    components: {
        Navbar,
        Sidebar
    },
    data() {
        const error = ref([])
        const my_posts = ref([])

        return {
            my_posts
        }
    },
    mounted(){
    },
    methods : {

        formatPrice(){
            console.log(document.querySelectorAll("#Price"))
            // this.my_posts.postData.price = this.postData.price.toLocaleString('vi', {style : 'currency', currency : 'VND'})
        },

        filterPosts(){
             this.my_posts =  this.my_posts.message.filter(item => item.postData.user_id == this.authUser.id)
        },

        async deletePosts($id){

            const value = {
                "id" : $id
            }

            if(confirm('Xoá bài viết. Xoá Không Khôi Phục ?')){

            const result = await postApi.deletePosts(value);
                if(result){
                    Swal.fire({
                        title: "Thông Báo!",
                        text: "Xoá bài viết thành công",
                        icon: "success",
                          showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                          location.reload()
                    });
                }else{
                    this.error['error'] = "Đã xảy ra lỗi, vui lòng kiểm tra lại"
                }
            }

        }
    },

    async created(){
        this.my_posts = await postApi.listPost();
        this.filterPosts(),
        this.formatPrice()
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
