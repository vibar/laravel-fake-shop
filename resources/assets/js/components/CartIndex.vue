<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        My cart
                        <span v-if="products.length == 1"> - {{ products.length }} item</span>
                        <span v-else-if="products.length > 1"> - {{ products.length }} items</span>
                    </div>

                    <div v-if="products.length" class="card-body cart-summary">

                        <h4 class="total">Total: {{ $root.currencySymbol }} {{ total }}</h4>

                        <button @click="checkout()" class="btn btn-primary btn-checkout">Checkout</button>

                        <router-link tag="a" class="btn btn-default btn-keep-buying"
                                     :to="{name:'product.index'}">
                            Keep buying
                        </router-link>

                    </div>

                    <div v-else="" class="card-body">
                        Empty cart.
                    </div>

                </div>

                <div v-if="products.length" class="card cart-products">

                    <div class="card-body">

                        <div v-for="product in products" class="row product-row">

                            <div class="col-md-4">
                                <img :src="product.picture" :alt="product.name">
                            </div>

                            <div class="col-md-8">

                                <p><b>{{ product.name }}</b></p>

                                <p>{{ $root.currencySymbol }} {{ product.price }}</p>

                                <p>{{ product.description }}</p>

                                <button @click="removeProduct(product)" class="btn btn-danger">Remove</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</template>

<script>
    export default {

        data() {

            return {
                products: [],
                total: '',
            }

        },

        mounted() {
            let vm = this
            vm.getCart()

            vm.$root.$on('currency.update', () => {
                vm.getCart()
            })
        },

        methods: {

            getCart() {
                let vm = this
                axios.get('/api/carts')
                    .then(function(response) {
                        vm.products = response.data.data.products
                        vm.total = response.data.data.total
                    })
            },

            removeProduct(product) {
                let vm = this

                axios.delete('/api/carts/' + product.id).then(function(response) {
                    vm.$root.$emit('cartItems.update', response.data.data.products)
                    vm.getCart()
                }).catch((error) => {
                    //
                })

            },

            checkout() {
                let vm = this

                axios.post('/api/orders').then(function(response) {
                    let order = response.data.data
                    vm.$root.$emit('cartItems.update', [])
                    vm.$router.push({ name: 'order.view', params: {id: order.id}})
                }).catch((error) => {
                    //
                })

            },

        },

    }
</script>

<style scoped>

    .product-row {
        margin-bottom: 20px;
    }
    .card-body .product-row:last-child {
        margin-bottom: 0;
    }
    .cart-summary .total {
        float: left;margin-top: 4px;
    }
    .cart-summary .btn-checkout {
        float: right;
        margin-left: 15px;
    }
    .cart-summary .btn-keep-buying {
        float: right;
    }
    .cart-products {
        margin-top: 20px;
    }
</style>
