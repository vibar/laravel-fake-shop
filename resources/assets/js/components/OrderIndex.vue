<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">My Orders</div>
                    <div v-if="orders.length" class="card-body">
                        <p v-for="order in orders">
                            <b>#{{ order.id }}</b>
                            - {{ order.currency.symbol }} {{ order.total }}
                            - {{ order.created_at }}
                        </p>
                    </div>
                    <div v-else class="card-body">
                        No order created.
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
                orders: [],
            }

        },

        mounted() {
            let vm = this
            vm.getOrders()
        },

        methods: {

            getOrders() {
                let vm = this
                axios.get('/api/orders')
                    .then(function(response) {
                        vm.orders = response.data.data
                    })
            },

        },

    }
</script>
