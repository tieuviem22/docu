import Vue from "vue";
import Router from "vue-router";
import Signin from "./components/Signin"
import Home from "./components/Home"

Vue.use(Router);
export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            // redirect: '/auth',
            component:Home
        }
    ]
})
