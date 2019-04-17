<template>
    <div>
        <ul>
            <li v-for="order in orders" :key="order.index">
                <p>{{ order.user.name }}</p>
                <p v-for="item in order.items" :key="item.index">
                    <span>{{ item.item }}</span>
                    <span>{{ item.quantity }}</span>
                    <span>{{ item.id }}</span>
                </p>
                <p>{{ order.note }}</p>
            </li>
        </ul>
    </div>
</template>

<script>
// import {mapGetters} from 'vuex';
export default {
    name: "Orders",
    data() {
        return {
            orders: [],
            pagination: {},
        }
    },
    created() {
        this.fetchOrders();
    },
    methods: {
        fetchOrders() {

            let vm = this;

            axios.get('/api/orders')
            .then( response => {

                console.log(response);
                console.log(response.data.data);
                console.log(response.data.meta);

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
