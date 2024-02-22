<script setup>
const loginP = LoginStore();
const bg_ver = VerificacionE(); 

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
                            <Button_g  class="btn_ligth"  type="submit">Registro</Button_g>
                        </NuxtLink>
                    </ul>
                </div>
            </div>
    </HeaderBase>
</template>

<style scoped>

</style>