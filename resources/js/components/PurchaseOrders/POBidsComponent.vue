<template>
    <div class="card">
        <table class="table table-responsive-md table-striped">
            <tr>
                <th>Bidder</th>
                <th>Offer</th>
                <th>Delivery Date</th>
                <th></th>
            </tr>
            <tr v-for="bid in bids" :key="bid.index">
                <td><a href="#">{{ bid.bidder }}</a></td>
                <td>Php {{ bid.offer }}</td>
                <th>{{ bid.delivery_date_time | moment("dddd, MMMM DD, YYYY  h:mm A")}}</th>
                <th>
                    <button class="btn btn-success">Approve</button>
                </th>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    props: ['bids']
}
</script>

<style>

</style>
