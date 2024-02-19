const loadedRoutes = new Set();
export default defineNuxtPlugin((nuxtApp) =>{
    nuxtApp.hook("page:start",async ()=>{
        const router = useRouter(); 
        const currentRoute = router.currentRoute.value;
        if (loadedRoutes.has(currentRoute.path)) {
            // Si la ruta ya ha pasado por load.vue, permite que la carga continúe sin redirigir
            return;
        }
        await router.push({ path: '/load', query: { currentRoute: currentRoute.fullPath } });
        loadedRoutes.add(currentRoute.path);
    })

});
