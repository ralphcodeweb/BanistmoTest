<template>
    <div>
        <!-- NaBar -->
        <NavBar></NavBar>

        <!-- SideBar -->
        <SideBar :ruta="ruta"></SideBar>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <transition name="slide-fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>

        <!-- Footer -->
        <Footer></Footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
        <!-- Control sidebar content goes here -->
    </div>
</template>

<script>
import NavBar from './partials/NavBar'
import SideBar from './partials/SideBar'

import Footer from './partials/Footer'

export default {
    props: ['ruta'],
    components: { NavBar, SideBar, Footer }
}
</script>

<style>

</style>