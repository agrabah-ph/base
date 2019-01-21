<template>
    <div class="container">
        <div class="input-group mb-3">
            <input v-model="query" type="text" class="form-control" placeholder="Name of user"
                aria-label="Name of user"
                aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" @click="searchUsers" @keyup.enter="searchUsers" type="button">
                    Search
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Searchbar",
    data() {
        return {
            query: '',
        }
    },
    watch: {
        query: {
            handler: _.debounce(function() {
                this.searchUsers()
            }, 100)
        }
    },
    methods: {
        searchUsers() {
            this.$store.dispatch('SEARCH_USERS', this.query)
        }
    }
}
</script>

