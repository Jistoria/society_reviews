export default defineNuxtPlugin(nuxtApp => {
    nuxtApp.hook("app:mounted", async () => {
        const loginP = LoginStore();
        try {
            const useru = await $fetch('http://127.0.0.1:8000/api/take',{
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                },
                credentials: 'include',
            }) as { user: any }; // Aquí defines el tipo esperado de la respuesta

            // console.log(useru.user);
            loginP.set_data(useru.user);
        } catch (error) {
            
            return loginP.set_data(false);
        }
    });
});