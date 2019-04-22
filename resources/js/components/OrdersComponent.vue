<template>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md">
                <ul class="pagination">
                    <li :class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <a class="page-link" href="#" @click="fetchOrders(pagination.prev_page_url)">Previous</a>
                    </li>
                    <li class="page-item disabled">
                        <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                    </li>
                    <li :class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <a class="page-link" href="#" @click="fetchOrders(pagination.next_page_url)">Next</a>
                    </li>
                </ul>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Client</th>
                    <th scope="col">Notes / Description</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.index">
                    <th scope="row">{{ order.user.name }}</th>
                    <td style="max-width: 225px">
                        {{ order.note }}
                    </td>
                    <td>
                        <a :href="'order/'+ order.id" class="btn btn-primary d-block m-auto">View</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
// import {mapGetters} from 'vuex';
export default {
    props: ['user'],
    name: "Orders",
    data() {
        return {
            orders: [],
            pagination: {},
        }
    },
    created() {

        console.log(this.user);

        this.fetchOrders();

        Echo.private('orders')
        .listen('.OrderPlaced', function (e) {

            console.log(e);

        })

    },
    methods: {
        fetchOrders(page_url) {

            let vm = this;

            page_url = page_url || 'api/orders';

            axios.get(page_url)
            .then( response => {

                this.orders = response.data.data;
                vm.makePagination(response.data.meta, response.data.links);

            })
        },

        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }
            this.pagination = pagination;
        }
    },
    computed: {
        // ...mapGetters([
        //     'orders'
        // ]),
    }
}
</script>

<style>

</style>
