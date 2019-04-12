<template>
    <div class="container">
        <div class="select_wrapper">
            <label for="role">Role</label>
            <select v-model="role" class="form-control" name="role">
                <option value="all">All</option>
                <option value="client">Client</option>
                <option value="vendor">Vendor</option>
                <option value="owner">Owner</option>
            </select>
        </div>

        <div class="select_wrapper">
            <label for="verified">Status</label>
            <select v-model="status" class="form-control" name="verified">
                <option value="all">All</option>
                <option value="verified">Verified</option>
                <option value="unverified">Unverified</option>
            </select>
        </div>

        <span class="result_message" v-if="!filteredUsers.length">No matching record found.</span>
        <span class="result_message" v-if="filteredUsers.length">Found {{filteredUsers.length}} record{{filteredUsers.length>1? 's' : ''}}.</span>

        <table class="table table-borderless table-responsive" v-if="filteredUsers.length">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col" class="d-none d-sm-table-cell">Email</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in filteredUsers">
                    <td>{{user.name}}</td>
                    <td class="d-none d-sm-table-cell">{{user.email}}</td>
                    <td class="user_action_td">
                        <a href="#0" class="user_action" data-toggle="modal" :data-target="'#'+trimname(user.name)"><i class="far fa-eye"></i></a>
                        <a href="#0" class="user_action"><i class="fas fa-cog"></i></a>
                    </td>
                    <div class="modal fade" :id="trimname(user.name)" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ user.name.trim() }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Address: </h5>
                                    <p>{{ user.address }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import user from '../components/UserComponent'

    export default {
        name: "Users",
        data() {
            return {
                role: 'all',
                status: 'all',
                display: false,
                userDetails: []
            }
        },
        mounted() {
            this.$store.dispatch('GET_USERS')
        },
        computed: {

            filteredUsersByRole() {
                let role = this.role;
                return this.users.filter(function(user){
                    if(role == "all"){
                        return true;
                    } else {
                        return user.role.includes(role);
                    }
                })
            },
            filteredUsers() {
                let status = this.status;
                return this.filteredUsersByRole.filter(function(user) {
                    if(status == "all") {
                        return true;
                    }
                    if(status == "verified") {
                        return user.email_verified_at != null;
                    } else {
                        return user.email_verified_at == null;
                    }
                })
            },
            ...mapGetters([
                'users'
            ]),
        },
        methods: {
            trimname(string) {
                return string.replace(/\s/g,'');
            }
        },
    }
</script>

<style scoped>
    .user_action {
        margin: 0 0.1em;
        font-size: 1.3em;
    }

    .user_action_td {
        padding-right: 0;
    }

    .result_message {
        display: block;
        font-style: italic;
    }

    .select_wrapper {
        width: auto;
        display: inline-block;
        margin: 0 1em 1em 0;
    }

    @media (min-width:42em) {
        select {
            width: auto;
            display: inline-block;
        }
    }
</style>


