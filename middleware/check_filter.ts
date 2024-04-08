export default defineNuxtRouteMiddleware((to,from)=>{
    console.log(to.path);
    const coverStore = coversE()
    if(to.path == '/'){
        console.log('entre');
        coverStore.clear_filter();
    }else{

    }
})