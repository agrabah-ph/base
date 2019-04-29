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

        <div v-for="po in filterByStatus" :key="po.id" class="row mb-3 p-2 rounded bg-white border">
            <div class="col-md">
                <div class="row">
                    <div class="col-md">
                        <p>
                            {{ cropText(po.description) }}
                        </p>
                        <ul class="custom-ul">
                            <li v-for="item in po.items" :key="item.id">{{ item.item }} {{ item.quantity + "Kg" }}</li>
                        </ul>
                    </div>
                    <div class="col-md">

                        <div class="text-right order-details">
                            <p>Purchase Order #: {{ po.id }} </p>
                            <p>
                                Bid end date:
                                {{ po.bid_end_date | moment("dddd MMMM DD, YYYY  h:mm A")}}, &nbsp;
                                {{ po.bid_end_date | moment("from") }}
                            </p>
                            <p>
                                Status:
                                <span :class="!po.ended ? 'text-success' : 'text-danger'">
                                    <span v-if="!po.ended">Active</span>
                                    <span v-else>Expired</span>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md d-flex justify-content-between">
                        <p>
                            <small>
                                Posted on:
                                {{ po.created_at | moment("MMMM DD, YYYY  h:mm A") }},&nbsp;
                                {{ po.created_at | moment("from") }}
                            </small>
                        </p>
                        <button class="btn btn-primary">View</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Launch demo modal
        </button> -->

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
.custom-ul {
    margin: 5px;
    padding: 0;
}

.custom-ul li {
    margin: 0 5px;
}

@media only screen and (max-width: 767px) {
  .order-details {
    text-align: left!important;
  }
}
</style>
