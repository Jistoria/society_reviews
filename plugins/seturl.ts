export default defineNuxtPlugin(nuxtApp =>{
    nuxtApp.hook("app:mounted", async () => {
        let url = 'http://127.0.0.1:8000';
        const loginP = LoginStore();
        const RegisterP = RegisterStore();
        const Vemail = VerificacionE();
        const TagsP = TagsAd();
        //login paso
        //registro paso
        //
        TagsP.set_url(url)
        Vemail.set_url(url);
        loginP.set_url(url);
        RegisterP.set_url(url);
    });
})