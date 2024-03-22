// HomeComponent.vue

<template>
    <div class="HomeComponent" >
        <navbar-component></navbar-component>
        <div class="view_home container-fluid mt-3" style="">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center">
                    <div class="advertisement w-100">
                        <img class="w-100" src="../../image/advertisement/advertisement_01.png" alt="">
                    </div>
                </div>
                <div class="col-md-8 mt-3" >
                    <div class="header_search p-3 rounded-3 d-flex justify-content-between align-items-center" style="background-color:#C9C0BB">
                        <div class="category d-flex align-items-center border border-1 rounded-3 ps-3">
                            <span>
                                <i class="bi bi-house"></i>
                            </span>
                            <select class="form-select border-0 " aria-label="Default select example">
                                <option selected>Phòng trọ, nhà trọ</option>

                            </select>
                       </div>
                       <div class="location border border-1 rounded-3 ps-3">
                            <span>
                               <i class="bi bi-map"></i>
                            </span>
                            <select class="form-select border-0" aria-label="Default select example">
                                <option selected>Toàn quốc</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                       </div>
                       <div class="location border border-1 rounded-3 ps-3 bg-secondary-subtle" >
                            <span>
                               <i class="bi bi-geo-alt"></i>
                            </span>
                            <select class="form-select border-0" aria-label="Default select example" disabled>
                                <option selected>Tất cả</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                       </div>
                       <div class="search-info">

                            <button type="submit" class="btn-search px-5">
                                Tìm Kiếm
                                <span>
                                    <i class="bi bi-search"></i>
                                </span>
                            </button>
                       </div>
                    </div>

                    <div class="main_home py-3 mt-5">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="post bg-white py-3" v-for="listPost in srcAvatar" :key="listPost.id">
                                    <div class="avatar_name">
                                        <div class="avatar inline-block">
                                            <img  :src="'../../image/avatar/' + listPost.link"  alt="avatar" class="image_avatar_post"  @error="$event.target.src='http://example.com/default.jpg'">
                                             <!-- <img :src="listPost.link" alt="avatar" class="image_avatar_post"> -->
                                        </div>
                                        <div class="name">
                                            <h6>{{listPost.name }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 float-md-start">
                                <div class="search-price w-100">
                                    <h6>Lọc Theo Giá Thuê</h6>

                                    <ul class="list-group list-group-search list-group-flush">
                                        <li class="list-group-item list-group-item-action" >
                                            <a href="" class="text-decoration-none">Dưới 2 triệu</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action" >
                                            <a href="" class="text-decoration-none">A second ite</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action" >
                                            <a href="" class="text-decoration-none">A second ite</a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="search-acreage w-100">
                                    <h6>Lọc Theo Diện Tích</h6>

                                    <ul class="list-group list-group-search list-group-flush">
                                        <li class="list-group-item list-group-item-action" >
                                            <a href="" class="text-decoration-none">Dưới 2 triệu</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action" >
                                            <a href="" class="text-decoration-none">Dưới 2 triệu</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action" >
                                            <a href="" class="text-decoration-none">Dưới 2 triệu</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import NavbarComponent from './NavbarComponent.vue'

    export default {
        name: "HomeComponent",
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                srcAvatar: [
                    {
                        name: "Khuyên Khuyên", link : "35974153931cc138a337256ce086e9f1.jpg"
                    }
                ]
            }
        },
        components:{
            NavbarComponent
        }
    }


</script>

<style scoped>


</style>
