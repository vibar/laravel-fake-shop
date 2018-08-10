<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                        <div v-for="product in products" class="row product-row">

                            <div class="col-md-4">
                                <img :src="product.picture" :alt="product.name">
                            </div>

                            <div class="col-md-8">

                                <p><b>{{ product.name }}</b></p>

                                <p>{{ $root.currencySymbol }} {{ product.price }}</p>

                                <p>{{ product.description }}</p>

                                <button @click="addProduct(product)" class="btn btn-primary">Add to cart</button>

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
            }

        },

        mounted() {
            let vm = this
            vm.getProducts()

            vm.$root.$on('currency.update', () => {
                vm.getProducts()
            })

        },

        methods: {

            getProducts() {
                let vm = this
                axios.get('/api/products')
                    .then(function(response) {
                        vm.products = response.data.data
                    })
            },

            addProduct(product) {
                let vm = this

                axios.post('/api/carts/' + product.id).then(function(response) {
                    vm.$root.$emit('cartItems.update', response.data.data.products)
                    vm.$router.push({ name: 'cart.index'})
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

</style>