<template>
    <div>
        <ul>
            <li v-for="order in orders" :key="order.index">
                <p>{{ order.user.name }}</p>
                <p v-for="client in order.user" :key="client.id">
                    <span>{{ client.name }}</span>
                </p>
                <p v-for="item in order.items" :key="item.index">
                    <span>{{ item.item }}</span>
                    <span>{{ item.quantity }}</span>
                    <span>{{ item.note }}</span>
                    <span>{{ item.id }}</span>
                </p>
            </li>
        </ul>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
    name: "Orders",
    created() {
        this.$store.dispatch('GET_ORDERS');
    },
    computed: {
        ...mapGetters([
            'orders'
        ]),
    }
}
</script>

<style>

</style>
