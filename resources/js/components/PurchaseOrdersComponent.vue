<template>
    <div class="container">
        <h4>Purchase Orders</h4>
        <div class="row">
            <div class="form-group col-md-4 d-flex">
                <label for="status" class="d-block m-auto">Status: </label>&nbsp;
                <select v-model="status" id="" class="form-control custom-select" @change="getByStatus">
                    <option value="all">All</option>
                    <option value="Active">Active</option>
                    <option value="Expired">Expired</option>
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
                    <td><a href="#">View</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: "purchaseOrders",
    data() {
        return {
            status: 'all',
            currentDate: new Date()
        }
    },
    mounted() {

        this.$store.dispatch('GET_OWN_PO')

    },
    methods: {

        biddingStatus(dbBidEndDate) {

            var today = new Date();
            var endDate = new Date(dbBidEndDate * 1000);

            console.log(today, endDate, dbBidEndDate);

            if(today < endDate) {

                return true;

            } else {

                return false;

            }
        }

    },
    computed: {
        ...mapGetters([
            'ownpo'
        ]),
    }
}
</script>
