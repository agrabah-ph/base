<template>
    <div class="container">
        <h4>Purchase Orders</h4>
        <div class="row">
            <div class="form-group col-md-4 d-flex">
                <label for="status" class="d-block m-auto">Status: </label>&nbsp;
                <select v-model="status" id="" class="form-control custom-select" @change="getPoStatus">
                    <option value="all">All</option>
                    <option value="active">Active</option>
                    <option value="expired">Expired</option>
                </select>
            </div>
        </div>
        <table class="table table-striped border">
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
                <tr v-for="po in ownpo" :key="po.id">
                    <th scope="row">{{ po.id }}</th>
                    <td>{{ po.bids.length }}</td>
                    <td>{{ po.bid_end_date }}</td>
                    <td :class="biddingStatus(po.end) ? 'text-success' : 'text-danger'">
                        <span v-if="biddingStatus(po.end)">
                            Active
                        </span>
                        <span v-else>
                            Expired
                        </span>
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
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content" v-for="order in viewPurchaseOrder" :key="order.id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLongTitle">{{ order.user.name }}</h5>
                    </div>
                    <div class="modal-body" >
                        <p>{{ order.description }}</p>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-around" v-for="item in order.items" :key="item.index">
                                <span>{{ item.item }}</span>
                                <span>{{ item.quantity }}kg</span>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-body" v-for="bid in order.bids" :key="bid.id">
                        <h5>Bids</h5>
                        <li class="list-group-item d-flex justify-content-around">
                            <span>{{ bid.user.name }}</span>
                        </li>
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
            viewPurchaseOrder: []
        }
    },
    mounted() {

        this.$store.dispatch('GET_OWN_PO')

    },
    methods: {

        biddingStatus(bidend) {

            var today = new Date();
            var endDate = new Date(bidend * 1000);

            if(today < endDate) {

                return true;

            } else {

                return false;

            }
        },

        getPoStatus() {

        },

        getPurchaseOrder(orderId) {

            this.viewOrder = [];

            axios.get('/api/order/' + orderId)
            .then( response => {

                this.viewPurchaseOrder = response.data;
                console.log(this.viewPurchaseOrder)

            })
            .catch( error => {

                console.log(error)

            })
        }

    },
    computed: {
        ...mapGetters([
            'ownpo'
        ]),
    }
}
</script>
