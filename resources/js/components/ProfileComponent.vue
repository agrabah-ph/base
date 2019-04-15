<template>
    <div class="m-3">
        <div v-if="!edit" class="row justify-content-center">

            <div class="col-sm">
                <img src="https://via.placeholder.com/150" class="rounded-circle d-block m-auto">
            </div>
            <div class="col-sm">
                <p>{{ user.name }}</p>
                <p>{{ user.roles[0].name }}</p>
                <p>{{ user.email }}</p>
                <p>{{ user.address }}</p>
                <button class="btn btn-primary" @click="edit = !edit">Edit Profile</button>
            </div>

        </div>
        <div v-if="edit" class="row justify-content-center">

            <div class="col-sm">
                <img src="https://via.placeholder.com/150" class="rounded-circle d-block m-auto">
                <form @submit.prevent="addProfilePicture" enctype="multipart/form-data">
                    <input type="file" name="profilePic" id="" @change="this.form.submit()">
                </form>
            </div>
            <div class="col-sm">
                <form @submit.prevent="editUser">
                    <div class="form-group">
                        <input type="text" :value="user.name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" :value="user.email" disabled class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" :value="user.address" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                    <button @click="edit = !edit" class="btn btn-warning">Cancel</button>
                </form>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "Profile",
    props: ["user"],
    data() {
        return {
            edit: false,
        }
    },
    created() {

    },
    methods: {
        addProfilePictre() {

        },
        editUser() {

        }
    }
}
</script>

<style scoped>

</style>
