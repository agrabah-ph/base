<template>
    <div class="container">
        <h4>Purchase Orders</h4>
        <div class="row">
            <div class="form-group col-md-4 d-flex">
                <label for="status" class="d-block m-auto">Status: </label>&nbsp;
                <select v-model="status" id="" class="form-control custom-select">
                    <option value="all">All</option>
                    <option value="active">Active</option>
                    <option value="expired">Expired</option>
                </select>
            </div>
        </div>
        <table class="table table-striped border table-responsive-md">
            <thead>
                <tr>
                    <th scope="col">Order #</th>
                    <th scope="col">Bidders</th>
                    <th scope="col">Bid end date</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="po in filterByStatus" :key="po.index">
                    <th scope="row">{{ po.id }}</th>
                    <td>{{ po.bids.length }}</td>
                    <td>{{ po.bid_end_date | moment("MMMM DD, YYYY  h:mm A") }}</td>
                    <td :class="po.status == 'Active' ? 'text-success' : po.status == 'Expired' ? 'text-danger' : 'text-warning'">
                        {{ po.status }}
                    </td>
                    <td>
                        <a href="#"
                            data-toggle="modal"
                            data-target="#viewOrder"
                            @click="getPurchaseOrder(po.id)">
                            View
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="modal fade" id="viewOrder" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content" v-for="order in viewPurchaseOrder" :key="order.id">
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title" id="ModalLongTitle">{{ order.user.name }}</h5>
                            <small>Posted on: {{ order.created_at | moment("MMMM DD, YYYY H:mmA") }}</small>
                            <br>
                            <small>{{ order.created_at | moment("from") }}</small>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p>{{ order.description }}</p>
                        <ul>
                            <li v-for="item in order.items" :key="item.index">
                                {{ item.item }} {{ item.quantity }}kg
                            </li>
                        </ul>
                    </div>
                    <div class="modal-body">
                        <h5>Bids</h5>
                        <table class="table table-striped border table-responsive-md" v-if="order.bids.length">
                            <thead>
                                <tr>
                                    <th scope="col">Bid #</th>
                                    <th scope="col">Bidder</th>
                                    <th scope="col">Bid Placed</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Delivery Date</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="bid in order.bids" :key="bid.id">
                                    <th scope="row">{{ bid.id }}</th>
                                    <td>
                                        <a href="#">{{ bid.user.name }}</a>
                                    </td>
                                    <td>{{ bid.created_at | moment("from") }}</td>
                                    <td>{{ bid.offer }}</td>
                                    <td>{{ bid.message }}</td>
                                    <td>{{ bid.delivery_date_time | moment("MMMM DD, YYYY H:mmA") }}</td>
                                    <td>
                                        <button class="btn btn-success">Approve</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p v-else class="text-center">
                            <strong>No bids yet</strong>
                        </p>
                    </div>
                    <div class="row justify-content-between p-3">
                        <div class="col-md">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: "purchaseOrders",
    data() {
        return {
            status: 'all',
            viewPurchaseOrder: [],
        }
    },
    mounted() {

        this.$store.dispatch('GET_OWN_PO')
    },
    methods: {
        getPurchaseOrder(orderId) {

            this.viewPurchaseOrder = [];

            axios.get('/api/order/' + orderId)
            .then( response => {

                this.viewPurchaseOrder = response.data;

            })
            .catch( error => {

                console.log(error)

            })
        },

    },
    computed: {

        filterByStatus() {

            let status = this.status;

            return this.ownpo.filter( po => {

                if(status == 'all') {

                    return true;

                } else if(status == 'expired') {

                    return po.ended == true;

                } else if (status == 'active') {

                    return po.ended == false;

                } else {
                    return null;
                }

            })
        },

        ...mapGetters([
            'ownpo'
        ]),
    }
}
</script>
