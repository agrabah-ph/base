<template>
    <div class="container">
        <h4>Purchase Orders</h4>
        <div class="row">
            <div class="form-group col-md-2">
                <label for="status">Status: </label>
                <select v-model="status" id="" class="form-control custom-select">
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
                <tr>
                    <th scope="row">1</th>
                    <td>8</td>
                    <td>April 30, 2019</td>
                    <td class="text-success">Active</td>
                    <td><a href="#">View</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "purchaseOrders",
    data() {
        return {
            status: 'all',
        }
    },
    created() {

        this.getOwnPO();

    },
    methods: {

        getOwnPO() {

            axios.get('/api/userPurchaseOrders')
            .then( response => {

                console.log(response);

            });

        }

    }
}
</script>
