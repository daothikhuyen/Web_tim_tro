<template>
   <div class="ViewPost w-100 m-auto pb-4">
        <div class="row">
            <div class="col-lg-9 col-md-12 mt-5">
                <div class="p-2 ps-3 mx-2 rounded-3 w-100"  style="background-color: rgb(162, 160, 160,0.25)">
                    <span class="title">PhongTot</span> / <span class="title">Quản lí </span>/ <span>Đăng tin mới</span>
                </div>
                <div class="pt-4">
                    <h5 class="ps-3">Đăng Tin Mới</h5>
                    <hr>
                </div>
                <section class="info px-3 py-3 row">
                    <div class="col-md-4">
                        <div class="address">
                            <div class="">
                                <h5>Địa chỉ cho thuê</h5>
                            </div>
                            <div class="w-100 ps-3 pb-3">
                                <span class="text-danger">{{error['address']}}</span>
                            </div>
                            <addAddress :createAddress="createAddress" />
                        </div>
                        <div class="extentsion mt-3">
                            <div>
                                <h5>Tiện ích</h5>
                            </div>
                            <Extension  :loadExtension="loadExtension" />
                        </div>
                    </div>
                    <div class="detail_info ps-3 col-md-8">
                        <div class="info_detail">
                            <div class="">
                                <h5>Thông tin bài đăng</h5>
                            </div>
                            <section class="ps-3">
                                <div class="info-item">
                                    <div class="post_title">
                                        Tiêu đề <span class="text-danger">*</span>
                                    </div>
                                    <input type="text" name="title" id="title" class="input_item w-100 " placeholder="Cho Thuê Nhà Ở Đà Nẵng" v-model="title">
                                    <div class="w-100 ps-2">
                                        <span v-if="!error['title']" class=""><small>Tối thiếu 30 ký tự, tối đa 99 ký tự</small></span>
                                        <span v-else class="text-danger"><small>{{error['title']}}</small></span>
                                    </div>
                                </div>
                                <div class="info-item mt-3">
                                    <div class="post_title mt-0">
                                        Giá cho thuê <span class="text-danger">*</span>
                                    </div>
                                    <div class="input_special d-flex justify-content-between align-items-center">
                                        <input type="text" name="price" id="price" class="input_item" placeholder="Nhập đầy đủ các số, ví dụ 1000000" v-model="textPrice">
                                        <div class="">VND/Tháng</div>
                                    </div>
                                    <div class="w-100 ps-2">
                                        <!-- <span v-if="!error['price']" class="attention"><small>Tối thiếu 30 ký tự, tối đa 99 ký tự</small></span> -->
                                        <span class="text-danger"><small>{{error['price']}}</small></span>
                                    </div>
                                </div>
                                <div class="info-item contactInfo mb-3">
                                    <div class="post_title">
                                        Diện tích <span class="text-danger">*</span>
                                    </div>
                                    <div class="input_special d-flex justify-content-between align-items-center">
                                        <input type="text" class="input_item" placeholder="Nhập diện tích, VD: 20" v-model="textArea">
                                        <div class="">m<sup>2</sup></div>
                                    </div>
                                    <div class="w-100 ps-2">
                                        <span class="text-danger"><small>{{error['area']}}</small></span>
                                    </div>
                                </div>
                                <div class="info-item description">
                                    <div class="post_title">
                                        Nội dung mô tả <span class="text-danger">*</span>
                                    </div>
                                    <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
                                    <div class="w-100 ps-2">
                                        <span class="text-danger"><small>{{error['description']}}</small></span>
                                    </div>
                                </div>
                                <addImage @loadImage="UpdateImage" @loadVideo="UpdateVideo" :notifi="error['image']" />
                            </section>
                        </div>
                    </div>
                </section>

                <div class="btn_submit ps-2 d-flex justify-content-md-end justify-content-center">
                    <button class="button" type="submit" @click.prevent="ValidatorForm()">Tiếp theo</button>
                </div>
            </div>
            <div class="col-lg-3 d-lg-block d-none mt-5 pt-5">
                <div class="note_post">
                    <h3>Lưu ý khi đăng tin</h3>
                    <ul class="">
                        <li>Nội dung phải viết bằng Tiếng Việt, có dấu</li>
                        <li>Tiêu đề không dài quá 100 kí tự</li>
                        <li>Các bạn nên điền đầy đủ thông tin để tin có thể đạt hiểu suất nhanh</li>
                        <li>Để để tạo sự tin cậy các bạn nên đăng ảnh và video rõ ràng , địa chỉ cũ thể !</li>
                    </ul>

                </div>

            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {ref,defineComponent } from 'vue'
import {mapState,mapActions} from 'vuex'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import user from '../../../../Api/userApi'

import addImage from './listChild/addImages.vue'
import addAddress from './listChild/addAddress.vue'
import Extension from './listChild/extension.vue'

export default defineComponent({
    name: 'CreatePoster',
    computed: {
        ...mapState(['authUser'])
    },
    components: {
        addImage,
        addAddress,
        Extension,
    },
    data() {

        const error= ref([])
        const user = ref({})
        const fullAddress = ref([])
        const location_id = ref([])
        const newPostInfo = ref(null)
        const arrayImage = ref([])
        const arrayvideo = ref([])
        const arrayExtension = ref([])

        const title = ref("")
        const textPrice = ref("")
        const textArea = ref("")
        const textFullAddress = ref("")


        return {
            editor: ClassicEditor,
            editorData: '<p>Nhập nội dung mô tả tại đây</p>',
            editorConfig: {
                toolbar: {
                    items: [
                        'heading',
                        'bold',
                        'italic',
                        'link',
                        'undo',
                        'redo'
                    ]
                }
            },
            error,
            user,
            title,
            textPrice,
            textArea,
            textFullAddress,
            location_id,
            fullAddress,
            newPostInfo,
            arrayImage ,
            arrayvideo,
            arrayExtension
        };
    },
    methods : {

        loadExtension(extension){
            this.arrayExtension = extension
            console.log(this.arrayExtension)
        },

        UpdateImage(imgae){
            console.log(imgae)
            const newImage = {
                id:  Math.floor(Math.random() * 1000),
                link_image: imgae,
                post_id: Math.floor(Math.random() * 1000),
            }
            this.arrayImage.push(newImage)
        },

        UpdateVideo(video){

            const newvideo = {
                id:  Math.floor(Math.random() * 1000),
                link_video: video,
                post_id: Math.floor(Math.random() * 1000),
            }
            this.arrayvideo.push(newvideo)
            console.log(this.arrayvideo)
        },

        ValidatorForm(){
            let checkValidator = ref(false)
            this.error = []
            const arrayText = [
                { value: this.title,      name: "title" },
                { value: this.textPrice,  name: "price" },
                { value: this.textArea ,  name: "area" },
                { value: this.editorData, name: "description" }
            ]
            const arrayInput = [
                { value: this.fullAddress, name:  "address"},
                { value: this.arrayImage,  name: "image"}
            ]

            console.log(arrayText);


            arrayText.forEach(element => {
                if(element.name == "title" && element.value.length < 30 && element.value.length >99){
                    console.log(element.value.length)
                    this.error[element.name] = "Bạn nhập chưa đúng định dạng"
                }

                const match = /^[0-9]+$/;
                if(element.name == "price" && !element.value.match(match)){
                    console.log(element.value.length)
                    this.error[element.name] = "Bạn phải nhập đủ các số VD: 100000"
                }

                if(element.value == ""){
                    this.error[element.name] = "Bạn cần nhập thông tin này"
                }
            });

            arrayInput.forEach(element => {
                if(element.value.length == 0){
                    this.error[element.name] = "Bạn cần chọn thông tin này"
                }
            });


            if(Object.keys(this.error).length === 0){
                console.log("hello")
                checkValidator.value = true
            }

            if(checkValidator.value){
                 console.log("hi")
                this.seenBefore()
            }
        },

        createAddress(address,title,location_id){
            this.fullAddress = address
            this.location_id = location_id
            this.title = "Cho Thuê Nhà Ở " +  title

        },

        seenBefore(){

            try {
                this.user = this.authUser
                this.fullAddress.forEach((element,index) => {
                    this.textFullAddress += element
                    if(index < this.fullAddress.length -1){
                        this.textFullAddress += " - "
                    }
                });

                const newPost = {
                    user : this.user,
                    postData: {
                        id:  Math.floor(Math.random() * 1000),
                        title: this.title,
                        description: this.editorData,
                        full_address: this.textFullAddress,
                        price: this.textPrice,
                        arceage:this.textArea,
                        user_id: this.user.id,
                        province_id: this.location_id['province_id'],
                        district_id: this.location_id['district_id'],
                        ward_id: this.location_id['ward_id'],
                        street_id: this.location_id['street_id'] ?this.location_id['street_id']: "",
                        category_id:1,
                        number_like: 0

                    },
                    extensions: this.arrayExtension,
                    images :this.arrayImage,
                    videos : this.arrayvideo
                }

                // this.$store.commit('CREATE_NEW_POST',newPost)

                this.newPostInfo = newPost
                const jsonData = JSON.stringify(this.newPostInfo);
                this.$router.push({name :'next',params: {data: jsonData}})
            } catch (error) {
                console.log(error)
            }

        }

    }
})
</script>



<style >
    .ViewPost{
        padding-top: 50px;
        margin:30px;
        /* max-height: 100vh;
        overflow-y: scroll; */
    }

    .ViewPost span{
        font-size: 15px;
    }

    .ViewPost .title{
        color: var(--primary-color);
        font-weight: 600;
    }

    .ViewPost .info .post_title{
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
        margin-top: 15px ;
        padding-left: 5px;
    }

    .ViewPost .info .info-item{
        margin-top: 20px;
    }

    .ViewPost .input_number_fulladdress .input_item,
    .ViewPost .input_item{
        width: 100%;
        padding: 5px;
        border: 1px solid rgb(162, 160, 160,0.5);
    }

    .ViewPost .input_special .input_item{
        border: none;
        outline: none;
        width: 90%;
    }

    .ViewPost .input_special div {
        height: auto;
        padding: 4.6px 8px;
    }

    .ViewPost .input_special{
        width: 100%;
        min-width: auto;
        border: 1px solid rgb(162, 160, 160,0.5);
        border-radius: 2px;
        overflow: hidden;
    }

    .input_item:hover{
        border: 1px solid black;
    }

    .input_special:hover{
        border: 1px solid black;
    }

    .input_item.Notification{
        border: 0.05px solid red;
        border-radius: 3px;
    }


    .ViewPost .btn_submit .button{
        width: 64%;
        background-color: var(--primary-color);
        padding: 8px;
        margin: 10px;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        border-radius: 4px;
        text-align: center;
        color: #fff;
    }

    .ViewPost .note_post{
        padding: 10px;
        margin: 20px;
        background-color: #FFEC8B;
        color: #A0522D;
        font-size: 15px;
        border-radius: 8px;
    }

    .ViewPost .note_post ul li {
        list-style: square;
        font-size: 14px;
        line-height: 25px;
    }

    .ViewPost .note_post h3{
        font-size: 18px;
    }

    /* Ckeditor */
    .ck.ck-editor__editable_inline>:last-child {
        margin-bottom: var(--ck-spacing-large);
        height: 200px;
    }

    input:hover{
        border: 1px solid black;
    }

    .attention small {
        font-size: 11px;
        line-height: 16px;
        font-weight: 450;
        color:rgb(162, 160, 160,1);
    }

    @media (max-width: 768px) {
        .ViewPost{
            padding-left: 5rem;
        }

        .ViewPost .info .Address_detail select{
            width: 100%;
            padding: 5px;
            border: 1px solid rgb(162, 160, 160,0.5);
            border-radius: 2px;
        }

    }

</style>
