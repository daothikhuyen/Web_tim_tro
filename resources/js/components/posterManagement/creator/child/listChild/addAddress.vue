<template>
    <section class="Address_detail d-md-block ps-3" >
        <div class="location pb-3">
            <select class="input_item" name="cityLocation" id="cityLocation" @change="getFullAddress(selectedCity)"  v-model="selectedCity">
                <option :value="null" disabled selected>--Chọn Tỉnh/TP--</option>
                <option v-for="city in getLocation.message" :key="city"  :value="city" >{{city.name}}</option>
            </select>
        </div>
        <div class="location pb-3">
            <select class="input_item" name="districtLocation" id="districtLocation" @change="getFullAddress(selectedDistrict)" v-model="selectedDistrict">
                <option :value="null" disabled selected>--Chọn Quận/Huyện--</option>
                <option v-if="!selectedCity" value=""></option>
                <option v-else v-for="district in selectedCity.location" :key="district"  :value="district" >{{district.name}}</option>
            </select>
        </div>
        <div class="location pb-3">
            <select class="input_item" name="wardsLocation" id="wardsLocation" @change="getFullAddress(selectedWard)" v-model="selectedWard">
                <option :value="null" disabled selected>--Chọn Phường/Xã--</option>
                <option v-if="!selectedDistrict" value=""></option>
                <option  v-else v-for="ward in selectedDistrict.location" :key="ward"  :value="ward" >{{ward.name}}</option>
            </select>
        </div>
        <div class="location pb-3">
            <select class="input_item" name="streetLocation" id="streetLocation" @change="getFullAddress(selectedStreet)" v-model="selectedStreet">
                <option :value="null" disabled selected>--Chọn Đường/Phố--</option>
                <option v-if="!selectedWard" value=""></option>
                <option v-else v-for="street in selectedWard.location" :key="street"  :value="street" >{{street.name}}</option>
            </select>
        </div>
    </section>
    <div class="input_number_fulladdress">
        <div class="number_house ps-3">
            <div class="post_title">Số Nhà</div>
            <input type="text" name="number_home" id="number_home" class="w-100 input_item" v-model="numberHome"  @keyup.enter="getFullAddress(numberHome)" tag="Nhập số nhà ">
        </div>
        <div class="info-item full_address ps-3">
            <div class="post_title">Địa chỉ đầy đủ</div>
            <div class="fullAddress"  name="fullAddress" id="fullAddress">
                <span v-for="(item,index) in fullAdress" :key="index">
                    {{item}}
                    <span v-if="index != fullAdress.length -1 ">- </span>
                </span>

            </div>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'
import {mapState,mapActions} from 'vuex'
import locationApi from '../../../../../Api/locationApi.js'

export default defineComponent({
    name : "addAdress",
    computed: {
        // ...mapState(['getLocation'])
    },
    props:{
        createAddress : Function
    },
    data() {
        const selected = ref([])

        const index = ref(0)
        const textFullAfress = ref("")
        const selectedCity = ref(null)
        const selectedDistrict = ref(null)
        const selectedWard = ref(null)
        const selectedStreet = ref(null)
        const numberHome = ref(null)

        return {
            selected,
            getLocation: [],
            textFullAfress,

            index,
            getCity : [],
            fullAdress : [],
            location_id : [],
            selectedCity,
            selectedDistrict,
            selectedWard,
            selectedStreet,
            numberHome,
        }
    },
    mounted(){
    },
    methods: {


        getFullAddress(selected){
            let array = []
            console.log(selected.title)
            switch (selected.title) {
                case "Thành Phố":
                    this.selectedDistrict = ref(null)
                    this.selectedWard = ref(null)
                    this.selectedStreet = ref(null)
                    this.numberHome = ref(null)
                    array = [this.selectedCity.name]
                    this.location_id['province_id'] = this.selectedCity.id
                    break;

                case "Quận Huyện":
                    this.selectedWard = ref(null)
                    this.selectedStreet = ref(null)
                    this.numberHome = ref(null)
                    array = [this.selectedDistrict.name, this.selectedCity.name]
                    this.location_id['district_id'] = this.selectedDistrict.id

                    break;
                case "Phường Xã":
                    this.selectedStreet = ref(null)
                    this.numberHome = ref(null)
                    array = [this.selectedWard.name, this.selectedDistrict.name, this.selectedCity.name]
                    this.location_id['ward_id'] = this.selectedWard.id
                    break;
                case "Đường Phố":
                    this.numberHome = ref(null)
                    array = [this.selectedStreet.name, this.selectedWard.name, this.selectedDistrict.name, this.selectedCity.name]
                    this.location_id['street_id'] = this.selectedStreet.id
                    break;
                default:
                    console.log(this.selectedStreet)
                    if(this.selectedStreet != null){
                        array = [this.numberHome,this.selectedStreet.name, this.selectedWard.name, this.selectedDistrict.name, this.selectedCity.name]
                    }else{
                         array = [this.numberHome, this.selectedWard.name, this.selectedDistrict.name, this.selectedCity.name]
                    }
                    break;
            }

            this.fullAdress= array

            this.createAddress(this.fullAdress,this.selectedCity.name,this.location_id)
        },


    },
    async created(){
        // this.getLocation = this.$store.dispatch('getLocation');
        this.getLocation = await locationApi.getLocation()
        console.log(this.getLocation.message)
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

    .info .input_item:hover{
        border: 1px solid black;
    }

    .fullAddress {
        width: 100%;
        height: auto;
        min-height: 38px;
        padding: 5px;
        margin: auto 0;
        border-radius: 2px;
        line-height: 25px;
        background-color: rgb(162, 160, 160,0.15);
    }

    input[type = 'text']:focus{
        background: #ffff;
        outline: none;
    }
</style>

