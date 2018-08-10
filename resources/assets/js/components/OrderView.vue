<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Order #{{ order.id }}
                    </div>
                    <div class="card-body">
                        <p>Created at: {{ order.created_at }}</p>
                        <p>Currency: {{ order.currency ? order.currency.symbol : '' }}</p>
                        <p><b>Total: {{ order.total }}</b></p>
                        <router-link tag="a" :to="{name:'order.index'}">See all orders</router-link>
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
                order: {}
            }
        },

        mounted() {
            let vm = this
            vm.getOrder(vm.id)
        },

        computed: {
            id() {
                return this.$route.params.id
            }
        },

        methods: {

            getOrder(id) {
                let vm = this
                axios.get('/api/orders/' + id)
                    .then(function(response) {
                        vm.order = response.data.data
                    })
            },

        },

    }
</script>
