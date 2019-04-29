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
                    <td :class="!po.ended ? 'text-success' :  'text-danger'">
                        <span v-if="!po.ended">
                            Active
                        </span>
                        <span v-else>
                            Expired
                        </span>
                    </td>
                    <td>
                        <button
                            class="btn btn-link"
                            type="button"
                            data-toggle="modal"
                            data-target="#viewOrder">
                            View
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
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
        cropText(text) {

            if(text.length >= 65) {

                return text.slice(0, 65) + "...";

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
.modal {
    position: fixed;
    top: 3%;
    right: 3%;
    left: 3%;
    width: auto;
    margin: 0;
}
.modal-body {
    height: 60%;
}
</style>
