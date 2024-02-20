<script setup>
const rol = LoginStore();

</script>
<template>
    <div>
        <div v-if="rol.user.role == undefined && rol.session == false">
            <NoSessionHeader></NoSessionHeader>
        </div>
        <div v-else>
            <div v-if="rol.user.role == 'Civil'">
                <UserHeader></UserHeader>
            </div>
            <div v-else-if="rol.user.role == 'Admin'">
                <AdminHeader></AdminHeader>
            </div>
            <div v-else-if="rol.user.role == 'SuperAdmin'">
                <SuperAdminHeader></SuperAdminHeader>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>