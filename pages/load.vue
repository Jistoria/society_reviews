<script setup>
const loading = ref(true);
const router = useRouter();
const route = useRoute();

setTimeout(() => {
    const currentRoute = route.query.currentRoute;
    loading.value = false;
    if(route.path === '/load' && currentRoute.startsWith('/load?currentRoute=')){
        const realRoute = currentRoute.replace('/load?currentRoute=', '');
        router.push({ path: realRoute });
    }else{
        router.push({ path: `${currentRoute}` })
    }
}, 2000);

</script>
<template>
    <div v-show="loading" class="load_setup">
        <div class="spinner"></div>
    </div>
</template>
<style scoped>
.load_setup{
    position: absolute;
    top:0px;
    background: rgb(0, 0, 0);
    width: 100%;
    height: 100vh;
    display:flex;
    z-index: 20;
}
.spinner{
    height: 120px;
    width: 120px;
    border: 6px solid white;
    margin:auto;
    border-color: white transparent white transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}
@keyframes spin{
    to{
        transform: rotate(360deg);
    }
}
</style>