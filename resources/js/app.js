require('./bootstrap');
import router from "./route";
import Vue from 'vue';
import  VueRouter from "vue-router";
import Master from './Master';

window.Form = Form;

window.Fire = new Vue();


import { Form, HasError, AlertError } from 'vform';
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

//sweet alert
import Swal from 'sweetalert2';
window.Swal = Swal;
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast  = Toast;

window.Vue = require('vue');
Vue.use(VueRouter);
const app = new Vue({
    el: '#app',
    router,
    components:{
        Master : Master
    }
})