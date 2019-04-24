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

        <table class="table border">

            <thead>
                <tr>
                    <th scope="col">Client</th>
                    <th scope="col">Description</th>
                    <th scope="col">Bids</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.index">
                    <th scope="row">{{ order.user.name }}</th>
                    <td style="max-width: 175px">
                        {{ cropText(order.description) }}
                    </td>
                    <td>{{ order.bids.length }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewOrder" @click="getOrder(order.id)">
                            View
                        </button>
                    </td>
                </tr>
            </tbody>

        </table>

        <div class="modal fade" id="viewOrder" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content" v-for="order in viewOrder" :key="order.id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLongTitle">{{ order.user.name }}</h5>

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown button
                            </button>
                            <button type="button" id="dropdownMenu" v-if="order.user.id == user.id" class="close">
                                <i class="fas fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p>{{ order.description }}</p>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-around" v-for="item in order.items" :key="item.id">
                                <span>{{ item.item }}</span>
                                <span>{{ item.quantity }}&nbsp;Kg</span>
                            </li>
                        </ul>
                    </div>
                    <div class="row justify-content-between p-3">
                        <div class="col-md">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md">
                            <button type="button" class="btn btn-success float-right">Bid</button>
                            <button type="button" class="btn btn-success float-right">Close Bidding</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

export default {
    props: ['user'],
    name: "Orders",
    data() {
        return {
            orders: [],
            pagination: {},
            viewOrder: []
        }
    },
    created() {

        this.fetchOrders();

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
        },

        cropText(text) {

            if(text.length >= 65) {

                return text.slice(0, 65) + "...";

            } else {

                return text

            }

        },

        getOrder(orderId) {

            this.viewOrder = [];

            axios.get('/api/order/' + orderId)
            .then( response => {

                this.viewOrder = response.data;

            })
            .catch( error => {

                console.log(error)

            })

        }
    },
}
</script>
