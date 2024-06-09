// view list post

<template>
    <div class="container-fluid">
        <div class="listPost mt-5">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="title_main w-100"  style="">
                            <h5 class="ps-3 pt-1 text-white">Danh Sách</h5>
                        </div>
                        <section class="search">
                            <div class="search_item d-flex justify-content-end">
                                <div class="">
                                    <input type="text" class="border-0" style="outline: none" placeholder="Tìm kiếm..." @change="searchInput" v-model="textSearch">
                                </div>
                                <button class="btn_search ps-1" @click.prevent="searchInput">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </section>
                        <section class="list_table">
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
                                <tbody class="table_list" v-if="my_posts.length != 0">
                                    <tr v-for="(attribute,index) in my_posts" :key="index">
                                        <th scope="row" class="STT">{{ index+1}}</th>
                                        <td class="Title">{{ attribute.title }}</td>
                                        <td class="Price" id="Price">
                                            <input type="text" name="" class="border-0 " readonly :value="formatPrice(attribute.price)">
                                        </td>
                                        <td class="Acrege">{{ attribute.area }} m<sup>2</sup></td>
                                        <td class="Adress">{{ attribute.full_address }}</td>
                                        <td class="text-center">
                                            <router-link class="btn btn-primary btn-sm" :to="'edit_post/'+attribute.id">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </router-link>
                                            <a class="btn btn-danger btn-sm ms-1"  @click.prevent="deletePosts(attribute.id)">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <span class="text-center">
                                                Rất tiếc, dữ liệu bạn nhập không tồn tại
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                                <Bootstrap5Pagination :data="currentPage" @pagination-change-page="load_My_Posts"/>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import {mapState,mapGetters,mapActions} from 'vuex'
import Swal from 'sweetalert2'
import postApi from '../../../Api/postApi'

import Sidebar from '../Sidebar.vue'

export default defineComponent({
    name: "HomeManager",
    computed:{
        ...mapGetters(['authUser']),
    },
    components: {
        Sidebar,
        Bootstrap5Pagination
    },
    data() {
        const error = ref([])
        const currentPage = ref([])
        const my_posts = ref([])
        const textSearch = ref(null)
        const attribute = {
            price: ""
        }

        return {
            currentPage,
            textSearch,
            my_posts,
            attribute,
        }
    },
    methods : {

        async searchInput(page = 1){

            const response =  await postApi.searchInput(this.textSearch);

            if(response){
                this.currentPage = response.data
                this.my_posts = response.data.data
            }
            console.log(this.my_posts.length)
        },

        formatPrice(price){
            return price.toLocaleString('vi', {style : 'currency', currency : 'VND'})
        },

        async load_My_Posts(page = 1){
            // const response = await postApi.getPostByUserId(page);

            const response =  await postApi.searchInput(this.textSearch,page);

            if(response){
                this.currentPage = response.data
                this.my_posts = response.data.data
            }

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
        this.load_My_Posts()
    }
})
</script>

<style scoped>

    .listPost{
        background-color: #ffff;
    }

    .listPost .title_main{
        background-color:#ff5d26;
        padding: 6px 3px ;
        border-top-right-radius: 1rem ;
        border-top-left-radius: 1rem ;

    }

    .listPost .list_table{
        padding: 1rem;
        margin-top: 4rem;

    }

    .table .table_list  {
        cursor: pointer;
    }

    .table .table_list .STT{
        width: 5%;
        text-align: center;
    }

    .table .table_list .Adress,
    .table .table_list .Title{
        width: 30%;
        cursor: pointer;
    }

    .table .table_list .Acrege,
    .table .table_list .Price{
        width: 10%;
        text-align: center;
        cursor: pointer;
    }

    .table_list .Price input[type="text"]{
        background-color: transparent;
        outline: none;
        cursor: pointer;
        text-align: center;
    }

    .table .btn_delete,
    .table .btn_detail{
        padding: 5px 45px;
        margin: 0 5px;
    }

    /* search */

    .listPost .search{
        float: right;
        margin-top: 20px;
        margin-right: 1rem ;
        padding: 5px;
        width: auto;
        border: 1px solid rgb(162, 160, 160,0.5);
        border-radius:.25rem ;
    }

    .listPost .search .search_item div:nth-child(1) input[type = 'text']{
        width: 300px;
    }

</style>
