<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="https://lh3.googleusercontent.com/kErt5b8W8IFpLUoDZq4vWK-7ngjMYdEhQqTon7G25huSsoWB_He5ySud0sOhWkdM6mc"
                alt="AdminLTE Logo" class="brand-image img-circle elevation-3" />
            <span class="brand-text font-weight-light">Banistmo</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block btn btn-danger btn-sm" @click.prevent="logout" v-loading.fullscreen.lock="fullscreenLoading">
                        <i class="fa fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </div>
            </div>

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="ruta + '/img/avatar.png'" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </router-link>
                    </li>

                    <li class="nav-header">MODULO CLIENTES</li>
                    <li class="nav-item">
                        <router-link to="/clientes" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>Listado Clientes</p>
                        </router-link>
                    </li>

                    <!-- <li class="nav-header">LABELS</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Important</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p>Warning</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Informational</p>
                        </a>
                    </li> -->
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

</template>

<script>
    export default {
        props: ['ruta'],
        data () {
            return {
                fullscreenLoading: false
            }
        },
        methods: {
            logout() {

                this.fullscreenLoading = true;

                axios.post('api/v1/logout').then(res => {

                    this.fullscreenLoading = false;
                    location.reload();
                });
            }
        }
    }

</script>

<style>

</style>
