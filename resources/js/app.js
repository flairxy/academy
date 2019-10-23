import Vue from 'vue'
import 'bootstrap'
import VueRouter from 'vue-router'
import App from './views/App'
import { routes } from './router';
import NProgress from "nprogress"
import "../../node_modules/nprogress/nprogress.css"
import { Form, HasError, AlertError } from "vform"
import swal from "sweetalert2"
import VueProgressBar from "vue-progressbar"
import vueCountryRegionSelect from "vue-country-region-select"
import BootstrapVue from "bootstrap-vue"
Vue.use(BootstrapVue)




// import css from './css'
// import store from './store/Store'

Vue.use(VueRouter)
Vue.use(NProgress)
Vue.use(vueCountryRegionSelect)


window.swal = swal;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
});

window.Form = Form;
window.Fire =  new Vue();

const router = new VueRouter({
    mode: 'history',
    routes
});


router.beforeResolve((to, from, next) => {
    if (to.name) {
        NProgress.start()
    }
    next()
});


router.afterEach((to, from) => {
    NProgress.done()

});

const app = new Vue({
    el: "#app",
    components: { App },
    router,
    // css,
    // store,
    Fire,
})

