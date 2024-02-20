<script setup>
const loginP = LoginStore();

</script>

<template>
    <HeaderBase component-name="HeaderNoSession">
            <div>
                <div class="d-flex justify-content-end">
                    <ul class="navbar-nav d-inline-block">
                        <Login />
                    </ul>
                    <ul v-if="!loginP.session" class="navbar-nav d-inline-block ms-3">
                        <NuxtLink to="/Register">
                            <Button_g class="btn-outline-dark" type="submit">Registro</Button_g>
                        </NuxtLink>
                    </ul>
                </div>
            </div>
    </HeaderBase>
</template>

<style scoped>

</style>