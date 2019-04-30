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

        <table class="table table-responsive-md table-striped">
            <thead>
                <tr>
                    <th scope="col">PO #</th>
                    <th scope="col">Bidders</th>
                    <th scope="col">Status</th>
                    <th scope="col">Bid End Date</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="po in filterByStatus" :key="po.id">
                    <th scope="row">{{ po.id }}</th>
                    <td>{{ po.bids.length }}</td>
                    <td :class="!po.ended ? 'text-success' : 'text-danger'">
                        <strong v-if="!po.ended">Active</strong>
                        <strong v-else>Expired</strong>
                    </td>
                    <td>{{ po.bid_end_date | moment("dddd MMMM DD, YYYY  h:mm A")}}</td>
                    <td>
                        <a :href="'/purchaseorder/'+po.id">View</a>
                    </td>
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
        cropText(text) {

            if(text.length >= 65) {

                return text.slice(0, 95) + "...";

            } else {

                return text

            }

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
    },
}
</script>

<style scoped>
</style>
