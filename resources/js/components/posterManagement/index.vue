<template>
    <div class="appChildren">
        <div class="container-fluid px-0 bg-white h-100">
            <Navbar/>
            <div class="homeManager d-flex">
                <sidebar/>
                <router-view></router-view>
            </div>
        </div>
    </div>
    <FooterComponentVue/>
</template>

<script>
import { ref, defineComponent } from 'vue'
import Sidebar from './Sidebar.vue'
import Navbar from './NavbarManagerUser.vue'
import FooterComponentVue from '../FooterComponent.vue'

export default defineComponent({
    components:{
        Sidebar,
        Navbar,
        FooterComponentVue
    },
    data(){

    }
})
</script>
