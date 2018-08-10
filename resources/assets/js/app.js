
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const ProductIndex = require('./components/ProductIndex.vue')
const CartIndex = require('./components/CartIndex.vue')
const OrderIndex = require('./components/OrderIndex.vue')
const OrderView = require('./components/OrderView.vue')

Vue.component('order-index', OrderIndex);

import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    { path: '/', name: 'product.index', component: ProductIndex },
    { path: '/cart', name: 'cart.index', component: CartIndex },
    { path: '/orders', name: 'order.index', component: OrderIndex },
    { path: '/orders/:id', name: 'order.view', component: OrderView },
]

const router = new VueRouter({
    linkActiveClass: 'active',
    // linkExactActiveClass: '',
    mode: 'history',
    routes // short for `routes: routes`
})

const app = new Vue({
    router,
    el: '#app',
    data() {
        return {
            currency: user.currency,
            cartItems: user.cartItems,
        }
    }
});
