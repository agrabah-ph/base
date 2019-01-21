import state from "./state";

let getters = {
    users: state => {
        return state.users
    }
}

export default getters