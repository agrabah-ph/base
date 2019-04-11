import Axios from "axios";

let actions = {
    SEARCH_USERS({commit}, query) {
        let params = {
            query
        };
        Axios.get(`/api/user-search`, {params})
            .then(res => {
                commit('SET_USERS', res.data)
                res.data = 'ok'
                if(res.data === 'ok')
                    console.log('request sent successfully')
            }).catch(err => {

                console.log(err)

            })
    },
    GET_USERS({commit}) {
        Axios.get('/api/user-get')
            .then(res => {
                {
                    commit('SET_USERS', res.data)
                    console.log(res.data);
                }
            }).catch(err => {
                console.log(err)
            })
    }
}

export default actions
