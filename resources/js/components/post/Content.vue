<template>
    <div class="info_post py-3">
        <section class="header">
            <h6 class="title">{{ postData.title }}</h6>
            <span class="info_price_arceage px-2">
                <span class="price">{{ postData.price }}</span>
                <span class="arceage"> - {{ postData.arceage }}m<sup>2</sup> </span>
            </span>
        </section>
        <div class="address">
            <i class="fa-solid fa-location-dot"></i>
            <span class="ps-1">{{postData.full_address }}</span>
        </div>
        <div class="extension ps-2" v-if="extensions.length != 0">
            <span class="title">Tiện ích:</span>
            <span class="ps-1" v-for="(extension,index) in extensions" :key="index">
                <span >{{extension.name}}</span>
                <span v-if="index !== extensions.length -1">,</span>
            </span>
        </div>
        <div class="description p-2">
            <span class="title">Mô tả chi tiết:</span> <br>
            <span  v-if="isSeeMoreDescription">
                <span class="ps-2 content" id="descriptionContent" v-html="postData.description"></span>
            </span>
            <span v-else>
                <span class="ps-2 content" id="descriptionContent" v-html="postData.description.substring(0, 500)"></span>
                <span class="description_etc" :class="{ hide: isSeeMoreDescription }">...</span>
            </span>

            <span class="btn-action" :class="{ hide: !isPostContextTooLong }">
                <div class=" my-2 border-top py-2 d-flex justify-content-center">
                    <button class="btn-SeeMore" :class="{ hide: isSeeMoreDescription }"
                        @click="SeeMoreDescription()">Xem thêm <i class="bi bi-arrow-down-square"></i> </button>
                    <button class="btn-short" :class="{ hide: !isSeeMoreDescription }" @click="ShortDescription()">Rút
                        gọn <i class="bi bi-arrow-up-square"></i></button>
                </div>
            </span>
        </div>
        <div class="post_image mt-2 px-2 py-1">
            <div class="swiper">
                <Carousel class="swiper-wrapper">

                    <Slide v-for="slideOne in videos" :key="slideOne.id" class="swiper-slide">
                        <video width="320" height="240" controls class="carousel__item">
                            <source :src="slideOne.video" type="video/mp4">
                        </video>
                    </Slide>
                    <Slide v-for="slideTwo in images" :key="slideTwo.id" class="swiper-slide">
                        <img :src="slideTwo.image" alt="">
                    </Slide>
                    <template #addons>
                        <Navigation />
                        <Pagination />
                    </template>
                </Carousel>
            </div>
        </div>
    </div>
</template>
<script>
import 'vue3-carousel/dist/carousel.css'

import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
import { defineComponent, ref } from 'vue'
export default defineComponent({
    props: {
        postData: Object,
        images: Array,
        videos: Array,
        extensions: Array
    },
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
    data() {
        console.log("hello" + this.video)
        const isSeeMoreDescription = ref(this.postData.description.length < 500)
        const isPostContextTooLong = ref(this.postData.description.length > 500)
        return {
            isSeeMoreDescription,
            isPostContextTooLong,
        }
    },
    methods: {
        SeeMoreDescription(index) {
            this.isSeeMoreDescription = true;
        },

        ShortDescription(index) {
            this.isSeeMoreDescription = false;
        },

    },
})
</script>
