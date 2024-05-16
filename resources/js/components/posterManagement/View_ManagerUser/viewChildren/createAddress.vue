<template>
    <div class="address col-md-5">
        <div class="">
            <h5>Địa chỉ cho thuê</h5>
        </div>
        <section class="Address_detail d-md-block ps-3 pt-4" >
            <div class="location pb-3">
                <select name="cityLocation" id="cityLocation"  @change="pushDistrict()" v-model="selectedCity">
                    <option :value="null" disabled selected>--Chọn Tỉnh/TP--</option>
                    <option v-for="city in getCity" :key="city"  :value="city" >{{city.name}}</option>
                </select>
            </div>
            <div class="location pb-3">
                <select name="districtLocation" id="districtLocation"  @change="pushWards()" v-model="selectedDistrict">
                    <option :value="null" disabled selected>--Chọn Quận/Huyện--</option>
                    <option v-for="district in getDistrict" :key="district"  :value="district" >{{district.name}}</option>
                </select>
            </div>
            <div class="location pb-3">
                <select name="wardsLocation" id="wardsLocation"  @change="pushStress()" v-model="selectedWard">
                    <option :value="null" disabled selected>--Chọn Phường/Xã--</option>
                    <option v-for="ward in getWards" :key="ward"  :value="ward" >{{ward.name}}</option>
                </select>
            </div>
            <div class="location pb-3">
                <select name="stressLocation" id="stressLocation" v-model="selectedStress">
                    <option :value="null" disabled selected>--Chọn Đường/Phố--</option>
                    <option v-for="stress in getStress" :key="stress"  :value="stress" >{{stress.name}}</option>
                </select>
            </div>
        </section>
        <div class="input_number_fulladdress">
            <div class="number_house ps-3">
                <div class="post_title">Số Nhà</div>
                <input type="text" name="number_home" id="number_home" class="w-100 input_item" v-model="numberHome"  @keyup.enter="getFullAddress()">
            </div>
            <div class="info-item full_address ps-3">
                <div class="post_title">Địa chỉ đầy đủ</div>
                <input type="text" name="fullAddress" id="fullAddress" class="w-100 input_item" :value="fullAdress">
            </div>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'
import locationApi from '../../../../Api/locationApi'

export default defineComponent({
    props:{
        createAddress : Function
    },
    data() {

        const addressFull = ref([])

        const selectedCity = ref(null)
        const selectedDistrict = ref(null)
        const selectedWard = ref(null)
        const selectedStress = ref(null)
        const fullAdress = ref(null)
        const numberHome = ref(null)
        return {
            addressFull,
            getCity : [],
            getDistrict: [],
            getWards: [],
            getStress: [],

            selectedCity,
            selectedDistrict,
            selectedWard,
            selectedStress,
            numberHome,
            fullAdress
        }
    },
    mounted(){
        this.pushCity(0)
    },

    methods: {

        pushCity(id = 0){
            this.getCity = locationApi.getLocation(0)
        },

        pushDistrict(){
            this.getDistrict = locationApi.getLocation(this.selectedCity.id)
        },

        pushWards(){
            this.getWards = locationApi.getLocation(this.selectedDistrict.id)
            console.log(this.selectedDistrict);
        },

        pushStress(){
            this.getStress = locationApi.getLocation(this.selectedWard.id)
        },

        getFullAddress(){
            const address = this.numberHome +","+this.selectedStress.name+","+this.selectedWard.name+","+ this.selectedStress.name+","+ this.selectedCity.name
            this.fullAdress = address
            this.createAddress(this.fullAdress)
        }



    },
    created(){

    }
})
</script>

<style scoped>
    .info .info-item{
        margin-top: 20px;
    }

    .info .Address_detail select{
        width: 100%;
        padding: 5px;
        border: 1px solid rgb(162, 160, 160,0.5);
        border-radius: 2px;
    }

    .info .input_number_fulladdress .input_item,
    .info .info_detail .input_item{
        width: 100%;
        padding: 5px;
        border: 1px solid rgb(162, 160, 160,0.5);
        border-radius: 2px;
    }
</style>

