let mutations = {
    SET_USERS(state, users) {
        state.users = users
    },
    SET_ORDERS(state, orders) {
        state.orders = orders
    },
    SET_OWN_PO(state, ownpo) {
        state.ownpo = ownpo
    }
}

export default mutations
