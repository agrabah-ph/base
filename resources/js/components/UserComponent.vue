<template>
    <div class="card">
        <div class="card-body">
            <div class="card-title">{{user.name}}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "User",
    props: ['user']
}
</script>

<style scoped>
    .card {
        cursor: pointer;
        margin-bottom: 8px;
    }
</style>


