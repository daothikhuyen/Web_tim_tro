<template>
    <div class="info-item image">
        <div class="main_title">
            <h5>Hình Ảnh </h5>
        </div>
        <div class="post_title">
            Cập nhật hình ảnh rõ ràng sẽ cho thuê nhanh hơn
        </div>
        <div class="upload_image mb-1">
            <div class="imagePreviewWrapper">
                <div>Thêm ảnh</div>
                <img src="/storage/uploads/2024/05/09/camera.png" alt="">
            </div>
            <div class="rightRound" id="upload">
                <input type="file" name="file" class="file" ref="fileInput" multiple accept=".png,.jpg" @change="onUploadFile">
            </div>
        </div>
        <div class="error w-100 ps-2">
            <span class="text-danger"><small>{{notifi}}</small></span>
        </div>
        <div class="container">
            <div class="card_picture" v-for="(image,index) in images" :key="index">
                <span class="delete" @click="deleteImage(index)">&times;</span>
                <img :src="image.url"/>
            </div>
        </div>

    </div>

    <div class="info-item video">
        <div class="main_title">
            <h5>Video</h5>
        </div>
        <div class="post_title">
            Upload video của bạn
        </div>
        <div class="upload_image">
            <div class="imagePreviewWrapper">
                <div>Thêm video</div>
                <img src="/storage/uploads/2024/05/09/video.png" alt="">
            </div>
            <div class="rightRound" id="upload">
                <input type="file" name="file" class="file" ref="fileInput" accept=".mp4" multiple @change="onUploadFile">
            </div>
        </div>
        <section class="loading-area">
            <div class="row_area" v-for="(file,index) in files" :key="index">
                <i class="icon fa-solid fa-file" style="font-size: 30px;"></i>
                <div class="content upload" >
                    <div class="detail">
                        <span class="name">{{ file.name }}</span>
                        <span class="size">{{ file.loading }}</span>
                    </div>
                    <div class="loading-bar">
                        <div class="loading" :style="{width: file.loading + '%'}"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="upload-area" >
            <div class="row_area" v-for="(file,index) in uploadFiles" :key="index">
                <div class="content upload">
                    <i class="icon fa-solid fa-file" style="font-size: 30px;" aria-hidden="true"></i>
                    <div class="detail">
                        <span class="name">{{ file.name }}</span>
                        <span class="size">{{ file.size }}</span>
                    </div>
                </div>
                <div>
                    <i class="icon fa-solid fa-check"></i>
                </div>
            </div>
        </section>
    </div>

</template>

<script>
import { ref, defineComponent } from 'vue'

export default defineComponent({
    name: "Add image into post",
    props: {
        notifi : String
    },
    data(){

        const showProgress = ref(false)
        return {
            images : [],
            uploadFiles: [],
            files: [],
            showProgress
        }
    },
    methods:{

        onUploadFile(event){
            const files = event.target.files
            if(files.length == 0) return
            for (let i = 0; i < files.length; i++) {
                const file = files[i]
                const fileName = (file.name.length >= 12) ? file.name.substring(0,13) + '....'+ file.name.split('.')[1]: file.name

                const formData = new FormData()
                formData.append("file", file)
                if(file.type.split('/')[0] == 'video'){
                    this.files.push({name: fileName, loading : 0})
                    this.showProgress = true
                }

                axios.post('upload-file', formData, {
                    onUploadProgress: ({loaded, total}) => {
                        // console.log(file.type.split('/')[0])
                        if(file.type.split('/')[0] == 'image'){
                            if(!this.images.some((e) => e.name == files[i].name)){
                                this.images.push({name: files[i].name, url: URL.createObjectURL(files[i])})
                            }

                        }
                        else if(file.type.split('/')[0] == 'video'){
                            this.files[this.files.length - 1].loading = Math.floor((loaded/total)*100);
                            if(loaded == total){
                                const fileSize = (total > 1024)? total + 'KB' : (loaded/(1024*1024)).toFixed(2) + 'MB'
                                this.uploadFiles.push({name: fileName, size: fileSize});
                                this.files = [];
                                this.showProgress = false
                            }
                        }
                    }
                }).then((result) => {
                    if(file.type.split('/')[0] == 'image'){
                        this.$emit('loadImage', result.data.url)
                    }
                    if(file.type.split('/')[0] == 'video'){
                        this.$emit('loadVideo', result.data.url)
                    }

                })
                .catch(error => {
                    alert("Đã Xảy Ra lỗi")
                    console.error(error);
                })
            }

        },

        deleteImage(index){
            this.images.splice(index,1)
        },

    }
})
</script>

<style scoped>
    .info .info_detail .upload_image{
        height: 160px;
        border:  1px dashed rgb(162, 160, 160,0.5);
        border-radius: 2px ;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
        position: relative;
    }

    .info .info_detail .upload_image .rightRound{
        position: absolute;
        margin: 5px;
        bottom: 16px;
        left: 20px;
        text-align: center;
        width: 99%;
        height: 95%;
        overflow: hidden;
        line-height: 33px;
        cursor: pointer;
    }

    .upload_image img{
        height: 65px;
        text-align: center;
        object-fit: cover;
        object-position: center;
    }

    .homeManager .ViewPost .info .info_detail .upload_image input[type='file']{
        position: absolute;
        transform: scale(10);
        opacity: 0;
    }

    /* pictures post */
    .image .container{
        width: 100%;
        height: auto;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-wrap: wrap;
        max-height: 200px;
        position: relative;
        margin-bottom: 8px;
        padding-top: 15px;
        overflow-y: scroll;
    }

    .image .container::-webkit-scrollbar{
        width: 0%;
    }

    .image .container .card_picture {
        width: 75px;
        margin-right: 5px;
        height: 75px;
        position: relative;
        margin-bottom: 8px;
    }

    .image .container .card_picture span{
        position: absolute;
        top: -2px;
        right: 9px;
        font-size: 20px;
        color: #fff;
        font-weight: 600;
        cursor: pointer;
    }

    .image .container .card_picture img{
        width: 100%;
        height: 100%;
        object-position: center;
        object-fit: cover;
    }

     /* video */
    section .row_area{
        background: #d0ffd3;
        list-style: none;
        padding: 10px;
        margin: 8px;
        border-radius: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    section .row_area .icon {
        color: #0a8740;
        padding-right: 7px;
    }

    section .row_area .content {
        display: flex;
        justify-content: space-between;
    }

     section .row_area .content .detail .size{
        color: rgb(128, 128, 128);
        font-size: 11px;
    }


    .loading-area .content{
        width: 100%;
        margin-left: 15px;
        display: flex;
        flex-direction: column;
    }

    .loading-area .detail{
        width: 100%;
        display: flex;
        align-items: center;
        margin-bottom: 7px;
        justify-content: space-between;
    }

    .loading-area .content .loading-bar {
        height: 6px;
        width: 100%;
        margin-bottom: 4px;
        background: #fff;
        border-radius: 30px;
    }

    .content .loading-bar .loading {
        height: 100%;
        width: 0%;
        background: #1aaa4c;
        border-radius:inherit ;
    }

    .upload-area {
        max-height: 232px;
        overflow-y: scroll;
    }

    .upload-area.onprogress{
        max-height: 150px ;
    }

    .upload-area::-webkit-scrollbar{
        width: 0%;
    }

    .upload-area .row_area .content .detail{
        display: flex;
        margin-left: 15px;
        flex-direction: column;
    }

</style>
