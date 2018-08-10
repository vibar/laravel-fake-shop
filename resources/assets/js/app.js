
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

    // TODO: Vuex

    router,

    el: '#app',

    data() {
        return {
            currencyCode: user.currencyCode,
            currencySymbol: user.currencySymbol,
            cartItems: user.cartItems,
        }
    },

    mounted() {
        let vm = this

        vm.$on('cartItems.update', (products) => {
            vm.setCartItems(products)
        })

    },

    methods: {

        setCurrency(currency) {
            let vm = this

            axios.patch('/api/currencies/' + currency).then(function(response) {
                vm.currencyCode = response.data.data.code
                vm.currencySymbol = response.data.data.symbol
                vm.$emit('currency.update')
            }).catch((error) => {
                //
            })
        },

        setCartItems(products) {
            let vm = this
            vm.cartItems = products.length
        },

    },

});
