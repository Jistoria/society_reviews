export default defineNuxtRouteMiddleware((tom,from)=>{

    const user = useState('user');
    if(user.value){
        return navigateTo('/');
    }

})