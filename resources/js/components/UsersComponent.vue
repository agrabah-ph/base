<template>
    <div class="container">
        <div class="row" v-for="users in groupedUsers">
            <div class="col-md-3 col-sm-6" v-for="user in users">
                <user class="animated fadeIn" :user="user"></user>
            </div>
            <div class="col w-100"></div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import user from '../components/UserComponent'

    export default {
        name: "Users",
        components: {
            user
        },
        mounted() {
            this.$store.dispatch('GET_USERS')

            window.Echo.channel('search')
                .listen('.searchUserResults', (e) => {
                    this.$store.commit('SET_USERS', e.users)
                })
        },
        computed: {
            groupedUsers() {
                return _.chunk(this.users, 4);
            },
            ...mapGetters([
                'users'
            ])
        }
    }
</script>



