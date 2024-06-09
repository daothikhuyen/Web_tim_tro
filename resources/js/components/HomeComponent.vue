// HomeComponent.vue

<template>
    <div class="HomeComponent">
        <navbar-component></navbar-component>
        <div class="view_home container-fluid mt-3" style="">
            <div class="row mx-auto">
                <div class="col-lg-2 advertise">
                    <div class="advertisement">
                        <img class="" src="../../image/advertisement/advertisement_01.png" alt="">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 view_main mt-3">
                    <form action="" @submit.prevent="searchInput">
                        <div class="parent_header_search">
                            <div class="header_search">
                                <div class="searchLocation" @click.prevent="getLocationByParent_id">
                                    <div class="listsearch">
                                        <i class="bi bi-geo-alt icon_location" ></i>
                                        <div class="name_search">{{nameLocation['1']?nameLocation['1']:'Toàn Quốc'}}</div>
                                        <i class="fa-solid fa-chevron-down"></i>
                                        <span class="postfix-div"></span>
                                    </div>
                                </div>
                                <button type="submit" class="border-0 outline-none cursor-pointer" @click.prevent="searchInput">
                                    <i class="bi bi-search"></i>
                                </button>
                                <div class="LocationInputSearch">
                                    <input type="text" class="input_search" v-model="inputSearch" placeholder="Nhập đề cần tìm kiếm">
                                </div>
                                <button type="submit" class="btnSearch" @click.prevent="searchInput">Tìm Kiếm</button>
                            </div>
                        </div>
                    </form>

                    <div class="main_home py-md-3 mt-3">
                        <div class="row">
                            <div class="the_left col-md-4 float-md-start d-sm-block d-md-none">
                                <div class="justify-content-between">
                                    <div class="search-price w-100 me-1">
                                        <div class="d-flex justify-content-between align-items-center" @click.prevent="dropdownBoxSearch('price')">
                                            <h6>Lọc Theo Giá Thuê</h6>
                                            <span >
                                                <i class="fa-solid fa-chevron-up"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="search-acreage w-100 ms-1">
                                        <div class="d-flex justify-content-between align-items-center" @click.prevent="dropdownBoxSearch('acreage')">
                                            <h6>Lọc Theo Diện Tích</h6>
                                            <span >
                                                <i class="fa-solid fa-chevron-up"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 postcomponet">
                                <PostComponent :posts="posts"></PostComponent>
                            </div>
                            <div class="the_right col-md-4 float-md-start d-sm-none d-md-block">
                                <div class="search-price w-100">
                                    <h6>Lọc Theo Giá Thuê</h6>
                                    <ul class="list-group list-group-search list-group-flush">
                                        <li v-for="price in romePrice" :key="price.id" class="list-group-item list-group-item-action" @click.prevent="getBySearch('price',price.on,price.under)">
                                            <a href="#" class="text-decoration-none">Giá từ {{price.title}}</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="search-acreage w-100">
                                    <h6>Lọc Theo Diện Tích</h6>
                                    <ul  class="list-group list-group-search list-group-flush">
                                        <li v-for="(item,index) in area" :key="index" class="list-group-item list-group-item-action" @click.prevent="getBySearch('area',item.on,item.under)">
                                            <a href="#" v-if="index == 0" class="text-decoration-none">Dưới {{item.under}} m <sup>2</sup></a>
                                            <a href="#" v-else class="text-decoration-none">Từ {{item.on}} - {{item.under}}m <sup>2</sup></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 advertise">
                    <div class="advertisement">

                        <img class="" src="../../image/advertisement/advertisement_01.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="filterLocation">
        <div class="filterPrice" :class="[openSearchPrice?'d-block': 'd-none']">
            <ul class="list-group list-group-search list-group-flush">
                <li v-for="price in romePrice" :key="price.id" class="list-group-item list-group-item-action" @click.prevent="getBySearch('price',price.on,price.under)">
                    <a href="#" class="text-decoration-none">Giá từ {{price.title}}</a>
                </li>
            </ul>
        </div>
        <div class="filterAcreage" :class="[openSearchArea?'d-block': 'd-none']">
            <ul  class="list-group list-group-search list-group-flush">
                <li v-for="(item,index) in area" :key="index" class="list-group-item list-group-item-action" @click.prevent="getBySearch('area',item.on,item.under)">
                    <a href="#" v-if="index == 0" class="text-decoration-none">Dưới {{item.under}} m <sup>2</sup></a>
                    <a href="#" v-else class="text-decoration-none">Từ {{item.on}} - {{item.under}}m <sup>2</sup></a>
                </li>
            </ul>
        </div>
        <div class="filter_group" :class="{show: show_BoxChooseLocation == 1}">
            <div class="header">
                <i class="fa-solid fa-arrow-left" @click.prevent="off_filter_location"></i>
               <span>Chọn Tỉnh Thành</span>
            </div>
            <div class="content">
                <div id="filter_group_city_option" class="city_option">
                    <ul>
                        <li :class="{selected : selectedLocation.length == 0 || selectedLocation == 'Toàn Quốc'}" @click.prevent="clickSeleted('Toàn Quốc',0)">Toàn Quốc</li>
                        <li v-for="(items,index) in locations['1']" :key="index" :class="{selected: selectedLocation[items.type] === items.name}" @click.prevent="clickSeleted(items,2)">{{items.name}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="filter_group" :class="{show: show_BoxChooseLocation == 2}">
            <div class="header">
                <i class="fa-solid fa-arrow-left" @click.prevent="off_filter_location"></i>
               <span>{{ nameLocation['1']}}</span>
            </div>
            <div class="content">
                <div id="filter_group_districts_option" class="districts">
                    <ul>
                        <li v-for="(items,index) in locations['2']" :key="index" :class="{selected: selectedLocation[items.type] === items.name}" @click.prevent="clickSeleted(items,3)">{{items.name}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="black_overlay" @click.prevent="off_filter_location" :class="{show: !black_screen}"></div>

        <div class="box_search_locations" :class="{show : !showLocaing_location}">
            <div class="box_page_loading">
                <div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'

import postApi from "../Api/postApi"
import romePriceApi from "../Api/roomPrice"
import areaApi from "../Api/area"

import { ref, defineComponent, onMounted } from 'vue'
import { useDateFormat, useNow } from '@vueuse/core'
import NavbarComponent from './NavbarComponent.vue'

import PostComponent from './post/index.vue'
import locationApi from '../Api/locationApi'

export default defineComponent(
    {
        name: "HomeComponent",
        components: {
            NavbarComponent,
            PostComponent,
        },
        props: {

        },
        data() {
            const inputSearch = ref(null)
            const show_BoxChooseLocation = ref(null)
            const nameLocation = ref([])
            const roomPrice = ref([])
            const cities = ref([])
            const locations = ref([])
            const area = ref([])
            const posts = ref([])
            const selectedLocation  = ref([])
            const queryLocation = ref([])
            const notification_bar = ref(true)
            const black_screen = ref(true)
            const showLocaing_location = ref(true)
            const openSearchPrice = ref(false)
            const openSearchArea = ref(false)

            return {
                posts,
                notification_bar,
                area,
                inputSearch,
                roomPrice,
                cities,
                locations,
                show_BoxChooseLocation,
                black_screen,
                selectedLocation,
                nameLocation,
                queryLocation,
                showLocaing_location,
                openSearchPrice,
                openSearchArea
            }
        },
        methods: {

            checkUser(){
                axios.post('checkSession')
            },

            filterFeedBackData(post_id) {
                return this.treeFeedback.feedback.filter(item => item.post_id === post_id)
            },

            // Send comment
            AddComment(postId, parentId, index, event) {
                try {
                    event.preventDefault();

                    const Hours = useDateFormat(useNow(), 'DD/MM/YYYY')
                    const newComment = {
                        id: Math.floor(Math.random() * 1000),
                        username: this.user[0].username,
                        avatar: this.user[0].avatar,
                        post_id: postId,
                        content: this.commentData,
                        created_time: Hours,
                        parent_id: parentId,
                        feedback: []
                    };

                    this.treeFeedback.feedback.push(newComment);
                    this.commentData = '';
                } catch (error) {
                    console.error("Error:", error);
                }
            },

            async getBySearch(name,on,under){
                const data = {
                    name: name,
                    on: on,
                    under: under
                }
                const response = await postApi.searchPriceOrArea(data);

                this.black_screen = true
                this.openSearchPrice = false
                this.openSearchArea = false

                if(!response.error){
                    this.posts = response

                }else{
                    Swal.fire({
                    title: "Thông Báo!",
                    text: "Không Tìm Thấy Bài Đăng Phù Hợp",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                    })
                }
            },

            async searchInput(){
                const response =  await postApi.searchInputAll(this.inputSearch);

                if(!response.error){

                    this.posts = response
                }else{
                    Swal.fire({
                    title: "Thông Báo!",
                    text: "Không Tìm Thấy Bài Đăng Phù Hợp",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                    })
                }
            },

            async getLocationByParent_id(){
                this.show_BoxChooseLocation = 1
                this.black_screen = !this.black_screen
            },

            async off_filter_location(){
                this.show_BoxChooseLocation = null
                this.black_screen = true
                this.openSearchPrice = false
                this.openSearchArea = false

                if(this.queryLocation.length > 0){
                    const data = {
                        province_id: this.queryLocation['1'],
                        district_id: this.queryLocation['2']?this.queryLocation['2']:0
                    }

                    const response =  await postApi.searchByLocation_Id (data);
                    if(!response.error){
                        this.posts = response
                    }else{
                        Swal.fire({
                        title: "Thông Báo!",
                        text: "Không Tìm Thấy Bài Đăng Phù Hợp",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                        })
                    }
                }else{
                    const response =  await postApi.listPost();
                    this.posts = response
                }
            },

            async clickSeleted(item,type){

                if(type == 0){
                    this.queryLocation = []
                    this.selectedLocation[item.type] = item
                    this.nameLocation['1'] = item
                }else{
                    this.queryLocation[item.type] = item.id
                    this.showLocaing_location = false
                    this.selectedLocation[item.type] = item.name

                    const response =  await locationApi.getLocationByParent_id(item.id,type);
                    if(Object.keys(response.locations).length != 0 ){
                        if(type < 3){
                            this.show_BoxChooseLocation = type
                        }
                    }
                    this.locations[type] = response.locations
                    this.nameLocation[item.type] = item.name
                    this.showLocaing_location = true
                }
            },

            // Tìm kiếm theo địa chỉ đã chọn
            async loadLocation(){
                const response =  await locationApi.getLocationByParent_id(0,1);
                if(!response.error){
                    this.locations['1'] = response.locations
                }
            },

            dropdownBoxSearch(text){
                if(text === "price"){
                    this.openSearchPrice = !this.openSearchPrice
                }else{
                    this.openSearchArea = !this.openSearchArea
                }

                this.black_screen = !this.black_screen

            }
        },
        created() {
            this.infoPost = postApi.listPost()
            this.romePrice = romePriceApi.Price();
            this.area = areaApi.Area();
            this.loadLocation();

        }
    }
)


</script>

<style scoped>

    .view_home .advertise {
        padding: 0;
        display: flex;
        justify-content: center;
    }

    .view_home .advertise .advertisement{
        position: fixed;
        width: 200px;
        height: 600px;
        overflow: auto;
        padding-top: 10px;
    }

    .App .view_home .advertise .advertisement img{
        width: 100%;
        height: 100%;
        padding-top: 15%;
        padding-bottom: 20%;
    }

    .App.fix_body .view_home .advertise .advertisement img{
        width: 100%;
        height: 100%;
        padding-top: 30%;
        padding-bottom: 0%;
    }

    /* .view_home .advertise:nth-child(1) .advertisement img{

    } */

    .HomeComponent{
        position: relative;
    }

    .view_main .parent_header_search{
        background-color: #fff;
        padding: 10px;
        position: relative;
    }

    .view_main .header_search{
        width: 100%;
        height: 48px;
        background-color: #F2F2F2;
        border: 1px solid #F2F2F2;
        border-radius: 8px;
        padding: 6px 0px;
        display: flex;
        align-items: center;
    }

    .view_main .header_search .searchLocation{
        cursor: pointer;
        float: left;
        width: 200px !important;
    }

    .view_main .header_search .searchLocation .listsearch{
        position: relative;
        color: #2C2C2C;
        /* display: flex;
        align-items: center; */
    }

    .searchLocation .listsearch .icon_location {
        float: left;
        margin: 5px 0px 4px 12px;
    }

    .searchLocation .listsearch .name_search{
        font-size: 14px;
        line-height: 20px;
        float: left;
        color: rgb(44, 44, 44);
        font-family: "Lexend Medium", Roboto, Arial !important;
        font-weight: normal !important;
        padding: 2px 0px;
        margin: 6px 0px 5px 8px;
    }

    .searchLocation .listsearch .fa-solid.fa-chevron-down{
        float: right;
        padding: 4px 0px 4px 0px;
        margin: 4px 12px 4px 12px;
        color: #999;
        transition: transform .4s ease;
    }

    .searchLocation .listsearch span.postfix-div{
        position: absolute;
        content: "";
        display: block;
        width: 0px;
        height: 30px;
        left: calc(100% + 2px);
        top: 4px;
        border-width: 1px;
        border-style: solid;
        border-color: rgb(204, 204, 204);
        border-image: initial;
    }

    .view_main .header_search i.bi.bi-search{
        float: left;
        text-align: center;
        margin: auto;
        font-size: 18px;
        padding: 7px 7px 7px 15px;
    }

    .view_main .header_search .LocationInputSearch{
        float: left;
        display: block;
        flex: 1 0 auto;
    }

    .view_main .header_search .LocationInputSearch input.input_search{
        width: 100%;
        height: 32px;
        display: block;
        outline: none;
        border: none;
        background-color: transparent;
    }

    .view_main .header_search button.btnSearch{
        float: right;
        margin: 0 7px;
        padding: 6px 13px;
        max-height: 32px;
        max-width: 90px;
        flex: 1 0 auto;
        display: flex;
        align-items: center;
        color: #fff;
        background: #ff5d26;
        border: solid 1px #ff5d2631;
        font-family: "Lexend Medium", Roboto, Arial !important;
        font-size: 14px;
        line-height: 20px;
        font-weight: normal !important;
        letter-spacing: -.2px;
        padding: 5px 11px;
        border-radius: 4px;
    }

    .view_main .header_search button.btnSearch:hover{
        background-color: rgb(255, 93, 38,0.7);
    }

    /* Khung tìm kiếm theo địa chỉ */

    .filterLocation .box_search_locations {
        display: none;
        position: fixed;
        z-index: 99999;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        width: 30px;
        height: 30px;
        border: 3.5px solid #45474b;
        border-radius: 50%;
        border-style:  dotted ;
        animation: spin 2.5s infinite linear;
    }

    @keyframes spin {
        100%{
            transform: rotate(360deg);
        }
    }

    .filterLocation .black_overlay{
        display: none;
        background-color: rgba(0, 0, 0, .5);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 999;
    }

    .filterLocation .filter_group{
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 99999;
        background-color: #fff;
        overflow: hidden;
        width: 680px;
        max-height: 490px;
        margin: auto;
        border-radius: 8px;
    }

    .filterLocation .box_search_locations.show,
    .black_overlay.show,
    .filter_group.show{
        display: block;
    }

    .filterLocation .filter_group .header{
        padding: 10px;
        border-bottom: 1px solid #CDCDCD;
        text-align: center;
        font-weight: 500;
        font-size: 18px;
    }

    .filterLocation .filter_group .header i.fa-solid.fa-arrow-left{
        float: left;
        align-items: center;
        font-size: 18px;
        margin: 5px;
        cursor: pointer;
    }

    .filterLocation .filter_group .content{
        width: 100%;
        height: calc(100% - 40px);
        overflow-y: scroll;
        -webkit-overflow-scrolling: touch;
        /* padding: 10px 25px; */
    }

    .filterLocation .filter_group .content ul>li{
        padding: 12px 10px 12px 25px;
        border-bottom: 1px solid #ddd;
        font-size: 1.1rem;
        position: relative;
        cursor: pointer;
    }

    .filterLocation .filter_group .content ul>li::before{
        background: url(../../image/cirlcle-rec.svg) center no-repeat;
        background-size: contain;
        width: 15px;
        height: 15px;
        position: absolute;
        top: 50%;
        left: 0;
        margin-top: -8px;
        display: block;
        content: "";
        opacity: .45;
    }

    .filterLocation .filter_group .content ul>li.selected::before{
        background: url(../../image/cirlcle-rec-active.svg) center no-repeat;
        background-size: contain;
        opacity: 1;
    }

    .filterLocation .filter_group .content ul>li.selected{
        color: #ff5d26;
        font-weight: 500;
        font-family: Arial, Helvetica, sans-serif;
    }


    .info {
        width: 100vw;
        height: 100vh;
        position: absolute;
        top: 27%;
        left: 0;
        right: 0;
        z-index: 9999;
        text-align: center;
        animation: slideInTop ease .2s, fadeOut linear 1s 2s forwards;
    }

    .info div span{
        width: auto;
        background-color: rgb(255, 0, 0,0.7);
        padding: 10px 10px;
        color: #fff;
        border-radius: 8px ;
        font-size: 18px;
        font-weight: 490;
        margin: auto;
    }

    @keyframes slideInTop {
        from {
            opacity: 0;
            /* transform: translateY(calc(100% + 32px)); */
        }
        to{
            opacity: 1;
            /* transform: translateY(0); */
        }
    }

    @keyframes fadeOut {
        to{
            opacity: 0;
        }
    }

    /* responsive */
    @media only screen and (max-width: 1200px) {
        .view_home .advertise .advertisement {
            display: block;
            position: fixed;
            width: 150px;
            height: 600px;
            overflow: auto;
            padding-top: 10px;
        }

        .view_home .main_home .list-group-search .list-group-item a {
            font-size: 13px;
        }
    }

    @media only screen and (max-width: 992px) {
        .view_home .advertise .advertisement {
            display: none;
            position: fixed;
            width: 150px;
            height: 600px;
            overflow: auto;
            padding-top: 10px;
        }

        .view_home .main_home .list-group-search .list-group-item a {
            font-size: 14px;
        }
    }

    @media only screen and (max-width: 768px) {
        .view_home .main_home .search-acreage,
        .view_home .main_home .search-price {
            max-height: 58px;
            overflow: hidden;
        }

        .filterPrice,
        .filterAcreage{
            position: fixed;
            top: 45%;
            left: 10%;
            right: 10%;
            bottom: 0;
            z-index: 9999;
            overflow: hidden;
        }

        .filterPrice .list-group,
        .filterAcreage .list-group{
            border: 1px solid #dedede;
            border-radius: 8px ;
        }

        .filterLocation .filter_group{
            width: 540px;
            max-height: 400px;
        }
    }

    @media only screen and (max-width: 600px) {

        .view_home .view_main .the_right{
            display: none;
        }

        .view_main .header_search .searchLocation{
            max-width: 100px;
        }

        .view_main .header_search i.bi.bi-search,
        .searchLocation .listsearch .name_search{
            font-size: 12px;
        }

        .searchLocation .listsearch .fa-solid.fa-chevron-down{
            display: none;
        }

        .swiper-slide img {
            height: auto;
        }

        .filterLocation .filter_group{
            width: 100vw;
            max-height: 100vh;
        }
    }

    @media only screen and (max-width: 477px) {
        .container-fluid{
            padding-left: 0px;
            padding-right: 0px;
        }

        .row>* {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding: 0px;
            margin-top: var(--bs-gutter-y);
        }

        .view_main .header_search .searchLocation{
            max-width: 40px;
        }

        .searchLocation .listsearch .name_search{
            display: none;
        }

        .searchLocation .listsearch .icon_location{
            margin: 5px 0px 4px 14px;
        }

        .view_main .header_search .LocationInputSearch input{
            font-size: 10px;
        }

        .view_main .header_search button.btnSearch{
            font-size: 10px;
            max-height: 25px;
            max-width: 65px;
        }

        .filterPrice,
        .filterAcreage{
            position: fixed;
            top: 30%;
            left: 10%;
            right: 10%;
            bottom: 0;
            z-index: 9999;
            overflow: hidden;
        }

        .the_right {
            display: none;
        }

        .view_main .header_search button.btnSearch{
            display: none;
        }
    }
</style>
