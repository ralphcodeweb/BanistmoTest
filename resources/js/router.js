import Vue from 'vue';
import Router from 'vue-router';

//import Login from './components/Login.vue';

Vue.use(Router);


let Dasboard = require('./components/modulos/dashboard/index').default,
    Clientes = require('./components/modulos/clientes/index').default;


export default new Router({
    routes: [
        {
            path: '/',
            name: 'dashboard.index',
            component: Dasboard
        },
        {
            path: '/clientes',
            component: Clientes
        }
    ],
    // No mostrar # en la ruta
    mode: 'history',
    //Solución para el link Activo
    linkExactActiveClass: 'active'
});