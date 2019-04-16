<template>
    <div>
        <!-- If user is a vendor -->
        <div class="row p-3">
            <div class="col-lg">
                <div class="table-responsive-md">
                    <h1>Bidder</h1>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Order #</th>
                                <th scope="col">Items</th>
                                <th scope="col" class="d-none d-sm-table-cell">Quantity</th>
                                <th scope="col" class="d-none d-sm-table-cell">Client</th>
                                <th scope="col" class="d-none d-sm-table-cell">Price</th>
                                <th scope="col" class="d-none d-sm-table-cell">Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Tomatoes</td>
                                <td class="d-none d-sm-table-cell">50Kg</td>
                                <td scope="col" class="d-none d-sm-table-cell">Naga Resto</td>
                                <td scope="col" class="d-none d-sm-table-cell">Php. 3000</td>
                                <td class="d-none d-sm-table-cell">April 15, 2019</td>
                                <td class="text-danger">Pending</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Carrots</td>
                                <td class="d-none d-sm-table-cell">20kg</td>
                                <td scope="col" class="d-none d-sm-table-cell">Manila resto</td>
                                <td scope="col" class="d-none d-sm-table-cell">Php. 4000</td>
                                <td class="d-none d-sm-table-cell">April 9, 2019</td>
                                <td class="text-success">Approved</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Onion, Garlic</td>
                                <td class="d-none d-sm-table-cell">15kg</td>
                                <td scope="col" class="d-none d-sm-table-cell">Trial Resto</td>
                                <td scope="col" class="d-none d-sm-table-cell">Php. 800</td>
                                <td class="d-none d-sm-table-cell">April 5, 2019</td>
                                <td class="text-success">Approved</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- elif client -->
        <div class="row p-3">
            <div class="col-lg">
                <div class="table-responsive-md">
                    <h1>Client</h1>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Order #</th>
                                <th scope="col">Items</th>
                                <th scope="col" class="d-none d-sm-table-cell">Quantity</th>
                                <th scope="col" class="d-none d-sm-table-cell">Bidder</th>
                                <th scope="col" class="d-none d-sm-table-cell">Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Tomatoes</td>
                                <td class="d-none d-sm-table-cell">50Kg</td>
                                <td class="d-none-d-sm-table-cell">John Doe</td>
                                <td class="d-none d-sm-table-cell">April 15, 2019</td>
                                <td class="text-danger">Shipping</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Carrots</td>
                                <td class="d-none d-sm-table-cell">20kg</td>
                                <td class="d-none-d-sm-table-cell">Juan Dela Cruz</td>
                                <td class="d-none d-sm-table-cell">April 9, 2019</td>
                                <td class="text-success">Delivered</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Onion, Garlic</td>
                                <td class="d-none d-sm-table-cell">15kg</td>
                                <td class="d-none-d-sm-table-cell">User</td>
                                <td class="d-none d-sm-table-cell">April 5, 2019</td>
                                <td class="text-success">Delivered</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
