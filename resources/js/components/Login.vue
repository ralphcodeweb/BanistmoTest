<template>
    <div class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html">
                    <b>Test</b>Banistmo
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Inicie la Sesion</p>

                    <form @submit.prevent="hadleLogin">
                        <div class="input-group mb-3">
                            <input type="email" v-model="form.email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" v-model="form.password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <br>
                         <button type="submit" class="btn btn-primary btn-block" v-loading.fullscreen.lock="fullscreenLoading">Entrar</button>
                    </form>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <span v-if="messagesfail">
                                <div v-for="(e, index) in mensajesError" v-text="e" :key="index" class="callout callout-danger"></div>
                            </span>
                        </div>
                    </div>
                </div><!-- /.login-card-body -->
            </div>
        </div>
    </div><!-- /.login-box -->
</template>

<script>

    export default {
        data(){
            return {
                form: {
                    email: "",
                    password: ""
                },
                fullscreenLoading: false,
                messagesfail: true,
                mensajesError: []
            }
        },
        methods: {
            validateLogin() {

                this.mensajesError = [];

                if(!this.form.email){
                    this.mensajesError.push('El campo correo es obligatorio');
                }

                if(!this.form.password){
                    this.mensajesError.push('El campo password es obligatorio');
                }

                if(this.mensajesError.length > 0){
                    this.messagesfail
                }
                else{
                    this.messagesfail = false;
                }

                return this.messagesfail;
            },

            hadleLogin() {

                if(this.validateLogin())
                {
                    return;
                }

                this.fullscreenLoading = true;

                axios.get('/sanctum/csrf-cookie').then(response => {

                    axios.post('api/v1/login', this.form).then(res => {

                        if(res.data.code === 401){
                            this.mensajesError.push(res.data.message);
                            this.messagesfail = true;
                            this.form.password = '';
                        }

                        if(res.data.code === 200){

                            //Redirecciono al Dashboard
                            this.$router.push({name: 'dashboard.index'});
                            location.reload();
                        }
                        this.fullscreenLoading = false;
                    });

                });
            }
        }
    }

</script>

<style>

</style>
