const loadedRoutes = new Set();
export default defineNuxtPlugin((nuxtApp) =>{
    nuxtApp.hook("page:start",async ()=>{
        console.log('entre');
        const router = useRouter(); 
        const currentRoute = router.currentRoute.value;
        if (currentRoute.path === '/') {
            // Si es la página de inicio, permite que la carga continúe sin redirigir
            return;
          }
        if (loadedRoutes.has(currentRoute.path)) {
            // Si la ruta ya ha pasado por load.vue, permite que la carga continúe sin redirigir
            return;
        }
        await router.push({ path: '/load', query: { currentRoute: currentRoute.fullPath } });
        loadedRoutes.add(currentRoute.path);
    })

});
