<template>
    <section class="Address_detail d-md-block ps-md-3">{{newPost}}
        <div class="location pb-3">
            <select class="input_item" name="cityLocation" id="cityLocation" @change="changeCity(select.city)"  v-model="select.city">
                <option :value="null" disabled selected>--Chọn Tỉnh/TP--</option>
                <option v-for="city in filterCity" :key="city.id"  :value="city.id" >{{city.name}}</option>
            </select>
        </div>
        <div class="location pb-3">
            <select class="input_item" name="districtLocation" id="districtLocation" @change="changeDistrict(select.district)" v-model="select.district">
                <option :value="null" disabled selected>--Chọn Quận/Huyện--</option>
                <option v-for="district in filterDistrict" :key="district"  :value="district.id" >{{district.name}}</option>
            </select>
        </div>
        <div class="location pb-3">
            <select class="input_item" name="wardsLocation" id="wardsLocation" @change="changeCityWard(select.ward)" v-model="select.ward">
                <option :value="null" disabled selected>--Chọn Phường/Xã--</option>
                <option  v-for="ward in filterWard" :key="ward"  :value="ward.id" >{{ward.name}}</option>
            </select>
        </div>
        <div class="location pb-3">
            <select class="input_item" name="streetLocation" id="streetLocation" @change="changeCityStreet(select.street)" v-model="select.street">
                <option :value="null" disabled selected>--Chọn Đường/Phố--</option>
                <option v-for="street in filterStreet" :key="street"  :value="street.id" >{{street.name}}</option>
            </select>
        </div>
    </section>
    <div class="input_number_fulladdress">
        <div class="number_house ps-md-3">
            <div class="post_title">Số Nhà</div>
            <input type="text" name="number_home" id="number_home" class="w-100 input_item" v-model="select.numberHome"  @input="getNumber_houer(select.numberHome)" tag="Nhập số nhà ">
        </div>
        <div class="info-item full_address ps-md-3">
            <div class="post_title">Địa chỉ đầy đủ</div>
            <div class="fullAddress"  name="fullAddress" id="fullAddress">
                <span v-if="!textFullAddress">{{fullAddress}}</span>
                <span v-else>
                    {{textFullAddress}}
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'
import {mapState,mapActions, mapGetters} from 'vuex'
import locationApi from '../../../../../Api/locationApi.js'

export default defineComponent({
    name : "addAdress",
    computed: {
        // ...mapState(['getLocation'])
        ...mapGetters(['newPost'])
    },
    props:{
        createAddress : Function,
        locations : Array,
        fullAddress: String
    },
    data() {
        const getLocation = ref([])
        const arrayLocation_Id = ref([])
        const selected = ref([])
        const select = {
            city: ref(null),
            district: ref(null),
            ward: ref(null),
            street: ref(null),
            numberHome: ref(null)
        }

        return {
            getLocation,
            arrayLocation_Id,
            selected,
            select,
            textFullAddress : "",
            full_address : []
        }
    },
    computed: {
        filterCity(){
            return this.getLocation.filter(item => item.parent_id  === 0)
        },

        filterDistrict(){
            return this.getLocation.filter(item => item.parent_id  === this.select.city)
        },

        filterWard(){
            return this.getLocation.filter(item => item.parent_id  === this.select.district)
        },

        filterStreet(){
            return this.getLocation.filter(item => item.parent_id  === this.select.ward)
        }
    },
    watch: {
        newPost(value){
            console.log('1')
            console.log(value)
        },

        locations(value){
            this.uploadLocation(value)
        },

        fullAddress(value){
            console.log(value)
            const text = value.split(',')
            if(text.length > 4){
                this.select.numberHome = text[0]
            }
        }
    },
    methods: {

        uploadLocation(value){
            this.arrayLocation_Id = value,
            this.full_address = this.fullAddress,

            this.select.city = value[0]?value[0].id:null
            this.select.district = value[1]?value[1].id: null
            this.select.ward = value[2]?value[2].id: null
            this.select.street = value[3]?value[3].id: null
        },

        deleteSelect(value){
            value.forEach(element => {
                this.select[element] = ref(null)
            });
        },

        async get_Full_Address(value){

            const data = [this.select.city,this.select.district,this.select.ward,this.select.street]
            const result = await locationApi.getNameLocation(data)
            this.arrayLocation_Id = result

            this.full_address = []
            this.arrayLocation_Id.forEach((element,index) => {
                this.full_address.push(element.name)
            });

            if(value != 'id'){
                console.log(this.full_address)
                this.full_address.push(value)
            }

            this.textFullAddress = ""
            this.full_address.reverse().forEach((element,index) => {
                this.textFullAddress += element
                if(index < this.full_address.length -1){
                    this.textFullAddress += ", "
                }
            });

            this.createAddress(this.textFullAddress,this.arrayLocation_Id)
        },


        changeCity(cityId){
            this.select.city = cityId
            const array = ["district","ward","street","numberHome"]
            this.deleteSelect(array)
            this.get_Full_Address("id")
        },

        changeDistrict(districtId){
            this.select.district = districtId

            const array = ["ward","street","numberHome"]
            this.deleteSelect(array)

            this.get_Full_Address("id")

        },

        changeCityWard(wardId){
            this.select.ward = wardId

            const array = ["street","numberHome"]
            this.deleteSelect(array)
            this.get_Full_Address("id")
        },

        changeCityStreet(streetId){
            this.select.street = streetId

            const array = ["numberHome"]
            this.deleteSelect(array)
            this.get_Full_Address("id")
        },

        getNumber_houer(textAddress){
            this.select.numberHome = textAddress
            this.get_Full_Address(textAddress)

        },
    },
    async created(){
        this.getLocation = await locationApi.getLocation()
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

