import state from "./state";

let getters = {
    users: state => {
        return state.users
    },
    orders: state => {
        return state.orders
    },
    ownpo: state => {

        var purchaseOrder = state.ownpo.map(po => {
            return {
                orderId: po.id,
                description: po.description,
                bidEnd: po.bid_end_date,
                items: {
                    item: po.items[0].item,
                    quantity: po.items[0].quantity + " Kg",
                    category: po.items[0].category,
                    classification: po.items[0].classification,
                },
                client: po.user.name,
            }
        })

        return state.ownpo
    }
}

export default getters
