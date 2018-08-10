<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        New order #{{ order.id }} created successfully!
                    </div>
                    <div class="card-body">
                        <p>Created at: {{ order.created_at }}</p>
                        <p>Total: {{ order.currency ? order.currency.symbol : '' }} {{ order.total }}</p>
                        <p>An email was sent to: {{ order.user ? order.user.email : '' }}.</p>
                        <router-link tag="a" :to="{name:'order.index'}">See my orders</router-link>
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
