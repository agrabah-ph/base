import state from "./state";

let getters = {
    users: state => {
        return state.users
    },
    orders: state => {
        return state.orders
    },
    ownpo: state => {
        return state.ownpo
    }
}

export default getters
