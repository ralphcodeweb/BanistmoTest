<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Clientes</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="content container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <b-button v-b-modal.registro-usuario class="btn btn-info btn-sm">
                            <i class="fa fa-plus-square"></i> Nuevo Cliente
                        </b-button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Listdo de Clientes</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover table-head-fixed text-nowrap projects">
                                    <thead>
                                        <tr>
                                            <td>Nombre Completo</td>
                                            <td>Ingreso</td>
                                            <td>Edad</td>
                                            <td>Ciudad</td>
                                            <td>Estado</td>
                                            <td>Acciones</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in listClientes.data" :key="index">
                                            <td v-text="item.nombrecompleto"></td>
                                            <td v-text="parseFloat(item.ingreso).toFixed(2)"></td>
                                            <td v-text="item.edad"></td>
                                            <td v-text="item.id_ciudades"></td>
                                            <td>
                                                <template v-if="item.estado == 'A'">
                                                    <span class="badge badge-success">Activo</span>
                                                </template>
                                                <template v-else>
                                                    <span class="badge badge-danger">Inactivo</span>
                                                </template>
                                            </td>
                                            <td>
                                                <b-button v-b-modal.ver-usuario class="btn btn-primary btn-sm"
                                                    @click.prevent="verServiciosCliente(item.id)">
                                                    <i class="fa fa-folder"></i> Ver
                                                </b-button>

                                                <b-button v-b-modal.actualizar-usuario class="btn btn-info btn-sm"
                                                    @click.prevent="idCliente(item.id)">
                                                    <i class="fa fa-pencil-alt"></i> Editar
                                                </b-button>

                                                <button class="btn btn-danger btn-sm"
                                                    @click.prevent="eliminarCliente(item.id)">
                                                    <i class="fa fa-trash"></i> Desactivar
                                                </button>

                                                <!-- <router-link class="btn btn-success btn-sm" to="/">
                                                    <i class="fa fa-check"></i> Activar
                                                </router-link> -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table><!-- /.table -->
                                <div class="card-footer clearfix">
                                    <pagination :data="listClientes" @pagination-change-page="getPageResult"
                                        class="pagination-sm m-0 float-right"></pagination>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div><!-- /.content-body -->
            </div>
        </div>
        <!-- Modal para Registrar Clientes -->
        <b-modal id="registro-usuario" class="modal-content" title="Registro de Cliente" size="lg" hide-footer>

            <span v-if="messagesfail">
                <div v-for="(e, index) in mensajesError" :key="index" class="callout callout-danger"
                    style="padding:5px;">
                    {{ e }}
                </div>
            </span>

            <form @submit.prevent="guardarCliente">
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input type="text" v-model="regcli.nombrecompleto" class="form-control"
                        placeholder="Nombre y Apellido">
                </div>
                <div class="form-group">
                    <label>Ingreso</label>
                    <input type="text" v-model="regcli.ingreso" class="form-control" placeholder="0000.00">
                </div>
                <div class="form-group">
                    <label>Edad</label>
                    <input type="text" v-model="regcli.edad" class="form-control" placeholder="Número de Edad">
                </div>
                <div class="form-group">
                    <label>Ciudades</label>
                    <b-form-select v-model="regcli.id_ciudades" :options="options" aria-placeholder="Ciudad">
                    </b-form-select>
                </div>
                <div class="form-group">
                    <label>Estado del Cliente</label>
                    <b-form-select v-model="regcli.estado" :options="estados" aria-placeholder="Ciudad"></b-form-select>
                </div>
                <hr>
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i> Guardar</button>
            </form>
        </b-modal><!-- /.modal -->

        <!-- Modal para Actualizar Clientes -->
        <b-modal id="actualizar-usuario" class="modal-content" title="Actualizar Cliente" size="lg" hide-footer>

            <span v-if="messagesfail">
                <div v-for="(e, index) in mensajesError" :key="index" class="callout callout-danger"
                    style="padding:5px;">
                    {{ e }}
                </div>
            </span>

            <form @submit.prevent="actualizarCliente">
                <input type="hidden" v-model="regcli.id">
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input type="text" v-model="regcli.nombrecompleto" class="form-control"
                        placeholder="Nombre y Apellido">
                </div>
                <div class="form-group">
                    <label>Ingreso</label>
                    <input type="text" v-model="regcli.ingreso" class="form-control" placeholder="0000.00">
                </div>
                <div class="form-group">
                    <label>Edad</label>
                    <input type="text" v-model="regcli.edad" class="form-control" placeholder="Número de Edad">
                </div>
                <div class="form-group">
                    <label>Ciudades</label>
                    <b-form-select v-model="regcli.id_ciudades" :options="options" aria-placeholder="Ciudad">
                    </b-form-select>
                </div>
                <div class="form-group">
                    <label>Estado del Cliente</label>
                    <b-form-select v-model="regcli.estado" :options="estados" aria-placeholder="Ciudad"></b-form-select>
                </div>
                <hr>
                <button type="submit" class="btn btn-info btn-block"><i class="fas fa-sync-alt"></i> Actualizar</button>
            </form>
        </b-modal><!-- /.modal -->

        <!-- Modal para Ver Servicio Clientes a ofrecer -->
        <b-modal id="ver-usuario" class="modal-content" title="Ver Servicios a Ofrecer" size="lg" hide-footer>

            <div class="card card-widget widget-user" v-if="servicio.length">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username">{{ servicio[0].cliente.nombre  }}</h3>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" :src="'/img/user1-128x128.jpg'" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ servicio[0].cliente.edad  }}</h5>
                                <span class="description-text">Edad</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ servicio[0].cliente.ingreso  }}</h5>
                                <span class="description-text">Ingreso</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">

                                <h5 class="description-header" v-if="servicio[0].cliente.id_ciudades == 1">Panamá</h5>
                                <h5 class="description-header" v-else>Otra Ciudad</h5>
                                <span class="description-text">Ciudad</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="m-0 text-dark">Servicios Disponibles</h4>
                    </div>

                    <div class="col-md-6" v-for="(item, index) in servicio[0].servicios" :key="index">

                        <div class="info-box">
                            <span class="info-box-icon bg-info">
                                <i class="fa fa-file-invoice-dollar" v-if="item.id == 1"></i>
                                <i class="fa fa-credit-card" v-if="item.id == 2"></i>
                                <i class="fa fa-street-view" v-if="item.id == 3"></i>
                                <i class="fa fa-signal" v-if="item.id == 4"></i>
                                <i class="fa fa-sync" v-if="item.id == 5"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text" v-text="item.descripcion"></span>
                            </div>
                        </div>
                    </div><!-- /.info-box -->

                </div>
            </div>
        </b-modal><!-- /.modal -->

    </div>

</template>

<script>
    export default {
        data() {
            return {
                listClientes: {},
                messagesfail: true,
                mensajesError: [],
                servicio: [],
                regcli: {
                    nombrecompleto: "",
                    ingreso: "",
                    id_ciudades: "",
                    edad: "",
                    estado: ""
                },
                selected: null,
                options: [{
                        value: '',
                        text: '-- Seleccione --'
                    },
                    {
                        value: 1,
                        text: 'Panama'
                    },
                    {
                        value: 2,
                        text: 'Otro Ciudad'
                    }
                ],
                estados: [{
                        value: '',
                        text: '-- Seleccione --'
                    },
                    {
                        value: 'A',
                        text: 'Activo'
                    },
                    {
                        value: 'I',
                        text: 'Inactivo'
                    }
                ]
            }
        },
        mounted() {
            this.getPageResult()
        },
        methods: {
            getPageResult(page = 1) {
                axios.get('/api/v1/clientes?page=' + page)
                    .then(response => {
                        this.listClientes = response.data;
                    });
            },
            validateClienteBlank() {

                this.mensajesError = [];

                if (!this.regcli.nombrecompleto) {
                    this.mensajesError.push('Requiere Nombre Completo');
                }

                if (!this.regcli.ingreso) {
                    this.mensajesError.push('Requiere Ingreso');
                }

                if (!this.regcli.edad) {
                    this.mensajesError.push('Requiere Edad');
                }

                if (this.mensajesError.length > 0) {
                    this.messagesfail
                } else {
                    this.messagesfail = false;
                }

                return this.messagesfail;
            },
            cleanRegistro() {
                this.regcli.nombrecompleto = "";
                this.regcli.ingreso = "";
                this.regcli.id_ciudades = "";
                this.regcli.edad = "";
                this.regcli.estado = "";
            },
            guardarCliente() {

                if (this.validateClienteBlank()) {
                    return;
                }

                axios.post('api/v1/clientes/registro', this.regcli).then(response => {

                    if (response.data.code == 400) {

                        this.messagesfail = true;
                        this.mensajesError = [];

                        let errors = response.data.error;

                        Object.entries(errors).forEach(([key, value]) => {
                            //console.log(`${key} ${value}`);
                            console.log(`${value}`);
                            this.mensajesError.push(value[0]);
                        });
                    }

                    if (response.data.code == 200) {
                        this.cleanRegistro();
                        this.$bvModal.hide('registro-usuario');
                        this.getPageResult();
                    }

                });
            },
            idCliente(id) {

                this.cleanRegistro();

                axios.get('/api/v1/clientes/' + id)
                    .then(response => {
                        this.regcli = response.data.cliente;
                    });
            },
            actualizarCliente() {

                if (this.validateClienteBlank()) {
                    return;
                }

                axios.put('api/v1/clientes/update', this.regcli).then(response => {

                    if (response.data.code == 400) {

                        this.messagesfail = true;
                        this.mensajesError = [];

                        let errors = response.data.error;

                        Object.entries(errors).forEach(([key, value]) => {

                            //console.log(`${key} ${value}`);
                            //console.log(`${value}`);
                            this.mensajesError.push(value[0]);
                        });
                    }

                    if (response.data.code == 200) {

                        this.cleanRegistro();
                        this.$bvModal.hide('actualizar-usuario');
                        this.getPageResult();
                    }

                });
            },
            eliminarCliente(id) {
                this.$swal({
                    title: 'Desea desactivar cliente ',
                    text: 'Cambiará el estado del cliente',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    if (result.value) {

                        axios.put('/api/v1/clientes/delete/' + id)
                            .then(response => {

                                if (response.data.code == 400) {
                                    this.$swal('Cancelar', 'Cliente no desactivado', 'warning')
                                }

                                if (response.data.code == 200) {

                                    this.$swal('Desactivado', 'Cliente Desactivado', 'success')
                                    this.getPageResult();
                                }


                            });
                    } else {
                        this.$swal('Cancelled', 'Acción cancelada', 'info')
                    }
                });
            },
            verServiciosCliente(id) {

                this.servicio = [];

                axios.get('/api/v1/clientes/servicios/' + id)
                    .then(response => {

                        console.log(response.data);

                        this.servicio.push(response.data);

                    });

            }
        }
    };

</script>

<style>

</style>
