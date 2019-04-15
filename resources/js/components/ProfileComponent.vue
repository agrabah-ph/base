<template>
    <div class="m-3">
        <div class="row justify-content-center">

            <div class="col-sm">
                <img src="https://via.placeholder.com/150" class="rounded-circle d-block m-auto">
            </div>
            <div class="col-sm">
                <p>{{ user.name }}</p>
                <p>Vendor</p>
                <p>{{ user.email }}</p>
                <p>{{ user.address }}</p>
                <button class="btn btn-primary">Edit Profile</button>
            </div>

        </div>

        <!-- If user is a vendor -->
        <div class="row p-3">
            <div class="col-lg">
                <div class="table-responsive-md">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Bid #</th>
                                <th scope="col">Items</th>
                                <th scope="col" class="d-none d-sm-table-cell">Quantity</th>
                                <th scope="col" class="d-none d-sm-table-cell">Client</th>
                                <th scope="col" class="d-none d-sm-table-cell">Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Tomatoes</td>
                                <td class="d-none d-sm-table-cell">50Kg</td>
                                <th scope="col" class="d-none d-sm-table-cell">Naga Resto</th>
                                <td class="d-none d-sm-table-cell">April 15, 2019</td>
                                <td class="text-danger">Pending</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Carrots</td>
                                <td class="d-none d-sm-table-cell">20kg</td>
                                <th scope="col" class="d-none d-sm-table-cell">Manila resto</th>
                                <td class="d-none d-sm-table-cell">April 9, 2019</td>
                                <td class="text-success">Approved</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Onion, Garlic</td>
                                <td class="d-none d-sm-table-cell">15kg</td>
                                <th scope="col" class="d-none d-sm-table-cell">Trial Resto</th>
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
                                <td class="text-danger">Pending</td>
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
    name: "Profile",
    props: ["user"],
    data() {
        return {

        }
    },
    created() {
        console.log(this.user);
    }
}
</script>

<style scoped>

</style>
