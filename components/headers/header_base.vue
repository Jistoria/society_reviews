<script setup>
const props = defineProps({
    componentName:{
        type:String,
        requierd: true,
    },
})
const iconMap = {
    HeaderNoSession:'navbar-toggler-icon',
    HeaderUser:'bi bi-gear-fill user-icon',
    HeaderAdmin:'bi bi-person-vcard admin-icon',
    HeaderSuperAdmin:'bi bi-buildings-fill super-admin-icon',
}
const iconClass = computed(()=> iconMap[props.componentName]);
</script>
<template>
<div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <NuxtLink to="/">
                <img src="/placeholder.png"  width="180" height="50">
            </NuxtLink>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i :class="iconClass" ></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end mt-2" id="navbarSupportedContent">
                <slot>

                </slot>
            </div>
        </div>
    </nav>
</div>
</template>
<style>
.user-icon{
    font-size: 1.5rem;
}
.admin-icon{
    font-size: 1.5rem;
}
.super-admin-icon{
    font-size: 1.5rem;
}
</style>